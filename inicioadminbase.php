<?php
require 'conexion.php';
session_start();
    if (isset($_POST['Ingresar'])){
        if( strlen($_POST['correo']) >= 1 && strlen($_POST['contrasena']) ){
            $correo = trim($_POST['correo']);
            $contrasena = trim($_POST['contrasena']);
            $consulta = "SELECT * FROM admin WHERE correo = '$correo' AND contrasena = '$contrasena'";
            $resultado = mysqli_query($db, $consulta);
            if (mysqli_num_rows($resultado) == 1) {
                $_SESSION['username'] = $correo;
                header('Location: adminsite.php');
                exit();
            } else {
                // Las credenciales son incorrectas
                echo 'Inicio de sesión fallido. Por favor, verifica tus credenciales.';
            }
        }
    }
    mysqli_close($db);
    ?>