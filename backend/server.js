const express = require('express');
const cors = require('cors');
const db = require('./db'); // Esta es tu conexión a la BD
const path = require('path'); // por si quieres servir archivos estáticos
const app = express();

// Middlewares
app.use(cors());
app.use(express.json()); // Para leer JSON en las solicitudes
app.use(express.urlencoded({ extended: true })); // Para leer formularios
app.use(express.static(path.join(__dirname, 'public'))); // Asegúrate que 'public' es tu carpeta de HTML

// Endpoint de ejemplo
app.get('/residentes', (req, res) => {
  db.query('SELECT * FROM residente', (err, results) => {
    if (err) return res.status(500).json({ error: 'Error en la consulta' });
    res.json(results);
  });
});

// Ruta para guardar mensajes de contacto
app.post('/api/contacto', (req, res) => {
  const { nombre, correo, mensaje } = req.body;
  const query = 'INSERT INTO mensajes_contacto (nombre, correo, mensaje) VALUES (?, ?, ?)';

  db.query(query, [nombre, correo, mensaje], (err, result) => {
    if (err) {
      console.error('Error al guardar el mensaje:', err);
      return res.status(500).send('Error al guardar el mensaje');
    }

    console.log('Mensaje guardado con ID:', result.insertId);
    res.send('Mensaje enviado correctamente');
  });
});

const PORT = 3000;
app.listen(PORT, () => {
  console.log(`Servidor corriendo en http://localhost:${PORT}`);
});
