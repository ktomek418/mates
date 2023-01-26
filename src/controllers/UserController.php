<?php

class UserController extends AppController
{
    private $userRepository;
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function userProfile()
    {
        $this->checkAuth();
        $user = $this->userRepository->getUserById($_SESSION['id']);
        $this->render('user-profile', ['user' => $user]);
    }

    public function userProfileEditor()
    {
        $this->checkAuth();
        $user = $this->userRepository->getUserById($_SESSION['id']);
        $this->render('user-profile-editor', ['user' => $user]);
    }
    public function updateOrCreateUserDetails()
    {
        $this->checkAuth();
        if ($this->isPost())
        {
            $user = $this->userRepository->getUserById($_SESSION['id']);
            if(is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file']))
            {
                move_uploaded_file(
                    $_FILES['file']['tmp_name'],
                    dirname(__DIR__) . self::UPLOAD_DIRECTORY . $_FILES['file']['name']
                );
                $user->setProfileImage($_FILES['file']['name']);
            }

            $user->setName($_POST['name']);
            $user->setSurname($_POST['surname']);
            $user->setPhoneNumber($_POST['phone']);
            $user->setDescription($_POST['description']);

            $this->userRepository->updateUserDetails($user);

        }
        $this->redirect("userProfile");
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