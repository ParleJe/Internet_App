<?php


class User implements JsonSerializable
{
    const ADMIN = 1;
    const USER = 2;


    private int $mortal_id;
    private string $mail;
    private string $password;
    private int $role_id;
    private string $name;
    private string $surname;
    private string $nickname;
    private bool $is_log;

    public function __construct (array $data = null) {
        if( ! is_null($data)){
        $this->setMortalId($data['mortal_id']);
        $this->setMail($data['mail']);
        $this->setPassword($data['password']);
        $this->setRoleId($data['role_id']);
        $this->setName($data['name']);
        $this->setSurname($data['surname']);
        $this->setNickname($data['nickname']);
        $this->setIsLog($data['is_log']);
        }
    }

    public function jsonSerialize()
    {
        return [
            'mortal_id' => $this->getMortalId(),
            'mail' => $this->getMail(),
            'password' => $this->getPassword(),
            //'role_id' => $this->getRoleId(),
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'nickname' => $this->getNickname(),
            'is_log' => $this->isLog()
        ];
    }

    /**
     * @return mixed
     */
    public function getRoleId() {
        return $this->role_id;
    }

    /**
     * @param mixed $role_id
     * @return User
     */
    public function setRoleId(int $role_id): User {
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