<?php

class Conversascontroller extends Controller {
 function index(){
        require_once 'model/Usuarios.php';
        $con = new Usuarios('chat', 'localhost', 'root', '');
        $dadosModel = $con->BuscarUsuarios();  
     $this->carregarTemplate('conversas',$dadosModel);
 }
}
