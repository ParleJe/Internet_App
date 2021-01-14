<?php


class UserRepository extends Repository
{
    public function getUserById(int $id): ?User
    {
        $statement = $this->database->getInstance()->prepare('
           SELECT * FROM user_full_detail WHERE mortal_id = ?;
        ');
        $statement->execute([$id]);

        return $statement->fetchObject("User"); // always one

    }

    public function getUser(string $mail): array
    {
        $statement = $this->database->getInstance()->prepare('
           SELECT * FROM user_full_detail WHERE mail = ?;
        ');
        $statement->execute([$mail]);

        return $statement->fetchAll(PDO::FETCH_CLASS, "User");

    }

    public function setUserByTransaction(User $user): bool
    {
        $connection = $this->database->getInstance();
        if ($connection->beginTransaction()) {
            $statement = $connection->prepare('
           INSERT INTO mortal_details (name, surname, nickname ) 
           VALUES                     (?, ?, ?);
           ');
            if (!$statement->execute([
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

            if (!$statement->execute([
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

    public function getFriendsOfUser(int $user): array
    {
        $connection = $this->database->getInstance();

        $statement = $connection->prepare('
        SELECT * FROM friends WHERE user_id = ?;
        ');

        $statement->execute([$user]);

        return $statement->fetchAll(PDO::FETCH_CLASS, "User");
    }

    public function getUsersByName(string $name): array
    {
        $statement = $this->database->getInstance()->prepare('
        SELECT * FROM user_full_detail where nickname LIKE ?;
        ');

        try {
            $statement->execute(['%' . $name . '%']);
        } catch (Exception $e) {
            return [];
        }
        return $statement->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    public function setUserStatus(int $userID): bool
    {
        $stmt = $this->database->getInstance()->prepare('
        UPDATE mortal SET is_log = NOT is_log WHERE mortal_id=?;
        ');

        return $stmt->execute([$userID]);


    }

    public function deleteUser(int $userID):bool {
        $stmt = $this->database->getInstance()->prepare('
        DELETE FROM mortal WHERE mortal_id = ?;
        ');

        return $stmt->execute([$userID]);
    }

    //TODO change location to tripRepository
    public function owns(int $userId, int $tripId, string $type): bool
    {
        $trip = $tripId;
        switch($type){
            case 'template':
                $stmt = $this->database->getInstance()->prepare('
                SELECT COUNT(1) FROM trip WHERE mortal_id = ? AND trip_id = ? ;
            ');
                break;
            case 'planned':
                $repository = new TripRepository();
                $trip = $repository->fetchPlannedTripsByTripId($tripId, $userId)->getPlannedTripId();
                $stmt = $this->database->getInstance()->prepare('
                SELECT COUNT(1) FROM planned_trip WHERE mortal_id = ? AND planned_trip_id = ? ;
            ');
                break;
            case 'member': return false;
        }


        $stmt->execute([$userId, $trip]);
        return $stmt->fetchColumn() === 1;
    }

    public function isMember(int $userID, int $tripID): bool
    {
        $repository = new TripRepository();
        $trips = $repository->getMemberTripsByUserId($userID);
        foreach ($trips as $trip) {
            if($trip->gettripId() === $tripID) return true;
        }
        return false;
    }
}