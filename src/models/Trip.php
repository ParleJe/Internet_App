<?php


class Trip implements JsonSerializable
{

    private $trip_id;
    private $trip_name;
    private $destination;
    private $description;
    private $points_of_interest;
    private $photo_directory;
    private $mortal_id;
    private $color;
    //______PLANNED_TRIP______
    private $planned_trip_id;
    private $date_start;
    private $date_end;
    private $vulp_code;

    public function __construct(array $data = null){
        if(! is_null($data)) {
            $this->setTripId($data['trip_id']);
            $this->setTripName($data['trip_name']);
            $this->setDestination($data['destination']);
            $this->setDescription($data['description']);
            $this->setPointsOfInterest($data['points_of_interest']);
            $this->setPhotoDirectory($data['photo_directory']);
            $this->setMortalId($data['mortal_id']);
            $this->setColor($data['color']);
            $this->setPlannedTripId($data['planned_trip_id']);
            $this->setDateStart($data['date_start']);
            $this->setDateEnd($data['date_end']);
            $this->setVulpCode($data['vulp_code']);
        }
    }

    public function jsonSerialize(): array
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
            'planned_trip_id' => $this->getPlannedTripId(),
            'date_start' => $this->getDateStart(),
            'date_end' => $this->getDateEnd(),
            'vulp_code' => $this->getVulpCode()
        ];
    }

    public function getPlannedTripId() {
    return $this->planned_trip_id;
}

    public function setPlannedTripId( $planned_trip_id) {
    $this->planned_trip_id = $planned_trip_id;
}
    /**
     * @return mixed
     */
    public function getVulpCode() {
        return $this->vulp_code;
    }


    public function setVulpCode( $vulp_code) {
        $this->vulp_code = $vulp_code;
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