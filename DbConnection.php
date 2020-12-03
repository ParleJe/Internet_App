<?php

class DbConnection
{
    private static $instance;

    /**
     * DbConnection constructor.
     */
    public function __construct(){}
    public function __clone(){}

    public function getInstance(){

        if(self::$instance == null) {
            $username = USERNAME;
            $password = PASSWORD;
            $database = DATABASE;
            $host = HOST;
            try {
                $instance = new PDO(
                    "pgsql:host=$host:port=5432:dbname=$database",
                    $username,
                    $password,
                    ["sslmode" => 'prefer']
                );

                $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("PDO failed:" . $e);
            }
        }
        return self::$instance;

    }


}