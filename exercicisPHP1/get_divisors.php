<html lang="es">
<head>
    <title>Get divisors</title>
</head>
<body>
<form method="post" action="get_divisors.php">
    <label>
        Number:
        <input type="text" name="num"/>
    </label>
    <input type="submit"/>
</form>
<div>
    <?php
    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);
        //TODO: YOUR CODE HERE
    }
    ?>
</div>
</body>
</html>