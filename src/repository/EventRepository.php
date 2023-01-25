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

        if($event == false)
        {
            return null;
        }

        $newEvent =  new Event(
            $event['title'],
            $event['max_participants'],
            $event['localisation'],
            $event['date'],
            $event['duration'],
            $event['id_organizer'],
            $event['description'],
        );
        $newEvent->setId($event['id']);
        $newEvent->setId($event['image']);
        return $newEvent;
    }

    public function getUserEvents($userId)
    {
        $result = [];
        $stmt = $this->database->connect()->prepare(
            'select *, (select count(*) from event_participants where id_event = events.id) as participants
                    from events join event_participants on events.id=event_participants.id_event
                    where event_participants.id_user= :userId'
        );
        $stmt->bindParam(':userId', $userId, PDO::PARAM_STR);
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($events as $event) {
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
            $newEvent->setImage($event['image']);
            $newEvent->setParticipants($event['participants']);
            $result[] = $newEvent;
        }
        return $result;
    }

    public function getEvents()
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            select *, (select count(*) from event_participants where id_event = events.id) as participants
            from events where :id not in(select id_user from event_participants where events.id=id_event)
            and :id not in(select id_user from event_applications where events.id=id_event)
            and (select count(*) from event_participants where id_event = events.id) < max_participants
        ');
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($events as $event) {
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
            $newEvent->setParticipants($event['participants']);
            $result[] = $newEvent;
        }
        return $result;
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

    public function resign($eventId)
    {
        $event = $this->getEvent($eventId);
        if($event->getOrganizerId() == $_SESSION['id'])
        {
            $stmt = $this->database->connect()->prepare(
                'delete from events where id = :id'
            );
            $stmt->bindParam(':id', $eventId, PDO::PARAM_STR);
            $stmt->execute();
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

    public function getReceivedApplication()
    {
        $stmt = $this->database->connect()->prepare(
            'select ep.id applicationId, e.title eventTitle, u.user_name userName
                   from event_applications ep
                   join events e on ep.id_event = e.id
                   join users u on ep.id_user = u.id
                   where id_event in (select id from events where id_organizer= :id)');
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
        $stmt->execute();
        $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($applications as $application) {
            $result[] = new EventApplication(
                $application['applicationid'],
                $application['username'],
                $application['eventtitle']
            );
        }
        return $result;
    }

    public function getUserApplications()
    {
        $stmt = $this->database->connect()->prepare(
            'select ep.id applicationId, e.title eventTitle, u.user_name userName
                   from event_applications ep
                   join events e on ep.id_event = e.id
                   join users u on ep.id_user = u.id
                   where id_user= :id');
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
        $stmt->execute();
        $applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($applications as $application) {
            $result[] = new EventApplication(
                $application['applicationid'],
                $application['username'],
                $application['eventtitle']
            );
        }
        return $result;
    }

}