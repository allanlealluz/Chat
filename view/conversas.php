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
    </head>
    <body>
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
           ?><a href='Chat/pessoa/<?php echo $v['id'] ?>'><h2><?php echo $v['nome'] ?></h2></a><?php
           }
       }
            
        
        ?>
        
    </body>
</html>
