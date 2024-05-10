// Chat elements
const chatElements = {
  div: document.getElementById('div'),
  form: document.getElementById('form'),
  input: document.getElementById('conversa'),
  id: document.getElementById('id').innerHTML,
  form2: document.getElementById('form2'),
  button: document.getElementById('mandar'),
  nome: document.getElementById('nome').innerHTML,
  key: document.getElementById('key').innerHTML,
  fileInput: document.getElementById('file'),
};

// API endpoints
const apiEndpoints = {
  loadMessages: `/Chat/Carregar.php?id=${chatElements.id}&arm=arm&key=${chatElements.key}`,
  sendMessage: `${chatElements.id}`,
};

// Load messages function
async function loadMessages() {
  try {
    const response = await fetch(apiEndpoints.loadMessages);
    const data = await response.json();
    data.forEach(({ conversa, fk_remetente }) => {
      const msg = document.createElement('p');
      if (fk_remetente === chatElements.id) msg.classList.add('direita');
      else msg.classList.add('esquerda');
      if (conversa.startsWith('data:image')) {
        const img = document.createElement('img');
        img.src = conversa;
        chatElements.div.appendChild(img);
      } else {
        msg.textContent = conversa;
        chatElements.div.appendChild(msg);
      }
    });
  } catch (error) {
    console.error('Error loading messages:', error);
  }
}

// Send message function
async function sendMessage(message) {
  if (!message) return;
  try {
    const p = document.createElement('p');
    p.textContent = message;
    p.classList.add('esquerda');
    chatElements.div.appendChild(p);
    await fetch(apiEndpoints.sendMessage, { method: 'POST', body: message });
    chatElements.input.value = '';
  } catch (error) {
    console.error('Error sending message:', error);
  }
}

// Handle form submission
chatElements.form.addEventListener('submit', (e) => {
  e.preventDefault();
  sendMessage(chatElements.input.value);
});

// Handle file upload
chatElements.form2.addEventListener('submit', async (e) => {
  e.preventDefault();
  const file = chatElements.fileInput.files[0];
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.addEventListener('loadend', async () => {
    try {
      const img = document.createElement('img');
      img.src = reader.result;
      img.width = 500;
      img.height = 500;
      chatElements.div.appendChild(img);
      await fetch(apiEndpoints.sendMessage, { method: 'POST', body: reader.result });
      chatElements.fileInput.value = '';
    } catch (error) {
      console.error('Error uploading file:', error);
    }
  });
});

// Load messages initially and every 500ms
loadMessages();
setInterval(loadMessages, 500);