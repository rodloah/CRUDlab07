
<?php
include_once 'config/database.php';
$dir = "foto/";
$codigo = $_GET['codigo'];

require 'config/database.php';

$resultadopersona ="SELECT * FROM usuario WHERE id_usuario =".$codigo;
$consultapersona = $conn->query($resultadopersona);
$persona=$consultapersona->fetch_assoc();
$resultadoautos ="SELECT * FROM autos WHERE id_usuario=".$codigo;
$consultaautos = $conn->query($resultadoautos);

//$sentencia = $conn->prepare("select * from usuario where id_usuario = ?;");
//$sentencia->execute([$codigo]);
//$persona = $sentencia->fetch(PDO::FETCH_OBJ);

//$sentencia_promocion = $conn->prepare("select * from autos where id_usuario = ?;");
//$sentencia_promocion->execute([$codigo]);
//$promocion = $sentencia_promocion->fetchAll(PDO::FETCH_OBJ); 
//print_r($persona);
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- cdn icnonos-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body class="d-flex flex-column h-100">

<div class="container mt-5" >
    <div class="row justify-content-center" >
        <div class="col-4" >
            <div class="card">
                <div class="card-header">
                    Ingresar datos para Autos : <br><?=$persona['nombre'].' '.$persona['apellidos'];?>
                </div>
                <form action="registrarAuto.php" method="post" enctype="multipart/form-data" style="color:black; background-color: #000000; opacity: 0.9;">
                    <div class="mb-3">
                        <label for="placa" class="form-label" style="color:orange">Placa:</label>
                        <input type="text" name="placa" id="placa" class="form-control" required placeholder="Ingrese la Placa">
                    </div>
                    <div class="mb-3">
                        <label for="marca" class="form-label"style="color:orange">Marca:</label>
                        <input type="text" name="marca" id="marca" class="form-control" required placeholder="Ingrese la Marca">
                    </div>
                    
                    <div class="mb-3">
                        <label for="color" class="form-label"style="color:orange">Color:</label>
                        <input type="text" name="color" id="color" class="form-control" required placeholder="Ingrese el Color">
                    </div>
                    <div class="mb-3">
                        <label for="año" class="form-label"style="color:orange">Año:</label>
                        <input type="number" name="año" id="año" class="form-control" required placeholder="Ingrese el año">
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="codigo" value="<?=$persona['id_usuario']; ?>"><P></P>
                        <input type="submit" class="btn btn-primary" value="Registrar" style="background-color: orange; color: black;">

                    </div>
                </form>
            </div> 
        </div>
        <div class="col-8">
            <div class="card" >
                <div class="card-header" >
                    Lista de Autos
                </div>
                <div class="col-12">
                    <table class="table table-sm table-striped table-hover mt-4">
                        <thead class="table-dark" style="color:orange">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Placa</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Color</th>
                                <th scope="col">Año</th>
                                <th scope="col" colspan="3">Opciones</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php while ($row = $consultaautos->fetch_assoc()) { ?>
                                <tr>
            
                                    <td><?= $row['id_autos']; ?></td>
                                    <td><?= $row['placa']; ?></td>
                                    <td><?= $row['marca']; ?></td>
                                    <td><?= $row['color']; ?></td>
                                    <td><?= $row['año']; ?></td>
                                    <td><a class="text-dark" href="enviarMensaje.php?codigo=<?= $row['id_autos'] ?>"><i class="bi bi-cursor"></i></a></td>
                                    
                                    <td><a class="text-dark" href="enviarImagen.php?codigo=<?= $row['id_autos'] ?>"><i class="bi bi-card-image"></i></a></td>

                                    <td><a class="text-dark" href="enviarVideo.php?codigo=<?= $row['id_autos'] ?>"><i class="bi bi-camera-video-fill"></i></a></td>

                                    <td><a class="text-dark" href="enviarAudi.php?codigo=<?= $row['id_autos'] ?>"><i class="bi bi-mic-fill"></i></a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
 <script src="assets/js/bootstrap.bundle.min.js"></script> 

</body>

</html>