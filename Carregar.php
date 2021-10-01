<?php
if(!isset($_GET['arm'])){
  session_start();       
require_once 'model/Usuarios.php';
$con = new Usuarios('chat', 'localhost', 'root', '');
$id = htmlentities(addslashes($_GET['id']));
$key = htmlentities(addslashes($_GET['key']));
$dados = $con->BuscarUltimaMensagem($_SESSION['id_user'], $id);
$user = $con->BuscarUmUsuario($_SESSION['id_user']);
foreach($user as $v){
    $token = $v['token'];
}
foreach($dados as $v){
    if($v['fk_destinatario'] == $_SESSION['id_user']){
      $dadosedit['fk_remetente'] =  $v['fk_remetente'];
      $dadosedit['conversa'] = openssl_decrypt($v['conversa'],'AES-256-CBC', $token); 
       $dados2[]= $dadosedit;
    }else{
      $dadosedit['fk_remetente'] = $v['fk_remetente'];
      $dadosedit['conversa'] = openssl_decrypt($v['conversa'],'AES-256-CBC', $key); 
      $dados2[]= $dadosedit;  
    }
    $dadosjson = json_encode($dados2);
echo $dadosjson;
} 

if(empty($dados)){
    echo '[]';
}elseif (empty($dadosedit)) {
    echo '[]';
    }
  

foreach($dados as $v){
    $con->deletar($v['id']);
}
}
if(isset($_GET['arm'])){
   $id = htmlentities(addslashes($_GET['id']));
   $key = htmlentities(addslashes($_GET['key']));
    session_start();    
require_once 'model/Usuarios.php';
$con = new Usuarios('chat', 'localhost', 'root', '');
$dados = $con->buscarMensagensArm($_SESSION['id_user'], $id);
$user = $con->BuscarUmUsuario($_SESSION['id_user']);
foreach($user as $v){
    $token = $v['token'];
}
foreach($dados as $v){
    if($v['fk_destinatario'] == $_SESSION['id_user']){
      $dadosedit['fk_remetente'] =  $v['fk_remetente'];
      $dadosedit['conversa'] = openssl_decrypt($v['conversa'],'AES-256-CBC', $token); 
       $dados2[]= $dadosedit;
    }else{
      $dadosedit['fk_remetente'] = $v['fk_remetente'];
      $dadosedit['conversa'] = openssl_decrypt($v['conversa'],'AES-256-CBC', $key); 
      $dados2[]= $dadosedit;  
    }
 
}
  $dadosjson = json_encode($dados2);
echo $dadosjson;  
 


}




