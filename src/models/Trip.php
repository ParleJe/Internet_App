<?php


class Trip //implements JsonSerializable
{
    public $trip_id;
    public $trip_name;
    public $destination;
    public $description;
    public $points_of_interest;
    public $photo_directory;
    public $mortal_id;
    public $color;
    public $date_start;
    public $date_end;
    //TODO change to array with data
    public static function initWithVariables(array $data): Trip{
        $newTrip = new Trip();

        $newTrip->trip_id = $data['trip_id'];
        $newTrip->trip_name = $data['trip_name'];
        $newTrip->destination = $data['destination'];
        $newTrip->description = $data['description'];
        $newTrip->points_of_interest = $data['points_of_interest'];
        $newTrip->photo_directory = $data['photo_directory'];
        $newTrip->color = $data['color'];
        $newTrip->mortal_id = $data['mortal_id'];
        $newTrip->setDateStart($data['date_start']);
        $newTrip->setDateEnd($data['date_end']);

        return $newTrip;
    }

    /**
     * @return mixed
     */
    public function getDateStart()
    {
        return $this->date_start;
    }

    /**
     * @param mixed $date_start
     * @return Trip
     */
    public function setDateStart($date_start)
    {
        $this->date_start = $date_start;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateEnd()
    {
        return $this->date_end;
    }

    /**
     * @param mixed $date_end
     * @return Trip
     */
    public function setDateEnd($date_end)
    {
        $this->date_end = $date_end;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getTripId()
    {
        return $this->trip_id;
    }

    /**
     * @param mixed $trip_id
     * @return Trip
     */
    public function setTripId($trip_id)
    {
        $this->trip_id = $trip_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTripName()
    {
        return $this->trip_name;
    }

    /**
     * @param mixed $trip_name
     * @return Trip
     */
    public function setTripName($trip_name)
    {
        $this->trip_name = $trip_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed $destination
     * @return Trip
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Trip
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPointsOfInterest()
    {
        return $this->points_of_interest;
    }

    /**
     * @param mixed $points_of_interest
     * @return Trip
     */
    public function setPointsOfInterest($points_of_interest)
    {
        $this->points_of_interest = $points_of_interest;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhotoDirectory()
    {
        return $this->photo_directory;
    }

    /**
     * @param mixed $photo_directory
     * @return Trip
     */
    public function setPhotoDirectory($photo_directory)
    {
        $this->photo_directory = $photo_directory;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMortalId()
    {
        return $this->mortal_id;
    }

    /**
     * @param mixed $mortal_id
     * @return Trip
     */
    public function setMortalId($mortal_id)
    {
        $this->mortal_id = $mortal_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     * @return Trip
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }


 /*   public function jsonSerialize()
    {
        return [
            'trip_id' => $this->getTripId(),
            'trip_name' => $this->getTripName(),
            'destination' => $this->getDestination(),
            'description' => $this->getDescription(),
            'points_of_interest' => $this->getPointsOfInterest(),
            'photo_directory' => $this->getPhotoDirectory(),
            'mortal_id' => $this->getMortalId(),
            'color' => $this->getColor(),
        ];
    }*/
}