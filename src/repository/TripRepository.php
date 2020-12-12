<?php

class TripRepository extends Repository {

    public function getTripByName(string $name): ?Trip {
        $statement = $this->database->getInstance()->prepare('
            SELECT 1 FROM trip where trip_name = :Name;
            ');

        try {
            $statement->execute( [
                ':Name' => $name,
            ] );
        } catch (Exception $e){
            die($e->getMessage());
        }
        $trip = $statement->fetchObject('Trip');
        $trip = $trip?: null;

        return $trip;
    }

    public function getTripByUser( string $user ): ?array {
        return null;
    }

    public function setTrip( Trip $trip): bool{
        $connection = $this->database->getInstance();

        $statement = $connection->prepare('
        INSERT INTO trip (trip_name, destination, description, points_of_interest, photo_directory, color, mortal_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
        ');

         return $statement->execute([
            $trip->getTripName(),
            $trip->getDestination(),
            $trip->getDescription(),
            $trip->getPointsOfInterest(),
            $trip->getPhotoDirectory(),
            $trip->getColor(),
            $trip->getMortalId()
        ]);
    }
}