<?php
$contents = file_get_contents("https://dawsonferrer.com/allabres/apis_solutions/world.php?data=world");
$world = json_decode($contents, true);

function getUnsortedCities($world){
    $cities = array();
    foreach ($world as $country){
        if(isset($country["Cities"])){
            foreach ($country["Cities"] as $city){
                $cities[] = $city;
            }
        }
    }
    return $cities;
}

function getSortedCitiesByPopulation($cities){
    $arrayModified = true;
    while($arrayModified){
        $arrayModified = false;
        for ($i = 0; $i < count($cities)-1; $i++){
            if(intval($cities[$i]["Population"]) > intval($cities[$i+1]["Population"])){
                $temp = $cities[$i];
                $cities[$i] = $cities[$i+1];
                $cities[$i+1] = $temp;
                $arrayModified = true;
            }
        }
    }
    return $cities;
}

$unsortedCities = getUnsortedCities($world);
$sortedCities = getSortedCitiesByPopulation($unsortedCities);
?>
<html lang="es">
<head>
    <title>Cities of the world</title>
    <style>
        table, th, td {
            border: 1px solid black;
            padding-left: 5px;
            padding-right: 5px;
        }
        table {
            border-collapse: collapse;
        }
        thead {
            background-color: aquamarine;
        }
        tbody {
            background-color: aqua;
        }
    </style>
</head>
<body>
<table>
    <thead>
        <tr>
            <th colspan="6">Cities of the world (<?php echo count($unsortedCities) ?>)</th>
        </tr>
        <tr>
            <th colspan="3">Unsorted cities</th>
            <th colspan="3">Sorted cities</th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Population</th>
            <th>ID</th>
            <th>Name</th>
            <th>Population</th>
        </tr>
    </thead>
    <tbody>
        <?php
        for($i = 0; $i < count($sortedCities); $i++){
            echo "<tr>";
            echo "<td>".$unsortedCities[$i]["ID"]."</td>";
            echo "<td>".$unsortedCities[$i]["Name"]."</td>";
            echo "<td>".$unsortedCities[$i]["Population"]."</td>";
            echo "<td>".$sortedCities[$i]["ID"]."</td>";
            echo "<td>".$sortedCities[$i]["Name"]."</td>";
            echo "<td>".$sortedCities[$i]["Population"]."</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
</body>
</html>