<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../models/EventApplication.php';

class EventRepository extends Repository
{
    public function getEvent(int $id): ?Event
    {
        $stat = $this->database->connect()->prepare(
        'select * from events where id= :id'
        );
        $stat->bindParam(':id', $id, PDO::PARAM_STR);
        $stat->execute();

        $event = $stat->fetch(PDO::FETCH_ASSOC);

        if($event == null)
        {
            return null;
        }

        $newEvent = new Event(
            $event['title'],
            $event['max_participants'],
            $event['localisation'],
            $event['date'],
            $event['duration'],
            $event['id_organizer'],
            $event['description'],
        );
        $newEvent->setId($event['id']);
        $newEvent->setImage($event['image']);
        return $newEvent;
    }

    public function getEvents(): array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            select * from events_with_participants where :id not in(select id_user from event_participants
            where events_with_participants.id=id_event)
            and :id not in(select id_user from event_applications where events_with_participants.id=id_event)
            and participants < max_participants
        ');
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->createEvents($events);
    }

    public function getEventsByKey($searchString):array
    {
        $result = [];
        $searchString = '%'.strtolower($searchString).'%';
        $stmt = $this->database->connect()->prepare('
            select * from events_with_participants where :id not in(select id_user from event_participants
            where events_with_participants.id=id_event)
            and :id not in(select id_user from event_applications where events_with_participants.id=id_event)
            and participants < max_participants
            and (lower(events_with_participants.title) like :str
                     or lower(events_with_participants.description) like :str
                     or lower(events_with_participants.localisation) like :str)
        ');
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
        $stmt->bindParam(':str', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);;
        return $this->createEvents($events);
    }

    public function getUserEvents($userId): array
    {
        $stmt = $this->database->connect()->prepare(
            'select * from events_with_participants
                    join event_participants on events_with_participants.id=event_participants.id_event
                    where event_participants.id_user= :userId'
        );
        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->createEvents($events);
    }

    public function getUserEventsByKey($userId, $searchString): array
    {
        $searchString = '%'.strtolower($searchString).'%';
        $stmt = $this->database->connect()->prepare(
            'select * from events_with_participants
                    join event_participants on events_with_participants.id=event_participants.id_event
                    where event_participants.id_user= :userId
                    and (lower(events_with_participants.title) like :str
                             or lower(events_with_participants.description) like :str
                             or lower(events_with_participants.localisation) like :str)
                    ');
        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':str', $searchString, PDO::PARAM_STR);
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->createEvents($events);
    }

    public function addEvent(Event $event): void
    {
        $stmt = $this->database->connect()->prepare(
            'insert into events (title, max_participants, localisation, date, duration, id_organizer, id_category, description, image)
                values (?,?,?,?,?,?,?,?,?)'
        );
        if(is_null($event->getImage()))
        {
            $event->setImage('defaultEvent.jpg');
        }
        if($event->getDescription() == '')
        {
            $event->setDescription('Brak opisu');
        }
        $stmt->execute([
            $event->getTitle(),
            $event->getMaxParticipants(),
            $event->getLocalisation(),
            $event->getDate(),
            $event->getDuration(),
            $event->getOrganizerId(),
            1,
            $event->getDescription(),
            $event->getImage()
        ]);

        $stmt = $this->database->connect()->prepare(
            'select max(id) as lastId from events'
        );
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $result['lastid'];
        $stmt = $this->database->connect()->prepare(
            'insert into event_participants (id_user, id_event) values (?,?)'
        );
        $stmt->execute([
            $_SESSION['id'],
            $id
        ]);
    }

    public function updateEvent(Event $event)
    {
        $stat = $this->database->connect()->prepare(
            'update events set title= :title, localisation= :localisation, date = :date, duration= :duration,
                  description= :description, image = :image
                    where id= :id');

        $title = $event->getTitle();
        $localisation = $event->getLocalisation();
        $date = $event->getDate();
        $duration = $event->getDuration();
        $description = $event->getDescription();
        $image = $event->getImage();
        $id = $event->getId();

        $stat->bindParam(':title', $title, PDO::PARAM_STR);
        $stat->bindParam(':localisation', $localisation, PDO::PARAM_STR);
        $stat->bindParam(':date', $date, PDO::PARAM_STR);
        $stat->bindParam(':duration', $duration, PDO::PARAM_STR);
        $stat->bindParam(':description', $description, PDO::PARAM_STR);
        $stat->bindParam(':image', $image, PDO::PARAM_STR);
        $stat->bindParam(':id', $id, PDO::PARAM_STR);
        $stat->execute();
    }

    public function deleteEvent($eventId)
    {
        $stmt = $this->database->connect()->prepare(
            'delete from events where id = :id'
        );
        $stmt->bindParam(':id', $eventId, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function resign($eventId)
    {
        $event = $this->getEvent($eventId);
        if($event->getOrganizerId() == $_SESSION['id'])
        {
            $this->deleteEvent($eventId);
        }
        else
        {
            $stmt = $this->database->connect()->prepare(
                'delete from event_participants where id_event = :id_event and id_user = :id_user'
            );
            $stmt->bindParam(':id_event', $eventId, PDO::PARAM_STR);
            $stmt->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_STR);
            $stmt->execute();
        }
    }

    public function sendApplication($eventId)
    {
        $stmt = $this->database->connect()->prepare(
            'insert into event_applications (id_user, id_event)
                values (?,?)'
        );
        $stmt->execute([
            $_SESSION['id'],
            $eventId
        ]);
    }

    public function acceptApplication($applicationId)
    {
        $stmt = $this->database->connect()->prepare(
            'select * from event_applications where id = :id'
        );
        $stmt->bindParam(':id', $applicationId, PDO::PARAM_STR);
        $stmt->execute();
        $application = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->database->connect()->prepare(
            'insert into event_participants (id_user, id_event)
                values (?,?)'
        );
        $stmt->execute([
            $application['id_user'],
            $application['id_event']
        ]);

        $stmt = $this->database->connect()->prepare(
            'delete from event_applications where id = :id'
        );
        $stmt->bindParam(':id', $applicationId, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function cancelApplication($applicationId)
    {
        $stmt = $this->database->connect()->prepare(
            'delete from event_applications where id = :id'
        );
        $stmt->bindParam(':id', $applicationId, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getReceivedApplication(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare(
            'select ep.id applicationId, e.title eventTitle, u.user_name userName, ud.image userImage, u.id userId
                   from event_applications ep
                   join events e on ep.id_event = e.id
                   join users u on ep.id_user = u.id
                   join user_details ud on ud.id = u.id_user_details
                   where id_event in (select id from events where id_organizer= :id)');
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
        $stmt->execute();
        $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($applications as $application) {
            $newApplication = new EventApplication(
                $application['applicationid'],
                $application['username'],
                $application['eventtitle']
            );
            $newApplication->setImage($application['userimage']);
            $newApplication->setUserId($application['userid']);
            $result[] = $newApplication;
        }
        return $result;
    }

    public function getUserApplications(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare(
            'select ep.id applicationId, e.title eventTitle, u.user_name userName, ud.image userImage, e.id_organizer organizerId
                   from event_applications ep
                   join events e on ep.id_event = e.id
                   join users u on e.id_organizer = u.id
                   join user_details ud on ud.id = u.id_user_details
                   where id_user= :id');
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
        $stmt->execute();
        $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($applications as $application) {
            $newApplication = new EventApplication(
                $application['applicationid'],
                $application['username'],
                $application['eventtitle']
            );
            $newApplication->setImage($application['userimage']);
            $newApplication->setUserId($application['organizerid']);
            $result[] = $newApplication;
        }
        return $result;
    }

    private function createEvents($eventResult): array
    {
        $result = [];
        foreach ($eventResult as $event) {
            $newEvent = new Event(
                $event['title'],
                $event['max_participants'],
                $event['localisation'],
                $event['date'],
                $event['duration'],
                $event['id_organizer'],
                $event['description']
            );
            $newEvent->setId($event['id_event']);
            if($newEvent->getId() === null){
                $newEvent->setId($event['id']);
            }
            $newEvent->setImage($event['image']);
            $newEvent->setParticipants($event['participants']);
            $result[] = $newEvent;
        }
        return $result;
    }

}