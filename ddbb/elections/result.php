<?php

class result
{
    private int $id;
    private district $district;
    private party $party;
    private int $votes;
    private int $seats = 0;

    /**
     * @param int $id
     * @param district $district
     * @param party $party
     * @param int $votes
     */
    public function __construct(int $id, district $district, party $party, int $votes)
    {
        $this->id = $id;
        $this->district = $district;
        $this->party = $party;
        $this->votes = $votes;
    }

    /**
     * @param array $result
     */
    public function __construct_from_array_assoc(array $result)
    {
        $this->id = $result["id"];
        $this->district = $result["district"];
        $this->party = $result["party"];
        $this->votes = $result["district"];
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
     * @return district
     */
    public function getDistrict(): district
    {
        return $this->district;
    }

    /**
     * @param district $district
     */
    public function setDistrict(district $district): void
    {
        $this->district = $district;
    }

    /**
     * @return party
     */
    public function getParty(): party
    {
        return $this->party;
    }

    /**
     * @param party $party
     */
    public function setParty(party $party): void
    {
        $this->party = $party;
    }

    /**
     * @return int
     */
    public function getVotes(): int
    {
        return $this->votes;
    }

    /**
     * @param int $votes
     */
    public function setVotes(int $votes): void
    {
        $this->votes = $votes;
    }

    /**
     * @return int
     */
    public function getSeats(): int
    {
        return $this->seats;
    }

    /**
     * @param int $seats
     */
    public function setSeats(int $seats): void
    {
        $this->seats = $seats;
    }
}