<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fare</title>
</head>
<body>
    <form action="" method="post">
        <input type="number" name="a" id="a" placeholder="Age" min="10" max="80">
        <br>
        <input type="number" name="d" id="d" placeholder="Distance(km)">
        
        <br>
        <button type="submit"name="btn_submit">Compute</button>
    </form>

</body>
</html>

<?php
   include "Fare.php";

    if(isset($_POST['btn_submit'])){
        $a = $_POST['a'];
        $d = $_POST['d'];
        

        
        $fare = new Fare;

        $fare->setAge($a);
        $fare->setDistance($d);
        $fare->calculateFare();
        

        echo "<br>Age: " . $fare->getAge() . "years old<br>";
        echo "Distance: " . $fare->getDistance() . "km<br>";
        echo "Fare: " . $fare->calculateFare() . "<br>";
    
    }

?>