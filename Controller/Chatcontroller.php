<?php

class Chatcontroller extends Controller{
    function index(){
       $this->carregarTemplate('Chat');  
    }
   function pessoa($id){
        require_once 'model/Usuarios.php';
        $con = new Usuarios('chat', 'localhost', 'root', '');
        $dadosModel = $con->BuscarUmUsuario($id);
        $this->carregarTemplate('Chat',$dadosModel);
        
   }
}
