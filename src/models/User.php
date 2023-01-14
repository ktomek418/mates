<?php

class User
{
    private $email;
    private $password;
    private $userName;

    public function __construct(string $email, string $password, string $userName)
    {
        $this->email = $email;
        $this->password = $password;
        $this->userName = $userName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function setUserName(string $userName)
    {
        $this->userName = $userName;
    }



}