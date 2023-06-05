<?php

session_start();

require 'config/database.php';

$id = $conn->real_escape_string($_POST["id"]);

$sql = "DELETE FROM usuario WHERE id_usuario = $id";
if ($conn->query($sql)) {

    $_SESSION['color'] = "success";
    $_SESSION['msg'] = "Usuario eliminado";
} else {
    $_SESSION['color'] = "danger";
    $_SESSION['msg'] = "Error al eliminar usuario";
}

header('Location: index.php');
