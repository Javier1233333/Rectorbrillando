<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = mysqli_connect('localhost', 'root', '12345678', 'barberfinal');

    if (!$db) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $telefono = trim($_POST['telefono']);
    $horacita = $_POST['horacita'];
    $fechacita = $_POST['fechacita'];
    $servicio = $_POST['servicio'];


    if (empty($nombre)) {
        echo 'Error al realizar la reserva';
        'El nombre es obligatorio';
    }

    if (empty($correo)) {
        echo 'Error al realizar la reserva';
        'El correo electrónico es obligatorio';
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo 'Error al realizar la reserva';
        'El correo electrónico no es válido';
    }

    if (empty($telefono)) {
        echo 'Error al realizar la reserva';
        'El número de teléfono es obligatorio';
    } elseif (!preg_match('/^\d{10}$/', $telefono)) {
        echo 'Error al realizar la reserva';
        'El número de teléfono no es válido';
    }

    if (empty($horacita)) {
        echo 'Error al realizar la reserva';
        'La hora es obligatoria';
    }

    if (empty($fechacita)) {
        echo 'Error al realizar la reserva';
        'La fecha es obligatoria';
    }

    if (empty($servicio)) {
        echo 'Error al realizar la reserva';
        'El servicio es obligatorio';
    }

    if (empty($errors)) {
        $consulta = "INSERT INTO tablecliente (nombre, correo, telefono) VALUES ('$nombre', '$correo', '$telefono')";
        $consulta1 = "INSERT INTO cita (nombre, horacita, fechacita, servicio) VALUES ('$nombre', '$horacita', '$fechacita', '$servicio')";

        if (mysqli_query($db, $consulta) && mysqli_query($db, $consulta1)) {
            echo 'Reserva realizada correctamente';
        } else {
            echo 'Error al realizar la reserva';
        }
    }
    mysqli_close($db);
}

?>