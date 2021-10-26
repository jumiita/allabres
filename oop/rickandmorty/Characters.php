<?php

class Characters {
    private $id;
    private $name;
    private $status;
    private $species;
    private $type;
    private $gender;
    private $origin;
    private $location;
    private $image;
    private $created;
    private $episodes; // Array

    public function __construct($id, $name, $status, $species, $type, $gender, $origin, $location, $image, $created, array $episodes)
    {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->species = $species;
        $this->type = $type;
        $this->gender = $gender;
        $this->origin = $origin;
        $this->location = $location;
        $this->image = $image;
        $this->created = $created;
        $this->episodes = $episodes;
    }

    /**
     * @param mixed $origin
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @param array $episodes
     */
    public function setEpisodes($episodes)
    {
        $this->episodes= $episodes;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return mixed
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return array
     */
    public function getEpisodes()
    {
        return $this->episodes;
    }
}

?>