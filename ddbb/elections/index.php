<?php

include("result.php");
include("district.php");
include("party.php");
include("results.php");
include("parties.php");
include("districts.php");

//header('Content-Type: application/json');

$api_url = "https://dawsonferrer.com/allabres/apis_solutions/elections/api.php?data=";

$results = json_decode(file_get_contents($api_url . "results"), true);
$parties = json_decode(file_get_contents($api_url . "parties"), true);
$districts = json_decode(file_get_contents($api_url . "districts"), true);

function castParties(&$value, $key)
{
    $value = new party($value["id"], $value["name"], $value["acronym"], $value["logo"], $value["colour"]);
}

function castDistricts(&$value, $key)
{
    $value = new district($value["id"], $value["name"], $value["delegates"]);
}

array_walk($parties, 'castParties');
$parties = new parties($parties);
array_walk($districts, 'castDistricts');
$districts = new districts($districts);

function castResults(&$value, $key)
{
    global $parties;
    global $districts;
    $value = new result($key + 1, $districts->getDistrictByDistrictName($value["district"]), $parties->getPartyByPartyName($value["party"]), $value["votes"]);
}

array_walk($results, 'castResults');
$results = new results($results);
$results->setSeatsByDistricts($districts);

/*$query_partyAcronym = "PP";
$query_party = $parties->getPartyByPartyAcronym($query_partyAcronym);
$query_results = $results->getResultsByParty($query_party);

$query_districtName = "Barcelona";
$query_district = $districts->getDistrictByDistrictName($query_districtName);
$query_results = $results->getResultsByDistrict($query_district);*/

$query_districtId = "";
if(isset($_POST["district"])){
    $query_districtId = intval($_POST["district"]);
    $query_district = $districts->getDistrictByDistrictId($query_districtId);
    $district_results = $results->getResultsByDistrict($query_district);
}

?>

<html lang="es">
<head>
    <title>Election Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        table, th, td {
            border: 1px solid black;
            padding-left: 12px;
            padding-right: 12px;
        }
    </style>
</head>
<body>
<form action="index.php" method="post">
    <select name="district">
        <?php
        echo "<option value=''>Selecciona una circumscripción</option>\n";
        foreach ($districts->getDistricts() as $district) {
            echo "<option ".($query_districtId==$district->getId()?"selected":"")." value='".$district->getId()."'>".$district->getName()."</option>\n";
        }
        ?>
    </select>
    <input type="submit" value="Filtra"/>
</form>
<table>
    <?php
    if($query_districtId != ""){
        echo "<tr><th>Circumscripción</th><th>Partido</th><th>Votos</th><th>Escaños</th></tr>\n";
        foreach ($district_results as $district_result){
            echo "<tr><td>".$district_result->getDistrict()->getName()."</td><td>".$district_result->getParty()->getName()."</td><td>".$district_result->getVotes()."</td><td>".$district_result->getSeats()."</td></tr>\n";
        }
    }
    ?>
</table>
</body>