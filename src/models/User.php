<?php

class User implements JsonSerializable
{
    const ADMIN = 1;
    const USER = 2;

    private ?int $mortal_id;
    private ?string $mail;
    private ?string $password;
    private ?int $role_id;
    private ?string $nickname;
    private ?bool $is_log;
    private ?string $photo_directory;
    private ?string $quote;

    public function __construct(array $data = null)
    {
        $this->setMortalId($data['mortal_id']);
        $this->setMail($data['mail']);
        $this->setPassword($data['password']);
        $this->setRoleId($data['role_id']);
        $this->setNickname($data['nickname']);
        $this->setIsLog($data['is_log']);
        $this->setPhotoDirectory($data['photo_directory']);
        $this->setQuote($data['quote']);
    }

    public function setIsLog(?bool $is_log): void
    {
        $this->is_log = $is_log;
    }

    public function jsonSerialize(): array
    {
        return [
            'mortal_id' => $this->getMortalId(),
            'mail' => $this->getMail(),
            'password' => $this->getPassword(),
            'role_id' => $this->getRoleId(),
            'quote' => $this->getQuote(),
            'photo_directory' => $this->getPhotoDirectory(),
            'nickname' => $this->getNickname(),
            'is_log' => $this->isLog()
        ];
    }

    public function getMortalId(): ?int
    {
        return $this->mortal_id;
    }

    public function setMortalId(?int $mortal_id): void
    {
        $this->mortal_id = $mortal_id;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): void
    {
        $this->mail = $mail;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getRoleId(): ?int
    {
        return $this->role_id;
    }

    public function setRoleId(?int $role_id): void
    {
        $this->role_id = $role_id;
    }

    public function getQuote(): ?string
    {
        return $this->quote;
    }

    public function setQuote(?string $quote)
    {
        $this->quote = $quote;
    }

    public function getPhotoDirectory(): ?string
    {
        return $this->photo_directory;
    }

    public function setPhotoDirectory(?string $photo_directory)
    {
        $this->photo_directory = $photo_directory;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(?string $nickname): void
    {
        $this->nickname = $nickname;
    }

    public function isLog(): ?bool
    {
        return $this->is_log;
    }

    public function getRoleName(): ?int
    {
        return $this->role_id;
    }


}