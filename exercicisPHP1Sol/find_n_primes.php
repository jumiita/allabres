<html lang="es">
<head>
    <title>Find N prime numbers</title>
</head>
<body>
<form method="post" action="find_n_primes.php">
    <label>
        Number:
        <input type="text" name="num"/>
    </label>
    <input type="submit"/>
</form>
<div>
    <?php
    function getDivisors($num){
        $divisors = Array();
        for($i=1; $i<$num; $i++){
            if($num%$i == 0){
                $divisors[] = $i;
            }
        }
        return $divisors;
    }

    function isPrimeNum($num){
        $divisors = getDivisors($num);
        if(count($divisors) == 1){
            return true;
        }
        return false;
    }

    if (isset($_POST["num"])) {
        $num = intval($_POST["num"]);
        $i = 0;
        $primes = Array();
        while(count($primes) < $num){
            $i++;
            if(isPrimeNum($i)){
                $primes[] = $i;
            }
        }
        echo "First ".$num." prime numbers are: <br>";
        foreach ($primes as $prime) {
            echo "- ".$prime."<br>";
        }
    }
    ?>
</div>
</body>
</html>
