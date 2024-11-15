<?php

$db = mysqli_connect('localhost', 'root', '12345678', 'barberfinal1');

if (!$db) {
    die("Error de conexión: " . mysqli_connect_error());
}
if (isset($_POST['reservar'])){

if(strlen($_POST['nombre']) >= 1 && strlen($_POST['correo']) >= 1 && strlen($_POST['telefono']) >= 1 && strlen($_POST['horacita']) >= 1 && strlen($_POST['fechacita']) >= 1 && strlen($_POST['servicio']) ){

$nombre = trim($_POST['nombre']);
$correo = trim($_POST['correo']);
$telefono = trim($_POST['telefono']);
$horacita= $_POST['horacita'];
$fechacita= $_POST['fechacita'];
$servicio= $_POST['servicio'];

$consulta = "INSERT INTO tablecliente (nombre, correo, telefono)
        VALUES ('$nombre', '$correo', '$telefono')";

if($consulta==1){

$idtablecliente = mysqli_insert_id($db);
$consulta = "INSERT INTO cita (idtablecliente, nombre, horacita, fechacita, servicio)
VALUES ('$idtablecliente', '$nombre', '$horacita', '$fechacita', '$servicio')";
$resultado = mysqli_query($db, $consulta);
}

if($resultado ){

    ?>
    <h2 class="ok">Te has inscrito</h7>
    <?php

} else {
    ?>
    <h2 class="okno">ERROR</h7>
    <?php

}

}

}

mysqli_close($db);
?>