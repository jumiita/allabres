<?php

class parties
{
    private array $parties;

    /**
     * @param array $parties
     */
    public function __construct(array $parties)
    {
        $this->parties = $parties;
    }

    /**
     * @return party
     */
    public function getPartyByPartyName(string $partyName): party
    {
        $parties_names = array_map(function ($item) { return $item->getName(); }, $this->parties);
        $party_key = array_search($partyName, $parties_names);
        return $this->parties[$party_key];
    }

    /**
     * @return party
     */
    public function getPartyByPartyAcronym(string $partyAcronym): party
    {
        $parties_acronyms = array_map(function ($item) { return $item->getAcronym(); }, $this->parties);
        $party_key = array_search($partyAcronym, $parties_acronyms);
        return $this->parties[$party_key];
    }

    /**
     * @return party
     */
    public function getPartyByPartyId(int $partyId): party
    {
        $parties_ids = array_map(function ($item) { return $item->getId(); }, $this->parties);
        $party_key = array_search($partyId, $parties_ids);
        return $this->parties[$party_key];
    }

    /**
     * @return array
     */
    public function getParties(): array
    {
        return $this->parties;
    }


}