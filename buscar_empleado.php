<?php
$conn = new mysqli("localhost", "nodeuser", "1234", "elpueblito");

if ($conn->connect_error) {
    die(json_encode(['error' => 'Conexión fallida']));
}

$cedula = $conn->real_escape_string($_GET['cedula']);
$sql = "SELECT * FROM Personal WHERE cedula = '$cedula'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(['error' => 'Empleado no encontrado']);
}

$conn->close();
?>
