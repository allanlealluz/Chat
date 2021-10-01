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
       foreach ($dadosModel as $v){
           ?><p> <?php
           if($v['id'] !== $_SESSION['id_user']){
           if($v['nome'] == 'Aither' || $v['id'] == 9 ){
              if(!empty($v['imagem'])){
           ?><img src='Imagens/<?php echo $v['imagem'] ?>'><?php
           }
           ?><a href='Aither'><h2><?php echo $v['nome'] ?></h2></a></p><?php 
           }else{
            if(!empty($v['imagem'])){
           ?><a href='Chat/pessoa/<?php echo $v['id'] ?>'><img src='Imagens/<?php echo $v['imagem'] ?>'><?php
           }
           ?><h2><?php echo $v['nome'] ?></h2></a></p><?php
           
           }
           }
       }
            
        
        ?>
        
    </body>
</html>
