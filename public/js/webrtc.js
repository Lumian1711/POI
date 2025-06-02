// ⚙️ Conexión WebSocket
const ws = new WebSocket('ws://localhost:3000'); // Cambia por tu URL de ngrok si es necesario

// 🎥 Elementos de video
const localVideo = document.getElementById('localVideo');
const remoteVideo = document.getElementById('remoteVideo');

let localStream;
let peerConnection;
const config = { iceServers: [{ urls: 'stun:stun.l.google.com:19302' }] };

// 📹 Acceder a cámara y micrófono
navigator.mediaDevices.getUserMedia({ video: true, audio: true })
  .then(stream => {
    localVideo.srcObject = stream;
    localStream = stream;
    initConnection();
  })
  .catch(err => alert('No se pudo acceder a cámara/micrófono: ' + err));

// 💬 Chat de texto
const messagesDiv = document.getElementById('messages');
document.getElementById('send').onclick = () => {
  const input = document.getElementById('input');
  if (input.value.trim() !== '') {
    ws.send(JSON.stringify({ type: 'chat', message: input.value }));
    appendMessage('Tú: ' + input.value);
    input.value = '';
  }
};

function appendMessage(msg) {
  const div = document.createElement('div');
  div.textContent = msg;
  messagesDiv.appendChild(div);
  messagesDiv.scrollTop = messagesDiv.scrollHeight;
}

// 📡 Iniciar conexión WebRTC
function initConnection() {
  peerConnection = new RTCPeerConnection(config);

  localStream.getTracks().forEach(track => {
    peerConnection.addTrack(track, localStream);
  });

  peerConnection.ontrack = event => {
    remoteVideo.srcObject = event.streams[0];
  };

  peerConnection.onicecandidate = event => {
    if (event.candidate) {
      ws.send(JSON.stringify({ type: 'candidate', candidate: event.candidate }));
    }
  };

  createOffer();
}

// 💬 Manejo de mensajes WebSocket
ws.onmessage = async (event) => {
  const data = JSON.parse(event.data);

  if (data.type === 'chat') {
    appendMessage('Otro: ' + data.message);
  } else if (data.type === 'offer') {
    await peerConnection.setRemoteDescription(new RTCSessionDescription(data.offer));
    const answer = await peerConnection.createAnswer();
    await peerConnection.setLocalDescription(answer);
    ws.send(JSON.stringify({ type: 'answer', answer }));
  } else if (data.type === 'answer') {
    await peerConnection.setRemoteDescription(new RTCSessionDescription(data.answer));
  } else if (data.type === 'candidate') {
    await peerConnection.addIceCandidate(new RTCIceCandidate(data.candidate));
  }
};

// 🚀 Crear la oferta inicial
function createOffer() {
  peerConnection.createOffer()
    .then(offer => peerConnection.setLocalDescription(offer))
    .then(() => {
      ws.send(JSON.stringify({ type: 'offer', offer: peerConnection.localDescription }));
    });
}
