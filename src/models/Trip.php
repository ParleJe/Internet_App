<?php


class Trip implements JsonSerializable
{

    private ?int $trip_id;
    private ?string $trip_name;
    private ?string $destination;
    private ?string $description;
    private ?string $points_of_interest;
    private ?string $photo_directory;
    private ?int $mortal_id;
    private ?string $color;
    //______PLANNED_TRIP______
    private ?int $planned_trip_id;
    private ?string $date_start;
    private ?string $date_end;
    private ?string $vulp_code;

    public function __construct(array $data = null)
    {
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

    public function getTripId(): ?int
    {
        return $this->trip_id;
    }

    public function setTripId(?int $trip_id)
    {
        $this->trip_id = $trip_id;
    }

    public function getTripName(): ?string
    {
        return $this->trip_name;
    }

    public function setTripName(?string $trip_name)
    {
        $this->trip_name = $trip_name;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(?string $destination)
    {
        $this->destination = $destination;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description)
    {
        $this->description = $description;
    }

    public function getPointsOfInterest(): ?string
    {
        return $this->points_of_interest;
    }

    public function setPointsOfInterest(?string $points_of_interest)
    {
        $this->points_of_interest = $points_of_interest;
    }

    public function getPhotoDirectory(): ?string
    {
        return $this->photo_directory;
    }

    public function setPhotoDirectory(?string $photo_directory)
    {
        $this->photo_directory = $photo_directory;
    }

    public function getMortalId(): ?int
    {
        return $this->mortal_id;
    }

    public function setMortalId(?int $mortal_id)
    {
        $this->mortal_id = $mortal_id;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color)
    {
        $this->color = $color;
    }

    public function getPlannedTripId(): ?int
    {
        return $this->planned_trip_id;
    }

    public function setPlannedTripId(?int $planned_trip_id)
    {
        $this->planned_trip_id = $planned_trip_id;
    }

    public function getDateStart(): ?string
    {
        return $this->date_start;
    }

    public function setDateStart(?string $date_start)
    {
        $this->date_start = $date_start;
    }

    public function getDateEnd(): ?string
    {
        return $this->date_end;
    }

    public function setDateEnd(?string $date_end)
    {
        $this->date_end = $date_end;
    }

    public function getVulpCode(): ?string
    {
        return $this->vulp_code;
    }

    public function setVulpCode(?string $vulp_code)
    {
        $this->vulp_code = $vulp_code;
    }


}