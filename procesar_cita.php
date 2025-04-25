<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["nombre"]) && !empty($_POST["correo"])) {
        $conn = new mysqli("localhost", "nodeuser", "1234", "elpueblito");
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $nombre = $conn->real_escape_string($_POST["nombre"]);
        $correo = $conn->real_escape_string($_POST["correo"]);

        $sql = "INSERT INTO citas (nombre, correo) VALUES ('$nombre', '$correo')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('¡Solicitud agendada con éxito, pronto nos pondremos en contacto contigo!'); window.location.href = 'index.html';</script>";
        } else {
            echo "<script>alert('Error al agendar la cita.'); window.location.href = 'index.html';</script>";
        }

        $conn->close();
    } else {
        echo "<script>alert('Por favor, complete todos los campos.'); window.location.href = 'index.html';</script>";
    }
}
?>
