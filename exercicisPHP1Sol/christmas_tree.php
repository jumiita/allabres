<html lang="es">
<head>
    <title>Christmas tree</title>
</head>
<body>
<form method="post" action="christmas_tree.php">
    <label>
        Number of flats:
        <input type="text" name="numFlats"/>
    </label>
    <input type="submit"/>
</form>
<div style="background-color: skyblue; display: inline-block;">
    <?php
    if (isset($_POST["numFlats"])) {
        $numflats = intval($_POST["numFlats"]);
        for($l=0; $l<$numflats*2+1; $l++ ){
            echo "<span style='color: skyblue'>*</span>";
        }
        echo "<br>";
        for($i=$numflats; $i>0; $i--){
            for($j=$i; $j>0; $j--){
                echo "<span style='color: skyblue'>*</span>";
            }
            for($k = $i; $k<$numflats;$k++){
                echo "<span style='color: forestgreen'>*</span>";
            }
            echo "<span style='color: forestgreen'>*</span>";
            for($k = $i; $k<$numflats;$k++){
                echo "<span style='color: forestgreen'>*</span>";
            }
            for($j=$i; $j>0; $j--){
                echo "<span style='color: skyblue'>*</span>";
            }
            echo "<br>";
        }
        for($l=0; $l<$numflats*2+1; $l++ ){
            echo "<span style='color: skyblue'>*</span>";
        }
    }
    ?>
</div>
</body>
</html>