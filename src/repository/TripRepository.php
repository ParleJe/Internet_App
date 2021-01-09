<?php

class TripRepository extends Repository {
    private PDO $connection;

    public function __construct()
    {
        parent::__construct();
        $this->connection = $this->database->getInstance();
    }

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

    public function setTripByTransaction(Trip $trip): bool{
        $con = $this->database->getInstance();

        if($con->beginTransaction()) {
            $stmt = $con->prepare('
            INSERT INTO trip (trip_name, destination, description, points_of_interest, photo_directory, color, mortal_id) 
            VALUES           (?, ?, ?, ?, ?, ?, ?);
            ');

            if( ! $stmt->execute( [
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

            $stmt = $con->prepare('
            INSERT INTO planned_trip (trip_id, date_start, date_end, mortal_id, vulp_code) 
            VALUES                   (?, ?, ?, ?); 
            ');

            if( ! $stmt->execute( [
                $con->lastInsertId(),
                $trip->getDateStart(),
                $trip->getDateEnd(),
                $trip->getMortalId(),
                $trip->getVulpCode()
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
        SELECT pt.planned_trip_id, pt.trip_id, t.trip_name, t.destination, t.photo_directory, t.color, pt.date_start, pt.date_end 
        FROM planned_trip pt left join trip t on t.trip_id = pt.trip_id 
        WHERE pt.mortal_id = ?
        ORDER BY date_start;
        ');

        $stmt->execute([
            $userID
        ]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Trip');
    }

    public function fetchPlannedTripsByTripId(int $tripID, int $userID): ?Trip {
        $connection = $this->database->getInstance();

        $stmt = $connection->prepare('
        SELECT * FROM planned_trip natural join trip 
        WHERE trip_id = ? AND mortal_id = ?;
        ');

        $stmt->execute([
            $tripID,
            $userID
        ]);

        $trip = $stmt->fetchObject('Trip');
        $trip = $trip?: null;
        return $trip;

    }

    public function fetchFeatureTrip(int $userID): ?Trip {
        $con = $this->database->getInstance();

        $stmt = $con->prepare('
        SELECT * FROM planned_trip_details WHERE date_start > now() ORDER BY date_start LIMIT 1;
        ');
        $stmt->execute();
        return $stmt->fetchObject('Trip');
    }

    public function setPlannedTrip(array $data): bool {
    $con = $this->database->getInstance();

    $test = $this->fetchPlannedTripsByTripId($data['trip_id']);
    if( ! is_null( $test ) ){
        //TODO render message 'cant plan more than one!'
        return false;
    }

    $stmt = $con->prepare('
        INSERT INTO planned_trip (trip_id, date_start, date_end, mortal_id, vulp_code) 
        VALUES                   (?, ?, ?, ?, ?); 
        ');

    return $stmt->execute($data);

    }

    public function checkVulpCode(string $vulp_code): bool {
        $stmt = $this->connection->prepare('
        SELECT * FROM planned_trip where vulp_code = ?;
        ');
        $stmt->execute([ $vulp_code ]);

        return !is_null($stmt->fetchObject('Trip'));
    }

    public function bindUserWithPlannedTrip(string $code, int $userID) {
        $stmt = $this->connection->prepare('
        SELECT * from planned_trip_details where vulp_code = ?;
        '); //get trip according to code
        $stmt->execute([$code]);
        $trip = $stmt->fetchObject('Trip');

        $stmt = $this->connection->prepare('
        INSERT INTO planned_trip_mortal VALUES (?,?);
        '); // bind user with trip
        if( ! $stmt->execute([$trip->getPlannedTripId(), $userID]) ) {
            return null;
        }
        return $trip;

    }

}