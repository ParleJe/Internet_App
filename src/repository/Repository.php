<?php


class Repository
{
    protected  $database;

    //TODO singleton
    public function __construct()
    {
        $this->database = new Database();
    }


}