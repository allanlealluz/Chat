from chatterbot import ChatBot
import PySimpleGUI as py
from serpapi import GoogleSearch
from chatterbot.trainers import ListTrainer
bot = ChatBot('Aither')

conversa = ['Oi', 'Olá', 'Tudo bem?', 'Tudo ótimo',
			'Você gosta de programar?', 'Sim, eu programo em Python','Sua Gostosa','Para billy...','Bora sair na porrada','Você não aguentaria','Aither','Oii..']
trainer = ListTrainer(bot)
trainer.train(conversa)
perg = ''
py.theme('reddit')
layout = [
     [py.Input(key='pergunta')],
    [py.Image('Imagens\aither.png')]
     [py.Button('Enviar')],
     [py.Text('',key='resposta')]
]
janela = py.Window('Aither',layout)

while True:
    eventos,valores = janela.read()
    if eventos == py.WINDOW_CLOSED:
        break
    if eventos == 'Enviar':
        perg = valores['pergunta']
        resposta = bot.get_response(perg)

    if float(resposta.confidence) > 0.5:
        print('Aither: ', resposta)
        janela['resposta'].update(resposta)
    else:
        if perg[:4] == 'perg':
            params = {
                "q": perg[4:],
                "location": "Austin, Texas, United States",
                "hl": "en",
                "gl": "us",
                "google_domain": "google.com",
                "api_key": '25d42dcb2ab7a7f27dad5979c357752951bc0848f43d5382a6a117acf3776c64'
            }
            query = GoogleSearch(params)
            results = query.get_dict()
            for c,result in enumerate(results):
               print(result)
               for data in results[result]:
                   print(data)
        print('Aither: Ainda não sei responder esta pergunta')
