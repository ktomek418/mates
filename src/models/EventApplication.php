<?php

class EventApplication
{
    private $id;
    private $userId;
    private $userName;
    private $eventTitle;
    private $image;

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

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId): void
    {
        $this->userId = $userId;
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

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }






}