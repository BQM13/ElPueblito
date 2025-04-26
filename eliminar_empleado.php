<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['cedula']) || empty($_POST['correo'])) {
        die("Error: Todos los campos son obligatorios.");
    }

    $conn = new mysqli("localhost", "nodeuser", "1234", "elpueblito");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $cedula = $conn->real_escape_string($_POST['cedula']);
    $correo = $conn->real_escape_string($_POST['correo']);

    $sql = "DELETE FROM Personal WHERE cedula = '$cedula' AND correo = '$correo'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Empleado eliminado correctamente'); window.location.href='eliminar_empleado.html';</script>";
    } else {
        echo "Error al eliminar: " . $conn->error;
    }

    $conn->close();
}
?>
