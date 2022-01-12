<?php

class dbo
{
    protected string $results = "";
    protected string $parties = "";
    protected string $districts = "";

    public function __construct()
    {
        $this->setDistricts();
        $this->setParties();
        $this->setResults();
    }


    /**
     * @return string
     */
    public function getResults(): string
    {
        return $this->results;
    }

    /**
     * @return string
     */
    public function getParties(): string
    {
        return $this->parties;
    }

    /**
     * @return string
     */
    public function getDistricts(): string
    {
        return $this->districts;
    }

    public function setResults(): void
    {
        $query = "SELECT electoral_districts.name as district, political_parties.name as party, electoral_results.votes as votes ";
        $query .= "FROM electoral_results ";
        $query .= "INNER JOIN political_parties ";
        $query .= "ON political_parties.id = electoral_results.political_party_id ";
        $query .= "INNER JOIN electoral_districts ";
        $query .= "ON electoral_districts.id = electoral_results.elecotoral_ditrict_id;";

        $mysqli = new mysqli("sql480.main-hosting.eu", "u850300514_default", "Default123+", "u850300514_default"); //PRO

        if ($results_query = $mysqli->query($query, MYSQLI_USE_RESULT)) {
            $results = $results_query->fetch_all(MYSQLI_ASSOC);
            $results_query->close();
            function castResultsInt(&$value, $key)
            {
                $value["votes"] = intval($value["votes"]);
            }
            array_walk($results, 'castResultsInt');

            $this->results = json_encode($results);
        }
    }

    public function setParties(): void
    {
        $query = "SELECT * ";
        $query .= "FROM political_parties;";

        $mysqli = new mysqli("sql480.main-hosting.eu", "u850300514_default", "Default123+", "u850300514_default"); //PRO

        if ($parties_query = $mysqli->query($query, MYSQLI_USE_RESULT)) {
            $parties = $parties_query->fetch_all(MYSQLI_ASSOC);
            $parties_query->close();
            function castPartiesInt(&$value, $key)
            {
                $value["id"] = intval($value["id"]);
            }
            array_walk($parties, 'castPartiesInt');
            $this->parties = json_encode($parties);
        }
    }

    public function setDistricts(): void
    {
        $query = "SELECT * ";
        $query .= "FROM electoral_districts;";

        $mysqli = new mysqli("sql480.main-hosting.eu", "u850300514_default", "Default123+", "u850300514_default"); //PRO

        if ($disctrits_query = $mysqli->query($query, MYSQLI_USE_RESULT)) {
            $districts = $disctrits_query->fetch_all(MYSQLI_ASSOC);
            $disctrits_query->close();
            function castDistrictsInt(&$value, $key)
            {
                $value["id"] = intval($value["id"]);
                $value["delegates"] = intval($value["delegates"]);
            }
            array_walk($districts, 'castDistrictsInt');
            $this->districts = json_encode($districts);
        }
    }
}