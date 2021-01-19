<?php


class SessionHandler
{

    public function __construct()
    {
        session_start();
    }

    public function checkLogStatus(): bool {
        return isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true;
    }
}


