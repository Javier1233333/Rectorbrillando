<?php
require 'conexion.php';
session_start();
    if (isset($_POST['Ingresar'])){
        if( strlen($_POST['correo']) >= 1 && strlen($_POST['password']) ){
            $correo = trim($_POST['correo']);
            $password = trim($_POST['password']);
            $consulta = "SELECT * FROM clientes WHERE correo = '$correo' AND password = '$password'";
            $resultado = mysqli_query($db, $consulta);
            if (mysqli_num_rows($resultado) == 1) {
                $_SESSION['username'] = $correo;
                header('Location: cita2.php');
                exit();
            } else {
                // Las credenciales son incorrectas
                echo 'Inicio de sesión fallido. Por favor, verifica tus credenciales.';
            }
        }
    }
    mysqli_close($db);
    ?>