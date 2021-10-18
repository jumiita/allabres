<?php

$contents_cities = file_get_contents("https://dawsonferrer.com/allabres/apis_solutions/world.php?data=cities");
$cities = json_decode($contents_cities, true);
$contents_countries = file_get_contents("https://dawsonferrer.com/allabres/apis_solutions/world.php?data=countries");
$countries = json_decode($contents_countries, true);

function mapCities()
{
    //TODO: Your code here
}

function mapCountries()
{
    //TODO: Your code here
}

var_dump(mapCities());
var_dump(mapCountries());