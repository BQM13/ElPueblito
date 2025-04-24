const mysql = require('mysql2');

// Definir la conexión antes de intentar usarla
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'nodeuser', // Asegúrate de usar el usuario correcto
  password: '1234', // Contraseña actualizada
  database: 'elpueblito'
});

// Intentar la conexión
connection.connect((err) => {
  if (err) {
    console.error('Error de conexión: ' + err.stack);
    return;
  }
  console.log('Conectado como id ' + connection.threadId);
});
