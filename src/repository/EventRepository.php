<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Event.php';

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

        return new Event(
            $event['title'],
            $event['max_participants'],
            $event['localisation'],
            $event['date'],
            $event['duration'],
            $event['id_organizer'],
            $event['description'],
            $event['image']
        );
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
                $event['description'],
                $event['image']
            );
            $newEvent->setId($event['id_event']);
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
                $event['image']
            );
            $newEvent->setId($event['id']);
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

}