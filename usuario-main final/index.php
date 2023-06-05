<?php

session_start();

require 'config/database.php';

$resultado ="SELECT * FROM usuario";
$consulta = $conn->query($resultado);


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
</head>

<body class="d-flex flex-column h-100">

    <div class="container py-3">

        <h2 class="text-center">Usuarios</h2>

        <hr>

        <?php if (isset($_SESSION['msg']) && isset($_SESSION['color'])) { ?>
            <div class="alert alert-<?= $_SESSION['color']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        <?php
            unset($_SESSION['color']);
            unset($_SESSION['msg']);
        } ?>

        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal" style="background-color: orange; color: black;"><i class="fa-solid fa-circle-plus"></i> Nuevo registro</a>
            </div>
        </div>

        <table class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark" style="color:orange">
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th >Apellidos</th>
                    <th>Correo</th>
                    <th>DNI</th>
                    <th>Celular</th>
                    <th>Fecha Nacimiento</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $consulta->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id_usuario']; ?></td>
                        <td><?= $row['nombre']; ?></td>
                        <td><?= $row['apellidos']; ?></td>
                        <td><?= $row['correo']; ?></td>
                        <td><?= $row['dni']; ?></td>
                        <td><?= $row['celular']; ?></td>
                        <td><?= $row['fecha_nacimiento']; ?></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editaModal" data-bs-id="<?= $row['id_usuario']; ?>"><i class="fa-solid fa-pen-to-square"></i> Editar</a>

                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#eliminaModal" data-bs-id="<?= $row['id_usuario']; ?>"><i class="fa-solid fa-trash"></i> Eliminar</a>

                            <a class="btn btn-sm btn-warning" href="agregarAuto.php?codigo=<?= $row['id_usuario']; ?>"><i class="bi bi-cart3">Agregar auto</i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>

    <?php include 'nuevoModal.php'; ?>
    <?php include 'editaModal.php'; ?>
    <?php include 'eliminaModal.php'; ?>
    
    <script>
        let editaModal=document.getElementById('editaModal')
        editaModal.addEventListener('shown.bs.modal', event=> {
            let button = event.relatedTarget
            let id= button.getAttribute('data-bs-id')
            let inputId = editaModal.querySelector('.modal-body #id')
            let inputNombre = editaModal.querySelector('.modal-body #nombres')
            let inputApellidos = editaModal.querySelector('.modal-body #apellidos')
            let inputCorreo = editaModal.querySelector('.modal-body #correo')
            let inputDNI = editaModal.querySelector('.modal-body #dni')
            let inputCelular = editaModal.querySelector('.modal-body #celular')
            let inputFechanac = editaModal.querySelector('.modal-body #fecha_nac')

            let url= "getUsuario.php"
            let formData = new FormData()
            formData.append('id',id)

            fetch(url,{
                method: "POST", 
                body: formData
            }).then(response => response.json())
            .then(data => {
                inputId.value = data.id_usuario
                inputNombre.value = data.nombre
                inputApellidos.value = data.apellidos
                inputCorreo.value = data.correo
                inputDNI.value = data.dni
                inputCelular.value = data.celular
                inputFechanac.value = data.fecha_nacimiento

            }).catch(err => console.log(err))
        })

        eliminaModal.addEventListener('shown.bs.modal', event=>{
            let button = event.relatedTarget
            let id= button.getAttribute('data-bs-id')
            eliminaModal.querySelector('.modal-footer #id').value = id
        })

        
        
    </script>

    <script src="assets/js/bootstrap.bundle.min.js"></script> 

</body>

</html>