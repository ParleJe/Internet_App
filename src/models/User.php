<?php


class User
{
    private $email;
    private $password;
    private $login;
    private $salt;
    private $name;
    private $surname;



    //Getters and Setters:

    /**
     * User constructor.
     * @param $email
     * @param $password
     * @param $login
     * @param $salt
     * @param $name
     * @param $surname
     */
    public function __construct($email, $password, $login, $salt, $name, $surname)
    {
        $this->email = $email;
        $this->password = $password;
        $this->login = $login;
        $this->salt = $salt;
        $this->name = $name;
        $this->surname = $surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param mixed $salt
     */
    public function setSalt($salt): void
    {
        $this->salt = $salt;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname): void
    {
        $this->surname = $surname;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login)
    {
        $this->login = $login;
    }



}