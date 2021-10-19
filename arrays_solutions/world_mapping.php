<?php
$contents_cities = file_get_contents("https://dawsonferrer.com/allabres/apis_solutions/world.php?data=cities");
$cities = json_decode($contents_cities, true);
$contents_countries = file_get_contents("https://dawsonferrer.com/allabres/apis_solutions/world.php?data=countries");
$countries = json_decode($contents_countries, true);
function mapCities()
{
    global $cities;
    global $countries;
    foreach ($cities as $cityKey => $cityValue) {
        $countryKey = array_search($cityValue["CountryCode"], array_column($countries, 'Code'));
        $cities[$cityKey]["CountryName"] = $countries[$countryKey]["Name"];
    }
    return $cities;
}

function mapCities2(){
    global $cities;
    global $countries;
    foreach ($cities as $cityKey => $cityValue) {
        foreach ($countries as $countryKey => $countryValue){
            if($countryValue["Code"] == $cityValue["CountryCode"]){
                $cities[$cityKey]["CountryName"] = $countryValue["Name"];
            }
        }
    }
    return $cities;
}

function mapCities3(){
    global $cities;
    global $countries;
    for($i = 0; $i < count($cities); $i++){
        for($j=0; $j < count($countries); $j++){
            if($countries[$j]["Code"] == $cities[$i]["CountryCode"]){
                $cities[$i]["CountryName"] = $countries[$j]["Name"];
            }
        }
    }
    return $cities;
}

function mapCountries(){
    global $countries;
    global $cities;
    foreach ($countries as $countryKey => $countryValue){
        foreach ($cities as $cityKey => $cityValue){
            if($countryValue["Code"] == $cityValue["CountryCode"]){
                $countries[$countryKey]["Cities"][$cityValue["ID"]] = $cityValue["Name"];
            }
        }
    }
    return $countries;
}

//var_dump($cities[0]);
//var_dump(mapCities()[0]);
var_dump($countries[0]);
var_dump(mapCountries()[0]);