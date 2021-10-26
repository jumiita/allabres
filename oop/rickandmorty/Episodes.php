<?php

class Episodes {

    private $id;
    private $name;
    private $air_date;
    private $episode;
    private $created;
    private $characters; // Array

    public function __construct($id, $name, $air_date, $episode, $created, array $characters)
    {
        $this->id = $id;
        $this->name = $name;
        $this->air_date = $air_date;
        $this->episode = $episode;
        $this->created = $created;
        $this->characters = $characters;
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