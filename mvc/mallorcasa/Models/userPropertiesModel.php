<?php

include_once "../Entities/country.php";
include_once "../Entities/state.php";
include_once "../Entities/city.php";
include_once "../Entities/neighborhood.php";
include_once "../Entities/image.php";
include_once "../Entities/property.php";
include_once "../Entities/user.php";
include_once "../DB/dbo.php";

class userPropertiesModel
{

    private dbo $db;

    public function __construct()
    {
        $this->db = new dbo();
    }

    public function getProperties($userId): array
    {
        $sql = "SELECT cities.name as cityName, cities.id as cityId, ";
        $sql .= "countries.name as countryName, countries.id as countryId, ";
        $sql .= "neighborhoods.name as neighborhoodName, neighborhoods.id as neighborhoodId, ";
        $sql .= "properties.id as propertyId, properties.zipcode as propertyZipcode, ";
        $sql .= "properties.latitude as propertyLatitude, properties.longitude as propertyLongitude, ";
        $sql .= "properties.date as propertyDate, properties.description as propertyDescription, properties.bathrooms as propertyBathrooms, ";
        $sql .= "properties.floor as propertyFloor, properties.rooms as propertyRooms, properties.surface as propertySurface, properties.price as propertyPrice, ";
        $sql .= "states.name as stateName, states.id as stateId, properties.userId as userId, users.mail as userMail, users.password as userPassword, ";
        $sql .= "(SELECT GROUP_CONCAT(CONCAT(id,',',url) SEPARATOR ';') FROM multimedias m2 WHERE m2.propertyId = properties.id) as images ";
        $sql .= "FROM properties ";
        $sql .= "INNER JOIN cities ON properties.cityId = cities.id ";
        $sql .= "INNER JOIN countries ON properties.countryId = countries.id ";
        $sql .= "INNER JOIN multimedias ON properties.id = multimedias.propertyId ";
        $sql .= "INNER JOIN neighborhoods ON properties.neighborhoodId = neighborhoods.id ";
        $sql .= "INNER JOIN states ON properties.stateId = states.id ";
        $sql .= "LEFT JOIN users ON properties.userId = users.id ";
        $sql .= "WHERE userId = " . $userId . " ";
        $sql .= "GROUP BY properties.id";

        $properties = array();
        $this->db->default();
        $query = $this->db->query($sql);
        while ($row = $query->fetch_assoc()) {
            $country = new country($row["countryId"], $row["countryName"]);
            $state = new state($row["stateId"], $row["stateName"]);
            $city = new city($row["cityId"], $row["cityName"]);
            $neighborhood = new neighborhood($row["neighborhoodId"], $row["neighborhoodName"]);
            if (!is_null($row["userId"])) {
                $user = new user($row["userId"], $row["userMail"], $row["userPassword"]);
            } else {
                $user = new user(0, "-", "-");
            }
            $images = array();
            $imagesStrArr = explode(";", $row["images"]);
            foreach ($imagesStrArr as $imageStr) {
                $imageArr = explode(",", $imageStr);
                $image = new image($imageArr[0], $row["propertyId"], $imageArr[1]);
                $images[] = $image;
            }

            $propertyDate = DateTime::createFromFormat('Y-m-d', $row["propertyDate"]);

            $property = new property($row["propertyId"], $country, $state, $city, $neighborhood, $row["propertyZipcode"], $row["propertyLatitude"], $row["propertyLongitude"], $propertyDate, $row["propertyDescription"], $row["propertyBathrooms"], $row["propertyFloor"], $row["propertyRooms"], $row["propertySurface"], $row["propertyPrice"], $user, $images);
            $properties[] = $property;
        }

        return $properties;
    }

    public function getProperty(int $propertyId): property
    {
        $sql = "SELECT cities.name as cityName, cities.id as cityId, ";
        $sql .= "countries.name as countryName, countries.id as countryId, ";
        $sql .= "neighborhoods.name as neighborhoodName, neighborhoods.id as neighborhoodId, ";
        $sql .= "properties.id as propertyId, properties.zipcode as propertyZipcode, ";
        $sql .= "properties.latitude as propertyLatitude, properties.longitude as propertyLongitude, ";
        $sql .= "properties.date as propertyDate, properties.description as propertyDescription, properties.bathrooms as propertyBathrooms, ";
        $sql .= "properties.floor as propertyFloor, properties.rooms as propertyRooms, properties.surface as propertySurface, properties.price as propertyPrice, ";
        $sql .= "states.name as stateName, states.id as stateId, properties.userId as userId, users.mail as userMail, users.password as userPassword, ";
        $sql .= "(SELECT GROUP_CONCAT(CONCAT(id,',',url) SEPARATOR ';') FROM multimedias m2 WHERE m2.propertyId = properties.id) as images ";
        $sql .= "FROM properties ";
        $sql .= "INNER JOIN cities ON properties.cityId = cities.id ";
        $sql .= "INNER JOIN countries ON properties.countryId = countries.id ";
        $sql .= "INNER JOIN multimedias ON properties.id = multimedias.propertyId ";
        $sql .= "INNER JOIN neighborhoods ON properties.neighborhoodId = neighborhoods.id ";
        $sql .= "INNER JOIN states ON properties.stateId = states.id ";
        $sql .= "LEFT JOIN users ON properties.userId = users.id ";
        $sql .= "WHERE properties.id = " . $propertyId . " ";
        $sql .= "GROUP BY properties.id;";

        $this->db->default();
        $query = $this->db->query($sql);
        $row = $query->fetch_assoc();
        $country = new country($row["countryId"], $row["countryName"]);
        $state = new state($row["stateId"], $row["stateName"]);
        $city = new city($row["cityId"], $row["cityName"]);
        $neighborhood = new neighborhood($row["neighborhoodId"], $row["neighborhoodName"]);
        if (!is_null($row["userId"])) {
            $user = new user($row["userId"], $row["userMail"], $row["userPassword"]);
        } else {
            $user = new user(0, "-", "-");
        }
        $images = array();
        $imagesStrArr = explode(";", $row["images"]);
        foreach ($imagesStrArr as $imageStr) {
            $imageArr = explode(",", $imageStr);
            $image = new image($imageArr[0], $row["propertyId"], $imageArr[1]);
            $images[] = $image;
        }

        $propertyDate = DateTime::createFromFormat('Y-m-d', $row["propertyDate"]);

        $property = new property($row["propertyId"], $country, $state, $city, $neighborhood, $row["propertyZipcode"], $row["propertyLatitude"], $row["propertyLongitude"], $propertyDate, $row["propertyDescription"], $row["propertyBathrooms"], $row["propertyFloor"], $row["propertyRooms"], $row["propertySurface"], $row["propertyPrice"], $user, $images);

        return $property;
    }

    public function sellProperty($propertyId)
    {
        $sql = "UPDATE properties SET userId = NULL WHERE id = " . $propertyId;
        $this->db->default();
        $this->db->query($sql);
        if ($this->db->affected_rows > 0) {
            $this->db->close();
            return true;
        }
        $this->db->close();
        return false;
    }

    public function buyProperty($propertyId, $userId)
    {
        $sql = "UPDATE properties SET userId = " . $userId . " WHERE id = " . $propertyId;
        $this->db->default();
        $this->db->query($sql);
        if ($this->db->affected_rows > 0) {
            $this->db->close();
            return true;
        }
        $this->db->close();
        return false;
    }
}