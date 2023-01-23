<?php

class Event
{
    private $id;
    private $title;
    private $participants;
    private $maxParticipants;
    private $localisation;
    private $date;
    private $duration;
    private $organizerId;
    private $description;
    private $image;

    public function __construct( $title, $maxParticipants, $localisation, $date, $duration, $organizerId, $description, $image)
    {
        $this->title = $title;
        $this->maxParticipants = $maxParticipants;
        $this->localisation = $localisation;
        $this->date = $date;
        $this->duration = $duration;
        $this->organizerId = $organizerId;
        $this->description = $description;
        $this->image = $image;
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

    public function getParticipants()
    {
        return $this->participants;
    }

    public function setParticipants($participants): void
    {
        $this->participants = $participants;
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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
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