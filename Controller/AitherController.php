<?php
class AitherController extends Controller {
    function index(){
         require_once 'model/Usuarios.php';
        $con = new Usuarios('chat', 'localhost', 'root', '');
        $dadosModel = $con->BuscarUmUsuario(9);
        $this->carregarTemplate('Aither',$dadosModel);
    }
    function pessoa($id){
        
    }
}
