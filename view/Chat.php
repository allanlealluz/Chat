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
        <link rel="stylesheet" href="../../CSS/Chat.css">
    </head>
    <body onload="buscar()">
        <?php foreach($dadosModel as $v){?>
        <h2 id="nome"><?php echo $v['nome']; ?></h2>
        <h3 id="id" style="display:none;"><?php echo $v['id']; ?></h3>
        <?php
        }          
     if(isset($_GET['url'] )&& !empty(file_get_contents("php://input"))){
         session_start();
         require_once 'model/Usuarios.php';
        $con = new Usuarios('chat', 'localhost', 'root', '');     
         $ide = explode("/",$_GET['url']);
        $id = htmlentities(addslashes($ide[2]));        
         $conversa = htmlentities(addslashes(file_get_contents("php://input")));
        $con->InserirConversa($conversa, $_SESSION['id_user'],$id);
     }
        ?>
        <div id="div" onclick="scroll()" style="word-break:break-word;"></div>
        <form method="POST" id="form">
            <input type="text" id="conversa">
        </form>
        <form id="form2">
            <input type="file" id="file">
            <input type="submit" id="button">
        </form>
        <script src="../../JS/instant_menssage.js"></script>       
    </body>
</html>
