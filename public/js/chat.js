const ws = new WebSocket('ws://localhost:3000');

ws.onmessage = (event) => {
  const msg = document.createElement('div');
  msg.textContent = event.data;
  document.getElementById('messages').appendChild(msg);
};

function enviarMensaje() {
  const input = document.getElementById('mensaje');
  ws.send(JSON.stringify({ type: 'chat', data: input.value }));
  input.value = '';
}
