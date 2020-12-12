<?php


class User
{
    const ADMIN = 1;
    const USER = 2;

    //keep order as in the database
    private $mortal_id;
    private $mail;
    private $password;
    private $role_name;
    private $name;
    private $surname;
    private $nickname;

       /* /**
         * User constructor.
         * @param $mortal_id
         * @param $mail
         * @param $password
         * @param $role_name
         * @param $name
         * @param $surname
         * @param $nickname
         */
    /*public function __construct($mortal_id, $mail, $password, $role_name, $name, $surname, $nickname)
    {
        $this->mortal_id = $mortal_id;
        $this->mail = $mail;
        $this->password = $password;
        $this->role_name = $role_name;
        $this->name = $name;
        $this->surname = $surname;
        $this->nickname = $nickname;
    }*/


    public static function initiateUserWithValues ($mortal_id, $mail, $password, $role_name, $name, $surname, $nickname): User {
        $user = new User();

        $user->mortal_id = $mortal_id;
        $user->mail = $mail;
        $user->password = $password;
        $user->role_name = $role_name;
        $user->name = $name;
        $user->surname = $surname;
        $user->nickname = $nickname;
        
        return $user;

    }
    public function getVariablesToArray(): array {
        $array = [];
        foreach($this as $value) {
            $array[] = $value;
        }
        return $array;
    }





    public function getMortalId() : int{
        return $this->mortal_id;
    }


    public function setMortalId($mortal_id): void
    {
        $this->mortal_id = $mortal_id;
    }


    public function getMail()
    {
        return $this->mail;
    }


    public function setMail($mail): void
    {
        $this->mail = $mail;
    }


    public function getPassword()
    {
        return $this->password;
    }


    public function setPassword($password): void
    {
        $this->password = $password;
    }


    public function getRoleName()
    {
        return $this->role_name;
    }


    public function setRoleName($role_name): void
    {
        $this->role_name = $role_name;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name): void
    {
        $this->name = $name;
    }


    public function getSurname()
    {
        return $this->surname;
    }


    public function setSurname($surname): void
    {
        $this->surname = $surname;
    }


    public function getNickname()
    {
        return $this->nickname;
    }


    public function setNickname($nickname): void
    {
        $this->nickname = $nickname;
    }




}