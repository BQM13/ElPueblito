<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Ver Estadísticas de Residentes</title>
  <link rel="stylesheet" href="css/style_login.css" />
  <link rel="stylesheet" href="css/style_estadisticas.css" />
</head>
<header>
        <nav>
            <ul>
                <a href="index.html" class="nav-item-login">Inicio</a>
                <a href="about.html" class="nav-item-login">Quiénes somos</a>
                <a href="programas.html" class="nav-item-login">Programas</a>
                <a href="ayuda.html" class="nav-item-login">Cómo ayudar</a>
                <a href="contacto.html" class="nav-item-login">Contacto</a>
                <a href="login.html" class="nav-item-login">Cerrar sesión</a>
            </ul>
        </nav>
    </header>
<body>

  <div class="container">
    <h1>Estadísticas de Residentes</h1>
    <table>
      <thead>
        <tr>
          <th>Cédula</th>
          <th>Nombre</th>
          <th>1er Apellido</th>
          <th>2do Apellido</th>
          <th>Edad</th>
          <th>Peso (kg)</th>
          <th>Altura (m)</th>
          <th>Actualizar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $conn = new mysqli("localhost", "nodeuser", "1234", "elpueblito");
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $sql = "SELECT id, cedula, nombre, primerApellido, segundoApellido, edad, peso, altura FROM Residente";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<form method='POST' action='actualizar_estadisticas.php'>";
                echo "<td>{$row['cedula']}</td>";
                echo "<td>{$row['nombre']}</td>";
                echo "<td>{$row['primerApellido']}</td>";
                echo "<td>{$row['segundoApellido']}</td>";
                echo "<td><input type='number' name='edad' value='{$row['edad']}' required></td>";
                echo "<td><input type='number' step='0.01' name='peso' value='{$row['peso']}' required></td>";
                echo "<td><input type='number' step='0.01' name='altura' value='{$row['altura']}' required></td>";
                echo "<td>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <button type='submit'>Guardar</button>
                      </td>";
                echo "</form>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8' class='no-data'>No hay residentes registrados.</td></tr>";
        }

        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
