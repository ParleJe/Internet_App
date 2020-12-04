<?php


class Repository
{
    protected  $database;


    public function __construct()
    {
        $this->database = new DatabaseConnection();
    }


}