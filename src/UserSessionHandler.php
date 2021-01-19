<?php


class UserSessionHandler
{
    private array $availableWithoutLog = ['registration', '', 'login', 'test', 'logout'];

    public function __construct()
    {
        session_start();
    }

    private function checkLogStatus(): ?bool {
        return isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true;
    }

    public function getPageAvailability(string $name): bool
    {
        if( in_array($name, $this->availableWithoutLog) || $this->checkLogStatus()) {
            return true;
        }
        return false;
    }

}


