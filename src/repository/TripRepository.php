<?php

class TripRepository extends Repository {

    public function getTripByName(string $name): ?Trip {
        $statement = $this->database->getInstance()->prepare('
            SELECT * FROM trip where trip_name = :Name;
            ');

        try {
            $statement->execute( [
                ':Name' => $name,
            ] );
        } catch (Exception $e){
            return null;
        }
        $trip = $statement->fetch(PDO::FETCH_ASSOC);

        return new Trip(
            $trip['trip_name'],
            $trip['destination'],
            $trip['description'],
            $trip['pointsOfInterest'],
             ' '
        );
    }

    public function getTripByUser( string $user ): ?array {
        return null;
    }

    public function setTrip( Trip $trip ): bool {

        $statement = $this->database->getInstance()->prepare('
        INSERT INTO "trip" (trip_name, destination, description, "pointsOfInterest", photo)
        VALUES (:trip_name,:destination, :description, :pointsOfInterest, :photo);
        ');

        try {
            $statement->execute( [
                ':trip_name' => $trip->getName(),
                ':destination' => $trip->getLocalization(),
                ':description' => $trip->getDescription(),
                ':pointsOfInterest' => $trip->getSteps(),
                ':photo' => $trip->getPhoto(),
            ]);
        } catch (Exception $e){
            return false;
        }
        return true;

    }
}