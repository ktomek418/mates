<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController {

    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/planned");
        }
        if (!$this->isPost()) {
            $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->userRepository->getUser($email);
        if(!$user){
            $this->render('login', ['messages' => ['Użytkownik nie istnieje!']]);
        }

        if ($user->getEmail() !== $email) {
            $this->render('login', ['messages' => ['Użytkownik o podanym emailu nie istnieje!']]);
        }

        if ($user->getPassword() !== $password) {
            $this->render('login', ['messages' => ['Błędne hasło!']]);
        }

        $_SESSION['id'] = $user->getId();

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/planned");
    }

    public function register()
    {
        if (!$this->isPost()) {
            $this->render('register');
        }
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeatPassword'];

        if($name == null || $email == null || $password == null || $repeatPassword == null)
        {
            $this->render('register', ['messages' => ['Niepoprawne dane!']]);
        }

        $user = $this->userRepository->getUser($email);

        if($user){
            $this->render('register', ['messages' => ['Użytkownik o podanym emailu już istnieje!']]);
        }

        if($password != $repeatPassword)
        {
            $this->render('register', ['messages' => ['Hasła nie są ze sobą zgodne!']]);
        }

        $user = new User($email, $password, $name);
        $this->userRepository->addUser($user);
        $this->render('login', ['messages' => ['Możesz się zalogować']]);

    }


    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        $this->render('login', ['messages' => ['Zostałeś wylogowany!']]);
    }
}