<?php


class User
{
    const ADMIN = 1;
    const USER = 2;

    //keep order as in the database
    public $mortal_id;
    public $mail;
    public $password;
    public $role_id;
    public $name;
    public $surname;
    public $nickname;
    public $is_log;

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


    public static function initiateUserWithValues ($mortal_id, $mail, $password, $role_id, $name, $surname, $nickname): User {
        $user = new User();

        $user->mortal_id = $mortal_id;
        $user->mail = $mail;
        $user->password = $password;
        $user->role_id = $role_id;
        $user->name = $name;
        $user->surname = $surname;
        $user->nickname = $nickname;
        
        return $user;

    }

    /**
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * @param mixed $role_id
     * @return User
     */
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function isLog()
    {
        return $this->is_log;
    }

    /**
     * @param mixed $is_log
     * @return User
     */
    public function setIsLog($is_log)
    {
        $this->is_log = $is_log;
        return $this;
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
        return $this->role_id;
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