var div = document.getElementById('div')
var form = document.getElementById('form')
var input =  document.getElementById('conversa')
var id = document.getElementById('id').innerHTML
var form2 = document.getElementById('form2')
fetch(`/Chat/Carregar.php?id=${id}&arm=arm`)
        .then(function(response){
           return response.json()
})
        .then(function(data){
            
           for(var i in data){ 
               
               
             if(data[i]['fk_remetente'] === id){                                        
                   if(data[i]['conversa'].substring(0,10) === 'data:image'){
                       var img = document.createElement('img')
                       img.src = data[i]['conversa'];
                       img.setAttribute('id',"direita")
                       img.setAttribute('class','img')
                       div.appendChild(img)
                   }else{
                   var p = document.createElement('p')
                   p.innerHTML = data[i]['conversa']                   
                    p.setAttribute('class',"direita")
                    p.setAttribute('id','direita');
                   div.appendChild(p)
               }
                }else{
                    if(data[i]['conversa'].substring(0,10) === 'data:image'){
                       var img = document.createElement('img')
                       img.src = data[i]['conversa'];
                       img.setAttribute('id',"esquerda")
                       img.setAttribute('class','img')
                       div.appendChild(img)
                   }else{
                    var p = document.createElement('p')
                     p.setAttribute('class',"esquerda")
                   p.innerHTML = data[i]['conversa']
                   div.appendChild(p) 
               }
                }               
                 } 
                   
})
function buscar(){  
    fetch(`/Chat/Carregar.php?id=${id}`)
            .then(function(response){
               return response.json()
    })
            .then(function(data){
                for(var i in data){                                                        
                                                
                   if(data[i]['conversa'].substring(0,10) === 'data:image' && data[i]['fk_remetente'] === id ){
                       var img = document.createElement('img')
                       img.src = data[i]['conversa'];
                       img.setAttribute('class','img')
                       img.setAttribute('class',"direita")
                       div.appendChild(img)
                   }
                if(data[i]['fk_remetente'] === id && data[i]['conversa'].substring(0,10) !== 'data:image'){
                   var p = document.createElement('p')
                   p.innerHTML = data[i]['conversa']                   
                    p.setAttribute('class',"direita")
                    p.setAttribute('id','direita');
                   div.appendChild(p)
               }                          
                        
       
                }                                           
             })   
    
    setTimeout('buscar()',500)
}
form.addEventListener('submit',function(e){
   
    e.preventDefault()
    var p =  document.createElement('p');
    p.innerHTML = input.value;
    p.setAttribute('class',"esquerda")
    p.setAttribute('id',"esquerda")
    div.appendChild(p)
    fetch(`${id}`,{
        method: 'POST',
        body: input.value
    })
            input.value = ''
})
form2.addEventListener('submit',function(e){
     e.preventDefault()
     var file = document.getElementById('file')
     const leitorDeArquivos = new FileReader()
     var input = file.files[0]
     leitorDeArquivos.readAsDataURL(input)
     leitorDeArquivos.addEventListener('loadend', function(load){
         var img = document.createElement('img')
        img.setAttribute('src',load.target.result)
        img.width = 500
        img.height = 500
        div.appendChild(img)
         fetch(`${id}`,{
        method: 'POST',
        body: load.target.result
    })
           file.value = ''
     })
     
    
    
   
})
