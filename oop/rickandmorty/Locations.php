<?php

class Locations {

    private $id;
    private $name;
    private $type;
    private $dimensio;
    private $created;
    private $residents; // Array

    public function __construct($id, $name, $type, $dimensio, $created, array $residents)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->dimensio = $dimensio;
        $this->created = $created;
        $this->residents = $residents;
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
}

?>