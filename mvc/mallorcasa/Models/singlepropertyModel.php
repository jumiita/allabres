<?php
include_once "../Entities/country.php";
include_once "../Entities/state.php";
include_once "../Entities/city.php";
include_once "../Entities/neighborhood.php";
include_once "../Entities/image.php";
include_once "../Entities/property.php";
include_once "../Entities/user.php";
include_once "../DB/dbo.php";

class singlepropertyModel
{
    private dbo $db;

    public function __construct()
    {
        $this->db = new dbo();
    }

    public function getCountry($id): country
    {
        $sql = "SELECT * FROM countries WHERE id = " . $id;
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new country($result["id"], $result["name"]);
        return $return;
    }

    public function getState($id): state
    {
        $sql = "SELECT * FROM states WHERE id = " . $id;
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new state($result["id"], $result["name"]);
        return $return;
    }

    public function getCity($id): city
    {
        $sql = "SELECT * FROM cities WHERE id = " . $id;
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new city($result["id"], $result["name"]);
        return $return;
    }

    public function getNeighborhood($id): neighborhood
    {
        $sql = "SELECT * FROM neighborhoods WHERE id = " . $id;
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new neighborhood($result["id"], $result["name"]);
        return $return;
    }

    public function getImages($propertyId): array
    {
        $sql = "SELECT * FROM multimedias WHERE propertyId = " . $propertyId;
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $return = array();
        while ($result = $query->fetch_assoc()) {
            $return[] = new image($result["id"], $result["propertyId"], $result["url"]);
        }
        return $return;
    }

    public function getproperty_deprecated($id): property
    {
        $sql = "SELECT * FROM properties WHERE id = " . $id;
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        $result = $query->fetch_assoc();
        $return = new property($result["id"], $this->getCountry($result["countryId"]), $this->getState($result["stateId"]),
            $this->getCity($result["cityId"]), $this->getNeighborhood($result["neighborhoodId"]), $result["zipcode"],
            $result["latitude"], $result["longitude"], DateTime::createFromFormat("Y-m-d", $result["date"]), $result["description"],
            $result["bathrooms"], $result["floor"], $result["rooms"], $result["surface"], $result["price"], $this->getImages($result["id"]));

        return $return;
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
        if(!is_null($row["userId"])){
            $user = new user($row["userId"], $row["userMail"], $row["userPassword"]);
        }else{
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
}