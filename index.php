<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController' );
Routing::get('search', 'DefaultController' );
Routing::get('trips', 'DefaultController');

Routing::post('create', 'TripController');
Routing::post('login', 'LoginController' );
Routing::post('register', 'LoginController');
Routing::run($path);