//sirve en localhost solo poner node server.js

const WebSocket = require('ws');
const wss = new WebSocket.Server({ port: 3000 });

wss.on('connection', function connection(ws) {
  console.log('Cliente conectado');

  ws.on('message', function incoming(message) {
    // Reenviar mensaje a todos excepto al que lo envió
    wss.clients.forEach(function each(client) {
      if (client !== ws && client.readyState === WebSocket.OPEN) {
        client.send(message);
      }
    });
  });

  ws.on('close', () => {
    console.log('Cliente desconectado');
  });
});

console.log('Servidor activo en ws://localhost:3000');
