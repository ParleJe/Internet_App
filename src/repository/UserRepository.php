<?php


class UserRepository extends Repository
{

    public function getUser(string $mail): ?User {
        $statement = $this->database->getInstance()->prepare('
           SELECT * FROM "user" WHERE mail = ?;
        ');
        $statement->execute($mail);

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user == false){
            throw new Exception('user not found');
        }

        return new User(
            $user['mail'],
            $user['password'],
            $user['login'],
            $user['user_name'],
            $user['surname']
        );
    }

    public function setUser(User $user): bool{
        $statement = $this->database->getInstance()->prepare('
        INSERT INTO "user" (mail, password, user_name, surname, login)
        VALUES (:mail,:password, :user_name, :surname, :login);
        ');

        try {
            $statement->execute(array(
                ':mail'=>$user->getEmail(),
                'password'=>$user->getPassword(),
                ':user_name' => $user->getName(),
                ':surname' => $user->getSurname(),
                ':login' => $user->getLogin(),
            ));
        } catch (Exception $e){
            return false;
        }
        return true;
}



}