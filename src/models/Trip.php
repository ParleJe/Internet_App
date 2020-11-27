<?php


class Trip
{
    private $name;
    private $description;
    private $image;
    private $steps;

    //TODO WHOLE CLASS

    public function __construct(string $name, string $description,  $image,array $steps)
    {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->steps = $steps;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * @param mixed $steps
     */
    public function setSteps($steps)
    {
        $this->steps = $steps;
    }



}