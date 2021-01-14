<?php


class User implements JsonSerializable
{
    const ADMIN = 1;
    const USER = 2;


    private ?int $mortal_id;
    private ?string $mail;
    private ?string $password;
    private ?int $role_id;
    private ?string $name;
    private ?string $surname;
    private ?string $nickname;
    private ?bool $is_log;

    public function __construct(array $data = null)
    {
        if (!is_null($data)) {
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
            'role_id' => $this->getRoleId(),
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'nickname' => $this->getNickname(),
            'is_log' => $this->isLog()
        ];
    }


    public function getRoleId(): ?int
    {
        return $this->role_id;
    }


    public function setRoleId($role_id): void
    {
        $this->role_id = $role_id;
    }


    public function isLog(): bool
    {
        return $this->is_log;
    }


    public function setIsLog($is_log): void
    {
        $this->is_log = $is_log;
    }


    public function getMortalId(): int
    {
        return $this->mortal_id;
    }


    public function setMortalId($mortal_id): void
    {
        $this->mortal_id = $mortal_id;
    }


    public function getMail(): ?string
    {
        return $this->mail;
    }


    public function setMail($mail): void
    {
        $this->mail = $mail;
    }


    public function getPassword(): ?string
    {
        return $this->password;
    }


    public function setPassword($password): void
    {
        $this->password = $password;
    }


    public function getRoleName(): ?int
    {
        return $this->role_id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }


    public function setName($name): void
    {
        $this->name = $name;
    }


    public function getSurname(): ?string
    {
        return $this->surname;
    }


    public function setSurname($surname): void
    {
        $this->surname = $surname;
    }


    public function getNickname(): ?string
    {
        return $this->nickname;
    }


    public function setNickname($nickname): void
    {
        $this->nickname = $nickname;
    }


}