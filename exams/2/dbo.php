<?php

include_once "country.php";
include_once "state.php";
include_once "city.php";
include_once "neighborhood.php";
include_once "image.php";
include_once "property.php";

class dbo extends mysqli
{
    protected string $hostname = "localhost";
    protected string $username = "root";
    protected string $password = "";
    protected string $database = "examen2";

    public function default()
    {
        $this->local();
    }

    public function local()
    {
        parent::__construct($this->hostname, $this->username, $this->password, $this->database);

        if (mysqli_connect_error()) {
            die("ERROR DATABASE: " . mysqli_connect_error());
        }
    }

    public function getCountry($id): country
    {
        $sql = "SELECT * FROM countries WHERE id = " . $id;
        $this->default();
        $query = $this->query($sql);
        $this->close();
        $result = $query->fetch_assoc();
        $return = new country($result["id"], $result["name"]);
        return $return;
    }

    public function getState($id): state
    {
        $sql = "SELECT * FROM states WHERE id = " . $id;
        $this->default();
        $query = $this->query($sql);
        $this->close();
        $result = $query->fetch_assoc();
        $return = new state($result["id"], $result["name"]);
        return $return;
    }

    public function getCity($id): city
    {
        $sql = "SELECT * FROM cities WHERE id = " . $id;
        $this->default();
        $query = $this->query($sql);
        $this->close();
        $result = $query->fetch_assoc();
        $return = new city($result["id"], $result["name"]);
        return $return;
    }

    public function getNeighborhood($id): neighborhood
    {
        $sql = "SELECT * FROM neighborhoods WHERE id = " . $id;
        $this->default();
        $query = $this->query($sql);
        $this->close();
        $result = $query->fetch_assoc();
        $return = new neighborhood($result["id"], $result["name"]);
        return $return;
    }

    public function getImages($propertyId): array
    {
        $sql = "SELECT * FROM multimedias WHERE propertyId = " . $propertyId;
        $this->default();
        $query = $this->query($sql);
        $this->close();
        $return = array();
        while ($result = $query->fetch_assoc()) {
            $return[] = new image($result["id"], $result["propertyId"], $result["url"]);
        }
        return $return;
    }

    public function getproperties(): array
    {
        $sql = "SELECT * FROM properties;";
        $this->default();
        $query = $this->query($sql);
        $this->close();
        $return = array();
        while ($result = $query->fetch_assoc()) {
            $return[] = new property($result["id"], $this->getCountry($result["countryId"]), $this->getState($result["stateId"]),
                $this->getCity($result["cityId"]), $this->getNeighborhood($result["neighborhoodId"]), $result["zipcode"],
                $result["latitude"], $result["longitude"], DateTime::createFromFormat("Y-m-d", $result["date"]), $result["description"],
                $result["bathrooms"], $result["floor"], $result["rooms"], $result["surface"], $result["price"], $this->getImages($result["id"]));
        }
        return $return;
    }

    public function getproperty($id): property
    {
        $sql = "SELECT * FROM properties WHERE id = " . $id;
        $this->default();
        $query = $this->query($sql);
        $this->close();
        $result = $query->fetch_assoc();
        $return = new property($result["id"], $this->getCountry($result["countryId"]), $this->getState($result["stateId"]),
            $this->getCity($result["cityId"]), $this->getNeighborhood($result["neighborhoodId"]), $result["zipcode"],
            $result["latitude"], $result["longitude"], DateTime::createFromFormat("Y-m-d", $result["date"]), $result["description"],
            $result["bathrooms"], $result["floor"], $result["rooms"], $result["surface"], $result["price"], $this->getImages($result["id"]));

        return $return;
    }
}