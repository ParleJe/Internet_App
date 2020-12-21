<?php

class TripRepository extends Repository {

    public function getTripByName(string $name): array {
        $statement = $this->database->getInstance()->prepare('
            SELECT * FROM trip where trip_name LIKE ?;
            ');
        $statement->execute( [ '%'.$name.'%' ] );

        return $statement->fetchAll(PDO::FETCH_CLASS, 'Trip');
    }

    public function getTripById(int $id): ?Trip {
        $statement = $this->database->getInstance()->prepare('
            SELECT * FROM trip where trip_id = ?;
            ');


        $statement->execute( [ $id ] );

        $trip = $statement->fetchObject('Trip');
        $trip = $trip?: null;

        return $trip;
    }

    public function setTripByTransaction(Trip $trip) {
        $con = $this->database->getInstance();

        if($con->beginTransaction()) {
            $stmnt = $con->prepare('
            INSERT INTO trip (trip_name, destination, description, points_of_interest, photo_directory, color, mortal_id) 
            VALUES           (?, ?, ?, ?, ?, ?, ?);
            ');

            if( ! $stmnt->execute( [
                $trip->getTripName(),
                $trip->getDestination(),
                $trip->getDescription(),
                $trip->getPointsOfInterest(),
                $trip->getPhotoDirectory(),
                $trip->getColor(),
                $trip->getMortalId()
            ] )) {
                $con->rollBack();
                return false;
            }

            $stmnt = $con->prepare('
            INSERT INTO planned_trip (trip_id, date_start, date_end, mortal_id) 
            VALUES                   (?, ?, ?, ?); 
            ');

            if( ! $stmnt->execute( [
                $con->lastInsertId(),
                $trip->getDateStart(),
                $trip->getDateEnd(),
                $trip->getMortalId()
            ] )) {
                $con->rollBack();
                return false;
            }
            $con->commit();
            return true;
        }
        return false;
    }

    public function getTripsByUserId(int $id): array {
        $connection = $this->database->getInstance();

        $statement = $connection->prepare( '
        SELECT * FROM trip WHERE mortal_id = ?;
        ');

        $statement->execute( [ $id ] );

        return $statement->fetchAll(PDO::FETCH_CLASS, 'Trip');

    }

    public function fetchPlannedTripsByUserId(int $userID): array {
        $connection = $this->database->getInstance();

        $stmt = $connection->prepare('
        SELECT * FROM planned_trip natural join trip 
        WHERE mortal_id = ?;
        ');

        $stmt->execute([
            $userID
        ]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Trip');
    }

    public function fetchPlannedTripsByTripId(int $tripID): ?Trip {
        $connection = $this->database->getInstance();

        $stmt = $connection->prepare('
        SELECT * FROM planned_trip natural join trip 
        WHERE trip_id = ?;
        ');

        $stmt->execute([
            $tripID
        ]);

        $trip = $stmt->fetchObject('Trip');
        $trip = $trip?: null;
        return $trip;

    }
}