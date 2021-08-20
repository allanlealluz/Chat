<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">     
        <link rel="stylesheet" href="CSS/Conversas.css">
    </head>
    <body>
        <h1>Chat</h1>
        <?php
        session_start();
        if(!isset($_SESSION['id_user'])){
            header('Location:');
        }
        require_once 'model/Usuarios.php';
        $con = new Usuarios('chat', 'localhost', 'root', '');
        $dados = $con->BuscarUsuarios();     
       foreach ($dados as $v){
           if($v['id'] !== $_SESSION['id_user']){
            if(!empty($v['imagem'])){
           ?><img src='Imagens/<?php echo $v['imagem'] ?>'><?php
           }
           ?><a href='Chat/pessoa/<?php echo $v['id'] ?>'><h2><?php echo $v['nome'] ?></h2></a><?php
           
           }
       }
            
        
        ?>
        
    </body>
</html>
