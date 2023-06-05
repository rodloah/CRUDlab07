<?php
if (!isset($_GET['codigo'])) {
    header('Location: index.php?mensaje=error');
    exit();
}

include 'config/database.php';
$codigo = $_GET['codigo'];

$sentencia ="SELECT pro.placa, pro.marca, pro.color, pro.año , pro.id_usuario, per.nombre , per.apellidos ,per.correo, per.dni, per.celular , per.fecha_nacimiento 
FROM autos pro 
INNER JOIN usuario per ON per.id_usuario = pro.id_usuario 
WHERE pro.id_autos =".$codigo;

$consultapersona = $conn->query($sentencia);
$persona=$consultapersona->fetch_assoc();

$curl = curl_init();
$url = 'https://api.green-api.com/waInstance1101819812/SendFileByUpload/c37ef7621def4b77bd5be9d5b2fb70efbcd3a767446c4e47ac';

$chatId = "51".$persona['celular']."@c.us";
$caption ="El video de su carro";

$file_path ="C:\laragon\www\usuario-main\carrito.mp4";
$file = curl_file_create($file_path, 'video/mp4', 'carrito.mp4');
$fields = array(
    'chatId' => $chatId,
    'caption'=> $caption,
    'file' => $file
);
curl_setopt_array($curl,array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $fields,
    CURLOPT_HTTPHEADER=> array(),
));
$response=curl_exec($curl);
curl_close($curl);
?>
