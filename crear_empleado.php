<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar campos obligatorios
    $required = ['cedula', 'nombre', 'primerApellido', 'segundoApellido', 'correo', 'contrasena'];
    foreach ($required as $campo) {
        if (empty($_POST[$campo])) {
            die("Error: Todos los campos son obligatorios.");
        }
    }

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "nodeuser", "1234", "elpueblito");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Escapar valores y encriptar contraseña
    $cedula = $conn->real_escape_string($_POST['cedula']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $primerApellido = $conn->real_escape_string($_POST['primerApellido']);
    $segundoApellido = $conn->real_escape_string($_POST['segundoApellido']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO Personal (cedula, nombre, primerApellido, segundoApellido, correo, contrasena)
            VALUES ('$cedula', '$nombre', '$primerApellido', '$segundoApellido', '$correo', '$contrasena')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Empleado registrado correctamente'); window.location.href='crear_empleado.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
