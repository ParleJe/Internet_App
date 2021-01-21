<?php

class TripRepository extends Repository
{


    //______________________for trip table____________________
    public function getTripByName(string $name): array
    {
        $statement = $this->database->getInstance()->prepare('
            SELECT * FROM trip where trip_name LIKE ?;
            ');
        $statement->execute(['%' . $name . '%']);

        return $statement->fetchAll(parent::FETCH_FLAGS, 'Trip');
    }

    public function getTripById(int $id): ?Trip
    {
        $statement = $this->database->getInstance()->prepare('
            SELECT * FROM trip where trip_id = ?;
            ');


        $statement->execute([$id]);

        $trip = $statement->fetchAll(parent::FETCH_FLAGS, 'Trip');
        $trip = $trip[0] ?: null;

        return $trip;
    }

    public function setTripByTransaction(Trip $trip): bool
    {

        if ($this->database->getInstance()->beginTransaction()) {
            $stmt = $this->database->getInstance()->prepare('
            INSERT INTO trip (trip_name, destination, description, points_of_interest, photo_directory, color, mortal_id) 
            VALUES           (?, ?, ?, ?, ?, ?, ?);
            ');

            if (!$stmt->execute([
                $trip->getTripName(),
                $trip->getDestination(),
                $trip->getDescription(),
                $trip->getPointsOfInterest(),
                $trip->getPhotoDirectory(),
                $trip->getColor(),
                $trip->getMortalId()
            ])) {
                $this->database->getInstance()->rollBack();
                return false;
            }

            $stmt = $this->database->getInstance()->prepare('
            INSERT INTO planned_trip (trip_id, date_start, date_end, mortal_id, vulp_code) 
            VALUES                   (?, ?, ?, ?, ?); 
            ');

            if (!$stmt->execute([
                $this->database->getInstance()->lastInsertId(),
                $trip->getDateStart(),
                $trip->getDateEnd(),
                $trip->getMortalId(),
                $trip->getVulpCode()
            ])) {
                $this->database->getInstance()->rollBack();
                return false;
            }
            $this->database->getInstance()->commit();
            return true;
        }
        return false;
    }

    public function getTripsByUserId(int $id): array
    {
        $connection = $this->database->getInstance();

        $statement = $connection->prepare('
        SELECT * FROM trip WHERE mortal_id = ?;
        ');

        $statement->execute([$id]);

        return $statement->fetchAll(parent::FETCH_FLAGS, 'Trip');

    }

    public function deleteTrip($tripID): bool
    {
        $stmt = $this->database->getInstance()->prepare('
        DELETE FROM trip WHERE trip_id = ?;
        ');

        return $stmt->execute([$tripID]);
    }

    public function getAllTrips(): array
    {
        $stmt = $this->database->getInstance()->prepare('
        SELECT * FROM trip;
        ');

        if ($stmt->execute()) {
            return $stmt->fetchAll(self::FETCH_FLAGS, 'Trip');
        }
        return [];
    }

    //______________________for planned_trip____________________
    public function fetchPlannedTripsByUserId(int $userID): array
    {
        $connection = $this->database->getInstance();

        $stmt = $connection->prepare('
        SELECT pt.planned_trip_id, pt.trip_id, t.trip_name, t.destination, t.photo_directory, t.color, pt.date_start, pt.date_end 
        FROM planned_trip pt left join trip t on t.trip_id = pt.trip_id 
        WHERE pt.mortal_id = ? AND date_start > now()
        ORDER BY date_start;
        ');

        $stmt->execute([
            $userID
        ]);

        return $stmt->fetchAll(parent::FETCH_FLAGS, 'Trip');
    }

    public function fetchFeatureTrip(int $userID): ?Trip
    {
        $stmt = $this->database->getInstance()->prepare('
        SELECT * FROM planned_trip_details WHERE date_start > now() AND mortal_id = ? ORDER BY date_start LIMIT 1;
        ');
        $stmt->execute([$userID]);
        $obj = $stmt->fetchAll(parent::FETCH_FLAGS, 'Trip');

        return $obj[0] === false ? null : $obj[0];
    }

    public function setPlannedTrip(array $data): bool
    {
        $con = $this->database->getInstance();

        $test = $this->fetchPlannedTripsByTripId($data['trip_id'], $data['mortal_id']);
        if (!is_null($test)) {
            //TODO render message 'cant plan more than one!'
            return false;
        }

        $stmt = $con->prepare('
        INSERT INTO planned_trip (trip_id, date_start, date_end, mortal_id, vulp_code) 
        VALUES                   (?, ?, ?, ?, ?); 
        ');

        return $stmt->execute([
            $data["trip_id"],
            $data["start"],
            $data["end"],
            $data["mortal_id"],
            $data["vulp_code"]
        ]);

    }

    public function fetchPlannedTripsByTripId(int $tripID, int $userID): ?Trip
    {
        $connection = $this->database->getInstance();

        $stmt = $connection->prepare('
        SELECT * FROM planned_trip_details 
        WHERE trip_id = ? AND mortal_id = ? LIMIT 1;
        ');

        $stmt->execute([
            $tripID,
            $userID
        ]);

        $trip = $stmt->fetchAll(parent::FETCH_FLAGS, 'Trip')[0];
        $trip = $trip ?: null;
        return $trip;

    }

    public function deletePlannedTrip($plannedTripID): bool
    {
        $stmt = $this->database->getInstance()->prepare('
        DELETE FROM planned_trip WHERE planned_trip_id = ?;
        ');

        return $stmt->execute([$plannedTripID]);
    }

    public function getAllPlannedTrips(): ?array
    {
        $stmt = $this->database->getInstance()->prepare('
        SELECT * FROM planned_trip;
        ');

        if (!$stmt->execute()) {
            return $stmt->fetchAll(self::FETCH_FLAGS, 'Trip');
        }
        return [];
    }

    //___________________help functions______________________________
    public function checkVulpCode(string $vulp_code): bool
    {
        $stmt = $this->database->getInstance()->prepare('
        SELECT * FROM planned_trip where vulp_code = ?;
        ');
        $stmt->execute([$vulp_code]);
        $trip = $stmt->fetchAll(parent::FETCH_FLAGS, 'Trip');

        return is_null($trip[0]);
    }

    //membership functions
    public function bindUserWithPlannedTrip(string $code, int $userID): ?Trip
    {
        $stmt = $this->database->getInstance()->prepare('
        SELECT * from planned_trip_details where vulp_code = ?;
        '); //get trip according to code
        $stmt->execute([$code]);
        $trip = $stmt->fetchAll(parent::FETCH_FLAGS, 'Trip')[0];

        $stmt = $this->database->getInstance()->prepare('
        INSERT INTO planned_trip_mortal VALUES (?,?);
        '); // bind user with trip
        if (!$stmt->execute([$trip->getPlannedTripId(), $userID])) {
            return null;
        }
        return $trip;

    }

    public function getMemberTripsByUserId(int $userID): array
    {
        $stmt = $this->database->getInstance()->prepare('
        SELECT * FROM member_planned_trip_details WHERE mortal_id = ?;
        ');
        $stmt->execute([$userID]);
        return $stmt->fetchAll(parent::FETCH_FLAGS, 'Trip');
    }

    public function getPlannedTripId(int $userID, int $templateID): ?int
    {
        $stmt = $this->database->getInstance()->prepare('
        SELECT planned_trip_id from planned_trip WHERE mortal_id = ? AND trip_id = ?;
        ');
        $stmt->execute([$userID, $templateID]);
        $id = $stmt->fetch(PDO::FETCH_COLUMN);
        if ($id != 0) {
            return $id;
        }
        $stmt = $this->database->getInstance()->prepare('
        SELECT pt.planned_trip_id from planned_trip_mortal ptm LEFT JOIN planned_trip pt on pt.planned_trip_id = ptm.planned_trip_id
        WHERE ptm.mortal_id = ? AND trip_id = ?;
        ');
        $stmt->execute([$userID, $templateID]);
        $id = $stmt->fetch(PDO::FETCH_COLUMN);
        if ($id != 0) return $id;
        return null;

    }


    public function deleteMembership(int $plannedTripID, int $userID): bool
    {
        $stmt = $this->database->getInstance()->prepare('
        DELETE FROM planned_trip_mortal WHERE planned_trip_id = ? AND mortal_id = ?;
        ');

        return $stmt->execute([$plannedTripID, $userID]);
    }

}