<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController' );
Routing::get('search', 'DefaultController' );

Routing::post('login', 'LoginController' );
Routing::post('registration', 'DefaultController');
Routing::run($path);