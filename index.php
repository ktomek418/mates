<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::post('login', 'SecurityController');
Router::post('register', 'SecurityController');
Router::post('logout', 'SecurityController');
Router::get('userProfile', 'UserController');
Router::get('userProfileEditor', 'UserController');
Router::post('updateOrCreateUserDetails', 'UserController');
Router::get('planned', 'EventController');
Router::get('events', 'EventController');
Router::get('newEvent', 'EventController');
Router::post('addEvent', 'EventController');
Router::post('sendApplication', 'EventController');
Router::post('resign', 'EventController');

Router::run($path);