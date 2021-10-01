var url = 'https://randomuser.me/api/?results=10'
fetch(url)
.then(function(response){
    return response.json()
})
.then(function(data){
    alert(data)
})






