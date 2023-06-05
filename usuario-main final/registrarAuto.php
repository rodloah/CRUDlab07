<?php
//print_r($_POST);
if (empty($_POST["placa"]) || empty($_POST["marca"]) || empty($_POST["color"]) || empty($_POST["año"])) {
    header('Location: index.php');
    exit();
}

include_once 'config/database.php';
$promocion = $_POST["placa"];
$duracion = $_POST["marca"];
$color = $_POST["color"];
$año = $_POST["año"];
$codigo = $_POST["codigo"];


$sentencia = $conn->prepare("INSERT INTO autos(placa,marca,color,año,id_usuario) VALUES (?,?,?,?,?);");
$resultado = $sentencia->execute([$promocion,$duracion,$color,$año, $codigo ]);

if ($resultado === TRUE) {
    header('Location: agregarAuto.php?codigo='.$codigo);
} 
