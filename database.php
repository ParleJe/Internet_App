<?php

class Database
{
    private $username;
    private $password;
    private $host;
    private $database;

    /**
     * Database constructor.
     */
    public function __construct(){
        $this->username = USERNAME;
        $this->password = PASSWORD;
        $this->database = DATABASE;
        $this->host = HOST;
    }

    public function connect(){

        try {
            $connection = new PDO(
                "pgsql:host=$this->host:port=5432:dbname=$this->database",
                $this->username,
                $this->password,
                ["sslmode"=>'prefer']
            );

            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch(PDOException $e){
            die("PDO failed:".$e);
        }
    }


}