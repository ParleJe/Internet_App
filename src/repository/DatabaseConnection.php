<?php
class DatabaseConnection {
    private static PDO $instance;
    private string $username;
    private string $password;
    private string $host;
    private string $database;

    public function __construct()
    {
        $this->username = USERNAME;
        $this->password = PASSWORD;
        $this->host = HOST;
        $this->database = DATABASE;
    }
    public function __clone(){}

    public function getInstance(): PDO
    {

        if(self::$instance == null) {
            try {
                self::$instance = new PDO(
                    "pgsql:host=$this->host;port=5432;dbname=$this->database",
                    $this->username,
                    $this->password,
                    ["sslmode"  => "prefer"]
                );

                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("PDO failed:" . $e);
            }
        }
        return self::$instance;

    }


}