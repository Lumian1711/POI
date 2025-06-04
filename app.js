//PARA PRENDER EL SERVIDOR OCUPAN INICICAR UNA TERMINAL EN LA SECCION TERMINAL Y PONER EN LA TERMINAR: npm start

const express = require("express");
const path = require("path");

const app = express();

app.use('/CSS', express.static(path.join(__dirname, 'CSS')));
app.use('/Imagenes', express.static(path.join(__dirname, 'Imagenes')));

app.use(express.static(__dirname));

app.get("/", (req, res) => {
  //res.send("hello world!");
  res.sendFile(path.join(__dirname + "/login.html"));
});

app.listen(3000, () => {
  console.log("Server Power On", 3000);
});  
