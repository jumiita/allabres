<?php
$contents = file_get_contents("https://dawsonferrer.com/allabres/apis_solutions/elephants.php");
$elephants = json_decode($contents, true);

function getSortedElephantsByNumber($elephants){
    $arrayModified = true;
    while($arrayModified){
        $arrayModified = false;
        for ($i = 0; $i < count($elephants)-1; $i++){
            if(intval($elephants[$i]["number"]) > intval($elephants[$i+1]["number"])){
                $temp = $elephants[$i];
                $elephants[$i] = $elephants[$i+1];
                $elephants[$i+1] = $temp;
                $arrayModified = true;
            }
        }
    }
    return $elephants;
}

$sortedElephants = getSortedElephantsByNumber($elephants);
?>

<html lang="es">
<head>
    <title>Elephants</title>
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
        <th colspan="6">Elephants (<?php echo count($elephants) ?>)</th>
    </tr>
    <tr>
        <th colspan="3">Unsorted elephants</th>
        <th colspan="3">Sorted elephants</th>
    </tr>
    <tr>
        <th>Number</th>
        <th>Name</th>
        <th>Species</th>
        <th>Number</th>
        <th>Name</th>
        <th>Species</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for($i = 0; $i < count($elephants); $i++){
        echo "<tr>";
        echo "<td>".$elephants[$i]["number"]."</td>";
        echo "<td>".$elephants[$i]["name"]."</td>";
        echo "<td>".$elephants[$i]["species"]."</td>";
        echo "<td>".$sortedElephants[$i]["number"]."</td>";
        echo "<td>".$sortedElephants[$i]["name"]."</td>";
        echo "<td>".$sortedElephants[$i]["species"]."</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
</body>
</html>
