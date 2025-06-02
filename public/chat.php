<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>CHATIFY</title>
  <style>
    /* Reset básico */
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background:#a88474;
      color: #333;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
      padding: 20px;
    }

    .container {
      display: flex;
      gap: 30px;
      background: #fff;
      padding: 20px 30px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      max-width: 900px;
      width: 100%;
    }

    /* Chat */
    .chat {
      flex: 1;
      display: flex;
      flex-direction: column;
      max-height: 500px;
    }

    .chat h1 {
      margin-top: 0;
      margin-bottom: 15px;
      font-weight: 700;
      color:#016180;
      user-select: none;
    }

    #messages {
      flex-grow: 1;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 10px;
      background:#F8EDE5;
      overflow-y: auto;
      font-size: 0.9rem;
      line-height: 1.4;
      margin-bottom: 15px;
      box-shadow: inset 0 0 8px #ddd;
    }

    #messages div {
      margin-bottom: 8px;
      padding: 6px 10px;
      border-radius: 12px;
      max-width: 75%;
      word-wrap: break-word;
    }

    #messages div:nth-child(odd) {
      background-color: #e1f0ff;
      align-self: flex-start;
    }

    #messages div:nth-child(even) {
      background-color: #cde7ff;
      align-self: flex-end;
      font-weight: 600;
    }

    .input-group {
      display: flex;
      gap: 10px;
    }

    #input {
      flex-grow: 1;
      padding: 10px 15px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 30px;
      outline-offset: 2px;
      transition: border-color 0.3s;
    }
    #input:focus {
      border-color: #0052cc;
      box-shadow: 0 0 5px #0052ccaa;
    }

    #send {
      background-color: #0052cc;
      color: white;
      border: none;
      border-radius: 30px;
      padding: 10px 25px;
      font-size: 1rem;
      font-weight: 700;
      cursor: pointer;
      transition: background-color 0.25s ease;
      user-select: none;
    }
    #send:hover {
      background-color:#016180;
    }
    #send:active {
      background-color:#4A8CB0;
    }

    #send1 {
      background-color: #0052cc;
      color: white;
      border: none;
      border-radius: 30px;
      padding: 10px 25px;
      font-size: 1rem;
      font-weight: 700;
      cursor: pointer;
      transition: background-color 0.25s ease;
      user-select: none;
    }
    #send1:hover {
      background-color:#016180;
    }
    #send1:active {
      background-color:#4A8CB0;
    }

    /* Videollamada */
    .video-section {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      max-height: 500px;
    }

    .video-section h2 {
      margin-top: 0;
      margin-bottom: 20px;
      font-weight: 700;
      color: #0052cc;
      user-select: none;
    }

    video {
      background: black;
      border-radius: 12px;
      box-shadow: 0 8px 15px rgba(0,0,0,0.2);
      margin-bottom: 20px;
      max-width: 100%;
      height: auto;
      aspect-ratio: 4 / 3;
      object-fit: cover;
    }

    /* Responsive */
    @media (max-width: 700px) {
      body {
        padding: 15px 10px;
      }
      .container {
        flex-direction: column;
        max-width: 100%;
        padding: 15px;
      }
      .chat, .video-section {
        max-height: none;
      }
      video {
        aspect-ratio: auto;
        height: 180px;
      }
      #messages {
        height: 180px;
      }
      
      
    }
  </style>
</head>
<body>
  <div class="container">
    <section class="chat">
      <h1>Chat</h1>
      <div id="messages"></div>
      <div class="input-group">
        <input type="text" id="input" placeholder="Escribe algo..." autocomplete="off" />
        <button id="send">Enviar</button>
      </div>
    </section>

    <section class="video-section">
      <h2>Videollamada</h2>
      <video id="localVideo" autoplay muted playsinline></video>
      <video id="remoteVideo" autoplay playsinline></video>
    </section>
  </div>

  <script>
    // Tu código JavaScript aquí, sin cambios
    const ws = new WebSocket('ws://localhost:3000');

    const messagesDiv = document.getElementById('messages');
    const input = document.getElementById('input');
    const sendBtn = document.getElementById('send');
    const localVideo = document.getElementById('localVideo');
    const remoteVideo = document.getElementById('remoteVideo');

    let localStream;
    let pc;
    let isOfferCreated = false;

    const config = { iceServers: [{ urls: 'stun:stun.l.google.com:19302' }] };

    function addMessage(msg) {
      const div = document.createElement('div');
      div.textContent = msg;
      messagesDiv.appendChild(div);
      messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }

    sendBtn.onclick = () => {
      const msg = input.value;
      if (msg.trim() !== '') {
        ws.send(JSON.stringify({ type: 'chat', message: msg }));
        addMessage("Tú: " + msg);
        input.value = '';
      }
    };

    ws.onmessage = async (event) => {
      let raw = event.data;
      if (raw instanceof Blob) {
        raw = await raw.text();
      }

      try {
        const data = JSON.parse(raw);

        switch (data.type) {
          case 'chat':
            addMessage("Otro: " + data.message);
            break;
          case 'offer':
            await pc.setRemoteDescription(new RTCSessionDescription(data.offer));
            const answer = await pc.createAnswer();
            await pc.setLocalDescription(answer);
            ws.send(JSON.stringify({ type: 'answer', answer }));
            break;
          case 'answer':
            await pc.setRemoteDescription(new RTCSessionDescription(data.answer));
            break;
          case 'candidate':
            await pc.addIceCandidate(new RTCIceCandidate(data.candidate));
            break;
        }
      } catch (err) {
        addMessage("[Error al procesar mensaje]: " + raw);
        console.error("Mensaje no válido:", err);
      }
    };

    async function init() {
      try {
        localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        localVideo.srcObject = localStream;

        pc = new RTCPeerConnection(config);

        localStream.getTracks().forEach(track => pc.addTrack(track, localStream));

        pc.ontrack = event => {
          remoteVideo.srcObject = event.streams[0];
        };

        pc.onicecandidate = event => {
          if (event.candidate) {
            ws.send(JSON.stringify({ type: 'candidate', candidate: event.candidate }));
          }
        };

        ws.onopen = async () => {
          const offer = await pc.createOffer();
          await pc.setLocalDescription(offer);
          ws.send(JSON.stringify({ type: 'offer', offer }));
        };

      } catch (err) {
        alert('Error al acceder a la cámara/micrófono: ' + err.message);
        addMessage("⚠️ No se pudo iniciar la videollamada.");
      }
    }

    init();
  </script>

  <button id="send1">← Regresar a Chats</button>

<script>
  document.getElementById('send1').onclick = () => {
    window.location.href = '../chats.php';
  };
</script>

</body>
</html>
