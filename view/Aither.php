<html>
    <head>
        <title>Aither</title>
        <link rel="stylesheet" href="CSS/Aither.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <?php foreach($dadosModel as $v){ ?>
        <img src="Imagens/<?php echo $v['imagem']?>">
            <h2 id="nome"><?php echo $v['nome']; ?></h2>
        <h3 id="id" style="display:none;"><?php echo $v['id']; }?></h3>
        
       <div class="container-lg bg-light">
        <div id='conversa' class=" row-cols-1 bg-light">
            
        </div>
       </div>
        <div class="container-lg">
                <form method="POST">
            <input type="text" name='perg' id='perg'>            
        </form>  
            </div>  
        
    </body>
</html>

<script>
var div = document.getElementById('conversa')
var input = document.getElementById('perg')
document.addEventListener('keypress',function(e){
    if(e.key == 'Enter'){
    e.preventDefault()
     var p = document.createElement('p')
            p.innerHTML = input.value
            p.setAttribute('class','col')
            div.appendChild(p)
   var perg = document.getElementById('perg').value
    myHeaders = new Headers()
var myInit = { method: 'GET',
               headers: myHeaders,
               mode: 'no-cors',
               cache: 'default' };
/* this page depends of the django page polls */
fetch(`http://127.0.0.1:8000/polls/${perg}/teste`,myInit)
 
fetch(`http://localhost/Chat/teste.php?perg=${perg}`)
        .then(function(response){
            return response.json()
})
        .then(function(data){         
            var p = document.createElement('p')
            p.innerHTML = data
            p.setAttribute('class','col')          
            div.appendChild(p)
            
})
    }
})
</script>

<?php

