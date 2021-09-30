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
        //TODO: YOUR CODE HERE  0
    }
    ?>
</div>
</body>
</html>