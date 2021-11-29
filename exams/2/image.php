<?php

class image
{
    protected int $id;
    protected int $propertyId;
    protected string $url;

    /**
     * @param int $id
     * @param int $propertyId
     * @param string $url
     */
    public function __construct(int $id, int $propertyId, string $url)
    {
        $this->id = $id;
        $this->propertyId = $propertyId;
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPropertyId(): int
    {
        return $this->propertyId;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }


}