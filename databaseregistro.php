<?php
$db = mysqli_connect('localhost', 'root', '12345678', 'test2');

if (!$db) {
    die("Error de conexión: " . mysqli_connect_error());
}
if (isset($_POST['Registrarse'])) {

    if (strlen($_POST['nombre']) >= 1 && strlen($_POST['correo']) >= 1 && strlen($_POST['password'])) {

        $nombre = trim($_POST['nombre']);
        $correo = trim($_POST['correo']);
        $tipousuario = "usuario";
        $password = trim($_POST['password']);

        $consulta = "SELECT * FROM clientes WHERE correo = '$correo'";
        $resultado = mysqli_query($db, $consulta);
        if (mysqli_num_rows($resultado) > 0) {
            echo 'Error, usuario existente';
        } else {
            $consulta = "INSERT INTO clientes (nombre, correo, tipousuario, password) VALUES ('$nombre', '$correo', '$tipousuario', '$password')";
            $resultado = mysqli_query($db, $consulta);

            if ($resultado) {
                echo 'ok';
                header('Location: ingresar.php');
                exit;
            } else {
                echo 'error';
            }
        }
    }
}

mysqli_close($db);
?>