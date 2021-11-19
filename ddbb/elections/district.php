<?php

class district
{
    private int $id;
    private string $name;
    private int $delegates;

    /**
     * @param int $id
     * @param string $name
     * @param int $delegates
     */
    public function __construct(int $id, string $name, int $delegates)
    {
        $this->id = $id;
        $this->name = $name;
        $this->delegates = $delegates;
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
     * @return int
     */
    public function getDelegates(): int
    {
        return $this->delegates;
    }

    /**
     * @param int $delegates
     */
    public function setDelegates(int $delegates): void
    {
        $this->delegates = $delegates;
    }
}

