<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController' );
Routing::get('search', 'DefaultController' );
Routing::get('trips', 'DefaultController');
Routing::get('friends', 'DefaultController');

Routing::post('create', 'TripController');
Routing::post('login', 'LoginController' );
Routing::post('registration', 'LoginController');
Routing::run($path);