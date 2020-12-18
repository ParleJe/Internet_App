<?php

class TripRepository extends Repository {

    public function getTripsByName(string $name): ?Trip {
        $statement = $this->database->getInstance()->prepare('
            SELECT * FROM trip where trip_name = ?;
            ');


        $statement->execute( [ $name ] );

        $trip = $statement->fetchObject('Trip');
        $trip = $trip?: null;

        return $trip;
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

    public function setTrip( Trip $trip): bool{
        $connection = $this->database->getInstance();

        $statement = $connection->prepare('
        INSERT INTO trip (trip_name, destination, description, points_of_interest, photo_directory, color, mortal_id) 
        VALUES           (?, ?, ?, ?, ?, ?, ?);
        ');

         return $statement->execute( [
            $trip->getTripName(),
            $trip->getDestination(),
            $trip->getDescription(),
            $trip->getPointsOfInterest(),
            $trip->getPhotoDirectory(),
            $trip->getColor(),
            $trip->getMortalId()
        ] );
    }

    public function getTripsByUserId(int $id): array {
        $connection = $this->database->getInstance();

        $statement = $connection->prepare( '
        SELECT * FROM trip WHERE mortal_id = ?;
        ');

        $statement->execute( [ $id ] );

        return $statement->fetchAll(PDO::FETCH_CLASS, 'Trip');

    }
}