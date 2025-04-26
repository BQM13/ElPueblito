<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "nodeuser", "1234", "elpueblito");
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $id = (int) $_POST['id'];
    $edad = (int) $_POST['edad'];
    $peso = (float) $_POST['peso'];
    $altura = (float) $_POST['altura'];

    $sql = "UPDATE Residente SET edad = $edad, peso = $peso, altura = $altura WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Estadísticas actualizadas correctamente'); window.location.href='ver_estadisticas.php';</script>";
    } else {
        echo "Error al actualizar: " . $conn->error;
    }

    $conn->close();
}
?>
