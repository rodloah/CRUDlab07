<?php

 $user = "root";
 $pass = "";
 $host = "localhost";
 $bd= "auto";
 
//conetamos al base datos
$conn = mysqli_connect($host, $user, $pass, $bd);

if ($conn->connect_error) {
    die("Error de conexión" . $conn->connect_error);
}

