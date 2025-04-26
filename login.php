<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Usuario y contraseña fijos
    $usuarioFijo = "admin";
    $contrasenaFija = "1234";

    if ($usuario === $usuarioFijo && $contrasena === $contrasenaFija) {
        // Establecer la sesión para el usuario maestro
        $_SESSION['usuario'] = $usuario;
        header("Location: administrativo.html");
        exit;
    }

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "nodeuser", "1234", "elpueblito");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Buscar el usuario en la tabla Personal (por correo)
    $usuario = $conn->real_escape_string($usuario);
    $sql = "SELECT contrasena FROM Personal WHERE correo = '$usuario' AND activo = TRUE";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($contrasena, $row['contrasena'])) {
            // Establecer la sesión para el usuario de la base de datos
            $_SESSION['usuario'] = $usuario;
            header("Location: administrativo.html");
            exit;
        } else {
            echo "<script>alert('Contraseña incorrecta'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado o inactivo'); window.location.href='login.html';</script>";
    }

    $conn->close();
}
?>