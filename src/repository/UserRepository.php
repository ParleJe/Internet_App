<?php


class UserRepository extends Repository
{

    public function getUser(string $mail): array
    {
        $statement = $this->database->getInstance()->prepare('
           SELECT * FROM user_full_detail WHERE mail = ?;
        ');
        $statement->execute( [$mail] );

        return $statement->fetchAll(PDO::FETCH_CLASS, "User"); // always one

    }

    public function setUserByTransaction( User $user ): bool
    {
        $connection = $this->database->getInstance();
        if ($connection->beginTransaction()) {
            $statement = $connection->prepare('
           INSERT INTO mortal_details (name, surname, nickname ) 
           VALUES                     (?, ?, ?);
           ');
            if ( ! $statement->execute([
                $user->getName(),
                $user->getSurname(),
                $user->getNickname()
            ])) {
                $connection->rollBack();
                return false;
            }

            $statement = $connection->prepare('
           INSERT INTO mortal (mail, password, role_id, mortal_details_id)
           VALUES             (?, ?, ?, ?);
           ');

            if ( ! $statement->execute([
                $user->getMail(),
                $user->getPassword(),
                $user->getRoleName(), //TODO change this name
                $connection->lastInsertId()
            ])) {
                $connection->rollBack();
                return false;
            }

            $connection->commit();
            return true;
        }
        return false;
    }

    public function getFriendsOfUser( int $user ): array {
        $connection = $this->database->getInstance();

        $statement = $connection->prepare('
        SELECT * FROM friends WHERE user_id = ?;
        ');

        $statement->execute( [ $user ] );

        return $statement->fetchAll(PDO::FETCH_CLASS, "User");
    }


}