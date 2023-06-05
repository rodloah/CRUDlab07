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


$url = 'https://api.green-api.com/waInstance1101819812/SendMessage/c37ef7621def4b77bd5be9d5b2fb70efbcd3a767446c4e47ac';
$message = "Estimado(a) *".strtoupper($persona['nombre'])." ".strtoupper($persona['apellidos'])."* Usted agregó un carro con la placa: *".strtoupper($persona['placa'])."* , marca: *".$persona['marca']."* , color: *".$persona['color']."*, año: *".$persona['año']."*";
$data = [
    "chatId" => "51".$persona['celular']."@c.us",
    "message" =>  $message
];

$options = array(
    'http' => array(
        'method'  => 'POST',
        'content' => json_encode($data),
        'header' =>  "Content-Type: application/json\r\n" .
            "Accept: application/json\r\n"
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$response = json_decode($result);

?> 