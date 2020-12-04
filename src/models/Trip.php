<?php


class Trip
{
    private $name;
    private $localization;
    private $description;
    private $steps;
    private $photo;
    //TODO WHOLE CLASS

    public function __construct( string $name,string $localization, string $description, string $steps, string $photo )
    {
        $this->name = $name;
        $this->localization = $localization;
        $this->description = $description;
        $this->steps = $steps;
        $this->photo = $photo;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }


    public function getSteps()
    {
        return $this->steps;
    }

    public function setSteps($steps)
    {
        $this->steps = $steps;
    }

    public function getLocalization(): string
    {
        return $this->localization;
    }


    public function setLocalization(string $localization): void
    {
        $this->localization = $localization;
    }


    public function getPhoto(): string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }




}