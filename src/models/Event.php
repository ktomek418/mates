<?php

class Events
{
    private $id;
    private $title;
    private $maxParticipants;
    private $localisation;
    private $date;
    private $duration;
    private $organizerId;
    private $categoryId;
    private $description;

    public function __construct($id, $title, $maxParticipants, $localisation, $date, $duration, $organizerId, $categoryId, $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->maxParticipants = $maxParticipants;
        $this->localisation = $localisation;
        $this->date = $date;
        $this->duration = $duration;
        $this->organizerId = $organizerId;
        $this->categoryId = $categoryId;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getMaxParticipants()
    {
        return $this->maxParticipants;
    }

    public function setMaxParticipants($maxParticipants): void
    {
        $this->maxParticipants = $maxParticipants;
    }

    public function getLocalisation()
    {
        return $this->localisation;
    }

    public function setLocalisation($localisation): void
    {
        $this->localisation = $localisation;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration): void
    {
        $this->duration = $duration;
    }

    public function getOrganizerId()
    {
        return $this->organizerId;
    }

    public function setOrganizerId($organizerId): void
    {
        $this->organizerId = $organizerId;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setCategoryId($categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }






}