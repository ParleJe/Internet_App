<?php


class Repository
{
    const FETCH_FLAGS = PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE;
    protected DatabaseConnection $database;


    public function __construct()
    {
        $this->database = new DatabaseConnection();
    }


}