<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar que ambos campos (cédula y correo) no estén vacíos
    if (empty($_POST['cedula']) || empty($_POST['correo'])) {
        die("Error: La cédula y el correo son obligatorios.");
    }

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "nodeuser", "1234", "elpueblito");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener y escapar los valores
    $cedula = $conn->real_escape_string($_POST['cedula']);
    $correo = $conn->real_escape_string($_POST['correo']);

    // SQL para eliminar al residente donde coincidan ambos valores
    $sql = "DELETE FROM Residente WHERE cedula = '$cedula' AND correo = '$correo'";

    if ($conn->query($sql) === TRUE) {
        // Si la eliminación fue exitosa
        echo "<script>alert('Residente eliminado correctamente'); window.location.href='eliminar_residente.html';</script>";
    } else {
        // Si hubo un error
        echo "Error al eliminar: " . $conn->error;
    }

    $conn->close();
}
?>
