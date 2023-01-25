<?php

require_once 'AppController.php';

class DefaultController extends AppController {

    public function index()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/planned");
        }
        $this->render('login');
    }


}