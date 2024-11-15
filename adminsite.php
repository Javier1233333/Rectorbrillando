<?php
// Conexión a la base de datos
$db = mysqli_connect('localhost', 'root', '12345678', 'brillaudg');
if (!$db) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Registrar nuevo profesor
if (isset($_POST['Registrarse'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];

    $query = "INSERT INTO profesores (nombre, apellido, email, dob) VALUES ('$nombre', '$apellido', '$email', '$dob')";

    if (mysqli_query($db, $query)) {
        echo "<script>alert('Profesor registrado correctamente.');</script>";
    } else {
        echo "<script>alert('Error al registrar profesor: " . mysqli_error($db) . "');</script>";
    }
}

// Eliminar profesor
if (isset($_POST['eliminar'])) {
    $idprofesores = $_POST['idprofesores'];
    $query = "DELETE FROM profesores WHERE idprofesores='$idprofesores'";
    if (mysqli_query($db, $query)) {
        echo "<script>alert('Profesor eliminado correctamente.'); window.location.href = window.location.href;</script>"; // Recargar la página después de eliminar
    } else {
        echo "<script>alert('Error al eliminar profesor: " . mysqli_error($db) . "');</script>";
    }
    exit;
}

// Actualizar profesor
if (isset($_POST['actualizar'])) {
    $idprofesores = $_POST['idprofesores'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $estatus = $_POST['estatus'];


    $query = "UPDATE profesores SET nombre='$nombre', apellido='$apellido', email='$email', dob='$dob',estatus='$estatus' WHERE idprofesores='$idprofesores'";
    if (mysqli_query($db, $query)) {
        echo "<script>alert('Profesor actualizado correctamente.');</script>";
    } else {
        echo "<script>alert('Error al actualizar " . mysqli_error($db) . "');</script>";
    }
}
?><!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/normalize.css">

<head>
    <title>Página de Citas</title>
</head>
<body >
<h1>Página de administrador</h1>

<main class="contenedor_registro" >
    <section  class="suscripcion1">
        <h2>Regístrar al profesor </h2>
        <form method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="dob">Fecha de nacimiento:</label>
            <input type="date" id="dob" name="dob" required><br><br>

            <input type="submit" name="Registrarse" value="Registrarse">
        </form>

    </section>

</main>

<table border="3" class="contenedortabla" >
    <tr>
        <th>idprofesores</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Email</th>
        <th>Fecha de nacimiento</th>
        <th>Estatus</th>
    </tr>

    <?php
    $query = "SELECT * FROM profesores";
    $result = mysqli_query($db, $query);

    // Mostrar las citas en la tabla
    while ($mostrar = mysqli_fetch_array($result)) {
        ?>

        <tr>
            <td><?php echo $mostrar['idprofesores']; ?></td>
            <td><?php echo $mostrar['nombre']; ?></td>
            <td><?php echo $mostrar['apellido']; ?></td>
            <td><?php echo $mostrar['email']; ?></td>
            <td><?php echo $mostrar['dob']; ?></td>
            <td><?php echo $mostrar['estatus']; ?></td>


        </tr>
        <td class="suscripcion9" colspan="6">
            <form action="emailprueba3.php" method="POST">
                <input type="submit" name="Felicitar" value="Felicitar">
                <input type="hidden" name="idprofesores" value="<?php echo $mostrar['idprofesores']; ?>">
            </form>

        </td>
        <tr>

            <td>



            </td>

            <td colspan="4">
                <br>

                <form class="suscripcion10" method="post">

                    <input type="hidden" name="idprofesores" value="<?php echo $mostrar['idprofesores']; ?>">

                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo $mostrar['nombre']; ?>"><br>

                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" value="<?php echo $mostrar['apellido']; ?>"><br>

                    <label for="email">Email:</label>
                    <input type="email" name="email" value="<?php echo $mostrar['email']; ?>"><br>

                    <label for="dob">Fecha de nacimiento:</label>
                    <input type="date" name="dob" value="<?php echo $mostrar['dob']; ?>"><br>
                    <label for="estatus">Estatus:</label><br>
                    <select id="estatus" name="estatus" required>
                        <option value="">Selecciona un estatus</option>
                        <option value="Activo" <?php if ($mostrar['estatus'] == 'Activo') echo 'selected'; ?>>Activo</option>
                        <option value="Inactivo" <?php if ($mostrar['estatus'] == 'Inactivo') echo 'selected'; ?>>Inactivo</option>
                    </select><br><br>
                    <br>
                    <td class="suscripcion10" colspan="1">

                        <input type="submit" name="actualizar" value="Actualizar">
                    </td>

                </form>




        </tr>



        <?php
    }

    echo "<a href='index.html'>salir</a>";
    ?>

</table>
<div class="contenidohero">
    <p>Enviar correos especificos </p>
    <a class="boton" href="formulario.html" >Enviar</a>
</div>
<div class="contenidohero">
    <p>Reporte de usuarios </p>
    <a class="boton" href="emailprueba.php" > Ver PDF   </a>
</div>
</body>


<footer class="footer">
    <p class="footer__texto">BrillaUDG Todos Los Derechos Reservados 2021</p>
</footer>
</html>