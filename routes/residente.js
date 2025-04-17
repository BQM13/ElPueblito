const express = require('express');
const router = express.Router();
const db = require('../db');

// Crear residente
router.post('/crear', (req, res) => {
  const { cedula, nombre, PrimerApellido, SegundoApellido, mail, password } = req.body;

  const sql = `
    INSERT INTO Residente (cedula, nombre, primerApellido, segundoApellido, correo, contrasena)
    VALUES (?, ?, ?, ?, ?, ?)
  `;

  db.query(sql, [cedula, nombre, PrimerApellido, SegundoApellido, mail, password], (err, result) => {
    if (err) {
      console.error('Error al crear residente:', err);
      return res.status(500).send('Error al crear residente');
    }

    res.send('Residente creado con éxito');
  });
});

module.exports = router;
