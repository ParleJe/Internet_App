<?php


class Trip
{
    private $trip_id;
    private $trip_name;
    private $destination;
    private $description;
    private $points_of_interest;
    private $photo_directory;
    private $mortal_id;
    private $color;

    public static function initWithVariables(?int $trip_id, string $trip_name, string $destination, string $description,
                                             string $points_of_interest, string $photo_directory,string $color, int $mortal_id): Trip{
        $newTrip = new Trip();

        $newTrip->trip_id = $trip_id;
        $newTrip->trip_name = $trip_name;
        $newTrip->destination = $destination;
        $newTrip->description = $description;
        $newTrip->points_of_interest = $points_of_interest;
        $newTrip->photo_directory = $photo_directory;
        $newTrip->color = $color;
        $newTrip->mortal_id = $mortal_id;

        return $newTrip;
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







}