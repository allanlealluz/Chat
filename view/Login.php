<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="CSS/Login.css">
    </head>
    <body>
         <form method="POST" id="form" enctype="multipart/form-data">                     
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
