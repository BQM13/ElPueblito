const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const path = require('path');

const personalRoutes = require('./routes/personal');
const residenteRoutes = require('./routes/residente');

const app = express();

app.use(cors());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// ✅ Servir archivos estáticos desde la raíz del proyecto
app.use(express.static(__dirname));

// ✅ Servir archivos HTML manualmente desde el root si querés control más fino
app.get('/crear_empleado.html', (req, res) => {
  res.sendFile(path.join(__dirname, 'crear_empleado.html'));
});

app.get('/crear_residente.html', (req, res) => {
  res.sendFile(path.join(__dirname, 'crear_residente.html'));
});

app.get('/login.html', (req, res) => {
  res.sendFile(path.join(__dirname, 'login.html'));
});

// ✅ También para CSS u otros archivos si fuera necesario
app.get('/style_login.css', (req, res) => {
  res.sendFile(path.join(__dirname, 'style_login.css'));
});

// Rutas de la API
app.use('/api/personal', personalRoutes);
app.use('/api/residente', residenteRoutes);

// Servidor
app.listen(3000, () => {
  console.log('Servidor corriendo en http://localhost:3000');
});
