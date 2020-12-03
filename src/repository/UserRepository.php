<?php


class UserRepository extends Repository
{

    public function getUser(string $mail): ?User {
        $statement = $this->database->connect()->prepare('
           SELECT * FROM users WHERE mail = :mail;
        ');
        $statement->bindParam(':mail', $mail, PDO::PARAM_STR);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user == false){
            throw new Exception('user not found');
        }

        return new User(
            $user['mail'],
            $user['password'],
            $user['login']
        );
    }

    public function setUser(): bool{
        return false;
}

}