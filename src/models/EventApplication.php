<?php

class EventApplication
{
    private $id;
    private $userName;
    private $eventTitle;

    public function __construct($id, $userName, $eventTitle)
    {
        $this->id = $id;
        $this->userName = $userName;
        $this->eventTitle = $eventTitle;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setUserName($userName): void
    {
        $this->userName = $userName;
    }

    public function getEventTitle()
    {
        return $this->eventTitle;
    }

    public function setEventTitle($eventTitle): void
    {
        $this->eventTitle = $eventTitle;
    }




}