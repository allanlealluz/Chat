<?php
if(!isset($_GET['arm'])){
  session_start();       
require_once 'model/Usuarios.php';
$con = new Usuarios('chat', 'localhost', 'root', '');
$id = $_GET['id'];
$dados = $con->buscarMensagens($_SESSION['id_user'], $id);
$dadosjson = json_encode($dados);
echo $dadosjson;
foreach($dados as $v){
    $con->deletar($v['id']);
}
}
if(isset($_GET['arm'])){
    $id = $_GET['id'];
    session_start();       
require_once 'model/Usuarios.php';
$con = new Usuarios('chat', 'localhost', 'root', '');
$dados = $con->buscarMensagensArm($_SESSION['id_user'], $id);
$dadosjson = json_encode($dados);
echo $dadosjson;

}

