<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar los datos
    if (empty($_POST['correo']) || empty($_POST['mensaje'])) {
        echo "<script>alert('Algunos campos no se enviaron correctamente.'); window.history.back();</script>";
        exit();
    }

    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "nodeuser", "1234", "elpueblito");

    if ($conn->connect_error) {
        echo "<script>alert('Error al conectar a la base de datos.'); window.history.back();</script>";
        exit();
    }

    // Insertar datos en la base de datos
    $sql = "INSERT INTO mensajes_contacto (correo, mensaje) VALUES ('$correo', '$mensaje')";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a la misma página con una alerta de éxito
        echo "<script>alert('¡Mensaje enviado con éxito!'); window.location.href = 'contacto.html';</script>";
    } else {
        // Redirigir de vuelta con una alerta de error
        echo "<script>alert('Hubo un error al enviar el mensaje. Intenta nuevamente.'); window.history.back();</script>";
    }

    $conn->close();
}
?>
