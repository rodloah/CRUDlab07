<?php

session_start();

require 'config/database.php';


$id = $conn->real_escape_string($_POST["id"]);
$nombres = $conn->real_escape_string($_POST["nombres"]);
$apellidos = $conn->real_escape_string($_POST["apellidos"]);
$correo = $conn->real_escape_string($_POST["correo"]);
$dni = $conn->real_escape_string($_POST["dni"]);
$celular = $conn->real_escape_string($_POST["celular"]);
$fecha_nac = $conn->real_escape_string($_POST["fecha_nac"]);



$sql = "UPDATE usuario SET nombre='$nombres', apellidos='$apellidos', correo='$correo', dni='$dni', 
celular='$celular', fecha_nacimiento='$fecha_nac' WHERE id_usuario=$id";

if ($conn->query($sql)) {

    $_SESSION['color'] = "success";
    $_SESSION['msg'] = "Usuario actualizado";
   
} else{
    $_SESSION['color'] = "danger";
    $_SESSION['msg'] = "Error al cargar datos";
}

header('Location: index.php');
