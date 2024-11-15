<?php

$db = mysqli_connect('localhost', 'root', '12345678', 'test');

if (!$db) {
    die("Error de conexión: " . mysqli_connect_error());
}
if (isset($_POST['reservar'])){

if(strlen($_POST['nombre']) >= 1 && strlen($_POST['correo']) >= 1 && strlen($_POST['telefono']) ){

$nombre = trim($_POST['nombre']);
$correo = trim($_POST['correo']);
$telefono = trim($_POST['telefono']);
$consulta = "INSERT INTO tablecliente (nombre, correo, telefono)
        VALUES ('$nombre', '$correo', '$telefono')";

$resultado = mysqli_query($db, $consulta);

if($resultado){

    ?>
    <h3 class="ok">Te has inscrito</h3>
    <?php

} else {
    ?>
    <h3 class="ok1">ERROR</h3>
    <?php

}
}

}

mysqli_close($db);
?>