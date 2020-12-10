<?php


class Repository
{
    protected DatabaseConnection $database;


    public function __construct()
    {
        $this->database = new DatabaseConnection();
    }


}