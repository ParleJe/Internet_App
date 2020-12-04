<?php


class UserRepository extends Repository
{

    public function getUser(string $mail): ?User {
        $statement = $this->database->getInstance()->prepare('
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
            $user['login'],
            $user['name'],
            $user['surname']
        );
    }

    public function setUser(User $user): bool{
        $statement = $this->database->getInstance()->prepare('
        INSERT INTO users (mail, password, name, surname, login)
        VALUES (:mail,:password, :name, :surname, :login)');

        try {
            $statement->execute(array(
                ':mail'=>$user->getEmail(),
                'password'=>$user->getPassword(),
                ':name' => $user->getName(),
                ':surname' => $user->getSurname(),
                ':login' => $user->getLogin(),
            ));
        } catch (Exception $e){
            return false;
        }
        return true;
}



}