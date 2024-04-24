const div = document.getElementById('div')
const form = document.getElementById('form')
const input = document.getElementById('conversa')
const id = document.getElementById('id').innerHTML
const form2 = document.getElementById('form2')
const button = document.getElementById('mandar')
const nome = document.getElementById('nome').innerHTML
const key = document.getElementById('key').innerHTML

form.addEventListener('keypress', (e) => e.key === 'Enter' && button.click())

const loadMessages = async () => {
  const response = await fetch(`/Chat/Carregar.php?id=${id}&arm=arm&key=${key}`)
  const data = await response.json()
  data.forEach(({ conversa, fk_remetente }) => {
    const msg = document.createElement('p')
    if (fk_remetente === id) msg.classList.add('direita')
    else msg.classList.add('esquerda')
    if (conversa.startsWith('data:image')) {
      const img = document.createElement('img')
      img.src = conversa
      div.appendChild(img)
    } else {
      msg.textContent = conversa
      div.appendChild(msg)
    }
  })
}

const sendMessage = async (message) => {
  if (!message) return
  const p = document.createElement('p')
  p.textContent = message
  p.classList.add('esquerda')
  div.appendChild(p)
  await fetch(`${id}`, { method: 'POST', body: message })
  await fetch(`/Chat/Carregar.php?id=${id}&arm=arm&key=${key}`, { method: 'POST', body: message })
  input.value = ''
}

form.addEventListener('submit', (e) => sendMessage(input.value))

form2.addEventListener('submit', async (e) => {
  e.preventDefault()
  const file = document.getElementById('file').files[0]
  const leitorDeArquivos = new FileReader()
  leitorDeArquivos.readAsDataURL(file)
  leitorDeArquivos.addEventListener('loadend', async () => {
    const img = document.createElement('img')
    img.src = leitorDeArquivos.result
    img.width = 500
    img.height = 500
    div.appendChild(img)
    await fetch(`${id}`, { method: 'POST', body: leitorDeArquivos.result })
    document.getElementById('file').value = ''
  })
})

loadMessages()
setInterval(loadMessages, 500)
