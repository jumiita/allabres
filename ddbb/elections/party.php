<?php

class party
{
    private int $id;
    private string $name;
    private string $acronym;
    private string $logo;
    private string $colour;

    /**
     * @param $id
     * @param $name
     * @param $acronym
     * @param $logo
     */
    public function __construct(int $id, string $name, string $acronym, string $logo, string $colour)
    {
        $this->id = $id;
        $this->name = $name;
        $this->acronym = $acronym;
        $this->logo = $logo;
        $this->colour = $colour;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAcronym(): string
    {
        return $this->acronym;
    }

    /**
     * @param string $acronym
     */
    public function setAcronym(string $acronym): void
    {
        $this->acronym = $acronym;
    }

    /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     */
    public function setLogo(string $logo): void
    {
        $this->logo = $logo;
    }

    /**
     * @return string
     */
    public function getColour(): string
    {
        return $this->colour;
    }

    /**
     * @param string $colour
     */
    public function setColour(string $colour): void
    {
        $this->colour = $colour;
    }



}