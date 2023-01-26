<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../models/EventApplication.php';
require_once __DIR__.'/../repository/EventRepository.php';

class EventController extends AppController
{
    private $eventRepository;

    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    public function __construct()
    {
        parent::__construct();
        $this->eventRepository = new EventRepository();
    }

    public function planned()
    {
        $this->checkAuth();
        $planned = true;
        $events = $this->eventRepository->getUserEvents($_SESSION['id']);
        $this->render('events', ['events' => $events, 'planned' => $planned]);
    }
    public function events()
    {
        $this->checkAuth();
        $events = $this->eventRepository->getEvents();
        $planned = false;
        $this->render('events', ['events' => $events, 'planned' => $planned]);
    }

    public function newEvent()
    {
        $this->checkAuth();
        $this->render('event-creator');
    }
    public function eventEditor()
    {
        $this->checkAuth();
        $event = $this->eventRepository->getEvent($_POST['eventId']);
        $this->render('event-editor', ['event' => $event]);
    }

    public function addEvent()
    {
        $this->checkAuth();
        if ($this->isPost())
        {
            $event = new Event($_POST['title'], $_POST['maxParticipants'], $_POST['localisation'], $_POST['date'], $_POST['duration'], $_SESSION['id'], $_POST['description']);
            if(is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))
            {
                move_uploaded_file(
                    $_FILES['file']['tmp_name'],
                    dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['file']['name']
                );
                $event->setImage($_FILES['file']['name']);
            }
            $this->eventRepository->addEvent($event);
        }
        $this->redirect("planned");
    }
    public function updateEvent()
    {
        $this->checkAuth();
        if ($this->isPost())
        {
            $event = $this->eventRepository->getEvent($_POST['eventId']);
            if(is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))
            {
                move_uploaded_file(
                    $_FILES['file']['tmp_name'],
                    dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['file']['name']
                );
                $event->setImage($_FILES['file']['name']);
            }

            $event->setTitle($_POST['title']);
            $event->setLocalisation($_POST['localisation']);
            $event->setDate($_POST['date']);
            $event->setDuration($_POST['duration']);
            $event->setDescription($_POST['description']);

            $this->eventRepository->updateEvent($event);
        }
        $this->redirect("planned");
    }
    public function deleteEvent()
    {
        $this->checkAuth();
        if ($this->isPost())
        {
            $this->eventRepository->deleteEvent($_POST['eventId']);
        }
        $this->redirect("events");
    }

    public function resign()
    {
        $this->checkAuth();
        if ($this->isPost())
        {
            $this->eventRepository->resign($_POST['eventId']);
        }
        $this->redirect("planned");
    }
    public function sendApplication()
    {
        $this->checkAuth();
        if ($this->isPost())
        {
            $this->eventRepository->sendApplication($_POST['eventId']);
        }
        $this->redirect("events");;
    }

    public function acceptApplication()
    {
        $this->checkAuth();
        if ($this->isPost())
        {
            $this->eventRepository->acceptApplication($_POST['applicationId']);
        }
        $this->redirect("receivedApplication");;
    }
    public function cancelApplication()
    {
        $this->checkAuth();
        if ($this->isPost())
        {
            $this->eventRepository->cancelApplication($_POST['applicationId']);
        }
        $this->redirect("receivedApplication");;
    }

    public function receivedApplication()
    {
        $this->checkAuth();
        $applications = $this->eventRepository->getReceivedApplication();
        $myApplications = false;
        $this->render('event-application', ['applications' => $applications, 'myApplications' => $myApplications]);
    }
    public function myApplication()
    {
        $this->checkAuth();
        $myApplications = true;
        $applications = $this->eventRepository->getUserApplications();
        $this->render('event-application', ['applications' => $applications, 'myApplications' => $myApplications]);
    }


    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'Niewłaściwy rozmiar pliku';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'Ten rodzaj pliku nie jest obsługiwany';
            return false;
        }
        return true;
    }


}