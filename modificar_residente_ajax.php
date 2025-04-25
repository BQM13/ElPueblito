<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar que todos los campos sean llenados
    if (empty($_POST['cedula']) || empty($_POST['nombre']) || empty($_POST['primerApellido']) || empty($_POST['segundoApellido']) || empty($_POST['correo']) || empty($_POST['contrasena'])) {
        echo 'error';
        exit;
    }

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "nodeuser", "1234", "elpueblito");

    if ($conn->connect_error) {
        echo 'error';
        exit;
    }

    // Escapar los valores
    $cedula = $conn->real_escape_string($_POST['cedula']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $primerApellido = $conn->real_escape_string($_POST['primerApellido']);
    $segundoApellido = $conn->real_escape_string($_POST['segundoApellido']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT); // Encriptamos la contraseña

    // SQL para actualizar los datos del residente
    $sql = "UPDATE Residente SET 
            nombre = '$nombre', 
            primerApellido = '$primerApellido', 
            segundoApellido = '$segundoApellido', 
            correo = '$correo', 
            contrasena = '$contrasena'
            WHERE cedula = '$cedula'";

    if ($conn->query($sql) === TRUE) {
        echo 'success';
    } else {
        echo 'error';
    }

    $conn->close();
}
?>
