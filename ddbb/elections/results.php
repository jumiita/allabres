<?php

class results
{
    private array $results;

    /**
     * @param array $results
     */
    public function __construct(array $results)
    {
        $this->results = $results;
    }

    private function orderResultsByVotes($results)
    {
        for ($i = 0; $i < count($results); $i++) {
            for ($j = $i; $j < count($results); $j++) {
                if ($results[$i]->getVotes() < $results[$j]->getVotes()) {
                    $temp = $results[$i];
                    $results[$i] = $results[$j];
                    $results[$j] = $temp;
                }
            }
        }
        return $results;
    }

    private function orderResultsById($results)
    {
        for ($i = 0; $i < count($results); $i++) {
            for ($j = $i; $j < count($results); $j++) {
                if ($results[$i]->getId() > $results[$j]->getId()) {
                    $temp = $results[$i];
                    $results[$i] = $results[$j];
                    $results[$j] = $temp;
                }
            }
        }
        return $results;
    }

    private function getResultKeyById(int $id) : int{
        $results_ids = array_map(function ($item) { return $item->getId(); }, $this->results);
        return array_search($id, $results_ids);
    }

    public function setSeatsByDistricts(districts $districts): void
    {
        foreach ($districts->getDistricts() as $district) {
            $districtResults = $this->getResultsByDistrict($district);

            $totalVotes = 0;
            foreach ($districtResults as $districtResult){
                $totalVotes += $districtResult->getVotes();
            }

            $skewedResults = array();
            foreach ($districtResults as $districtResult){
                if((3*$totalVotes/100) < $districtResult->getVotes()){
                    $skewedResults[] = $districtResult;
                }
            }

            $skewedResults = array_map(function ($o) { return clone $o; }, $skewedResults);

            for ($i = 0; $i < $district->getDelegates(); $i++) {
                $skewedResults = $this->orderResultsByVotes($skewedResults);
                $skewedResults[0]->setSeats($skewedResults[0]->getSeats() + 1);

                //GET THE VOTES FROM ORIGINAL RESULT
                $id = $skewedResults[0]->getId();
                $result_key = $this->getResultKeyById($id);
                $initialVotes = $this->results[$result_key]->getVotes();

                $skewedResults[0]->setVotes($initialVotes / ($skewedResults[0]->getSeats()+1));
            }
            $skewedResults = $this->orderResultsById($skewedResults);

            for ($i = 0; $i < count($skewedResults); $i++) {
                $id = $skewedResults[$i]->getId();
                $result_key = $this->getResultKeyById($id);
                $this->results[$result_key]->setSeats($skewedResults[$i]->getSeats());
            }
        }
    }

    /**
     * @return array
     */
    public function getResultsByDistrict(district $district): array
    {
        $results = array();
        foreach ($this->results as $result) {
            if ($result->getDistrict() == $district) {
                $results[] = $result;
            }
        }
        $results = $this->orderResultsByVotes($results);
        return $results;
    }

    /**
     * @return array
     */
    public function getResultsByParty(party $party): array
    {
        $results = array();
        foreach ($this->results as $result) {
            if ($result->getParty() == $party) {
                $results[] = $result;
            }
        }
        return $results;
    }

    /**
     * @return array
     */
    public function getGeneralResultsByParties(parties $parties): array
    {
        $results = array();
        foreach ($parties->getParties() as $party){
            $partyResults = $this->getResultsByParty($party);
            $partyVotes = 0;
            $partySeats = 0;
            foreach ($partyResults as $partyResult){
                $partyVotes += $partyResult -> getVotes();
                $partySeats += $partyResult -> getSeats();
            }
            $result = new result(0, new district(0,"General",350), $party,$partyVotes);
            $result->setSeats($partySeats);
            $results[] = $result;
        }
        return $results;
    }

}