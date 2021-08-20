<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Chat</title>
        <link rel="icon" href="chat icon.jpg"> 
        <link rel="icon" href="../chat icon.jpg"> 
        <link rel="icon" href="../../chat icon.jpg">  
        <link rel="icon" href="../../../chat icon.jpg">  
        <link rel="stylesheet" href="CSS/Login.css">
    </head>
    <body>
        <h1>Chat</h1>     
         <form method="POST" id="form" enctype="multipart/form-data">  
            <h2>Faça login caso tenha uma conta, se não <a href='/Chat/Cadastrar'> Cadastre-se</a></h2>
            <input type="text" name="Email"> 
            <input type="text" name="Senha"> 
            <input type="submit" name="enviar" />
        </form>
        <?php
        require_once 'model/Usuarios.php';
        $con = new Usuarios('chat', 'localhost', 'root', '');
         if(isset($_POST['Email'])){      
           $email =  htmlentities(addslashes($_POST['Email']));
           $senha =  htmlentities(addslashes($_POST['Senha']));
          if($con->entrar($email,$senha)){
              header('Location:Conversas');
          }
         }
        ?>
    </body>
</html>
