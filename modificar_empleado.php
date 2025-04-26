<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "nodeuser", "1234", "elpueblito");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $cedulaOriginal = $conn->real_escape_string($_POST['cedulaOriginal']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $primerApellido = $conn->real_escape_string($_POST['primerApellido']);
    $segundoApellido = $conn->real_escape_string($_POST['segundoApellido']);
    $correo = $conn->real_escape_string($_POST['correo']);

    $actualizacion = "UPDATE Personal SET nombre='$nombre', primerApellido='$primerApellido', segundoApellido='$segundoApellido', correo='$correo'";

    if (!empty($_POST['contrasena'])) {
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
        $actualizacion .= ", contrasena='$contrasena'";
    }

    $actualizacion .= " WHERE cedula='$cedulaOriginal'";

    if ($conn->query($actualizacion) === TRUE) {
        echo "<script>alert('Empleado modificado correctamente'); window.location.href='modificar_empleado.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
