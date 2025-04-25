<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['cedula'])) {
        echo json_encode(['status' => 'error', 'message' => 'Cédula es requerida']);
        exit;
    }

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "nodeuser", "1234", "elpueblito");

    if ($conn->connect_error) {
        echo json_encode(['status' => 'error', 'message' => 'Conexión fallida: ' . $conn->connect_error]);
        exit;
    }

    $cedula = $conn->real_escape_string($_POST['cedula']);

    // Buscar el residente en la base de datos
    $sql = "SELECT * FROM Residente WHERE cedula = '$cedula'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $residente = $result->fetch_assoc();
        echo json_encode(['status' => 'success', 'residente' => $residente]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se encontró residente']);
    }

    $conn->close();
}
?>
