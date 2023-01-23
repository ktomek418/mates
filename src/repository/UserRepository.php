<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUser(string $email): ?User
    {
        $stat = $this->database->connect()->prepare(
            'select * from users where email= :email');
        $stat->bindParam(':email', $email, PDO::PARAM_STR);
        $stat->execute();

        $user = $stat->fetch(PDO::FETCH_ASSOC);

        if($user == false)
        {
            return null;
        }

        $newUser = new User(
            $user['email'],
            $user['password'],
            $user['user_name']
        );
        $newUser->setId($user['id']);

        return $newUser;
    }

    public function getUserById(int $id): ?User
    {
        $stat = $this->database->connect()->prepare(
            'select * from users join user_details on 
                    id_user_details = user_details.id
                    where users.id= :id');
        $stat->bindParam(':id', $id, PDO::PARAM_STR);
        $stat->execute();

        $user = $stat->fetch(PDO::FETCH_ASSOC);

        if($user == false)
        {
            return null;
        }

        $newUser = new User(
            $user['email'],
            $user['password'],
            $user['user_name']
        );
        $newUser->setId($user['id']);
        $newUser->setName($user['name']);
        $newUser->setSurname($user['surname']);
        $newUser->setPhoneNumber($user['phone']);
        $newUser->setProfileImage($user['image']);
        $newUser->setDescription($user['description']);

        return $newUser;
    }

    public function addUser(User $user): void {

        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_details (name, surname, phone, description) 
            VALUES (?,?,?,?)
        ');
        $stmt->execute([
            '',
            '',
            '',
            ''
        ]);

        $stmt = $this->database->connect()->prepare(
            'select max(id) as lastId from user_details'
        );
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $result['lastid'];
        echo $id;
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (user_name, password, email, id_user_details) 
            VALUES (?,?,?,?)
        ');
        $stmt->execute([
            $user->getUserName(),
            $user->getPassword(),
            $user->getEmail(),
            $id
        ]);

    }

    public function updateUserDetails(User $user): void
    {
        $stat = $this->database->connect()->prepare(
            'select id_user_details from users where id= :id');
        $stat->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
        $stat->execute();
        $result = $stat->fetch(PDO::FETCH_ASSOC);
        $idUserDetails = $result['id_user_details'];

        $stat = $this->database->connect()->prepare(
            'update user_details set name= :name, surname= :surname, phone = :phone, image= :image, description= :description
                    where id= :id');
        $name = $user->getName();
        $surname = $user->getSurname();
        $phone = $user->getPhoneNumber();
        $img = $user->getProfileImage();
        $description = $user->getDescription();
        $stat->bindParam(':name', $name, PDO::PARAM_STR);
        $stat->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stat->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stat->bindParam(':image', $img, PDO::PARAM_STR);
        $stat->bindParam(':id', $idUserDetails, PDO::PARAM_STR);
        $stat->bindParam(':description', $description, PDO::PARAM_STR);
        $stat->execute();
    }
}