<?php

class districts
{
    private array $districts;

    /**
     * @param array $districts
     */
    public function __construct(array $districts)
    {
        $this->districts = $districts;
    }

    /**
     * @return district
     */
    public function getDistrictByDistrictName(string $districtName): district
    {
        $districts_names = array_map(function ($item) { return $item->getName(); }, $this->districts);
        $district_key = array_search($districtName, $districts_names);
        return $this->districts[$district_key];
    }

    /**
     * @return district
     */
    public function getDistrictByDistrictId(string $districtId): district
    {
        $districts_ids = array_map(function ($item) { return $item->getId(); }, $this->districts);
        $district_key = array_search($districtId, $districts_ids);
        return $this->districts[$district_key];
    }

    /**
     * @return array
     */
    public function getDistricts(): array
    {
        return $this->districts;
    }
}