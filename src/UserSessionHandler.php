<?php


class UserSessionHandler
{
    private array $availableWithoutLog = ['search', '', 'login', 'test', 'logout'];

    public function __construct()
    {
        session_start();
    }

    private function checkLogStatus(): ?bool {
        return isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true;
    }

    public function getPageAvaibility(string $name): bool
    {
        if( in_array($name, $this->availableWithoutLog) || $this->checkLogStatus()) {
            return true;
        }
        return false;
    }

}


