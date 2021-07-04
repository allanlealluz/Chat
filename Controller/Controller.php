<?php

class Controller {
  

    public $dados;
    
    function __construct() {
        $this->dados = array();
    }
    function carregarTemplate($nomeView,$dadosModel = array()){
        $this->dados = $dadosModel;
        require 'view/template.php';
    }
    public function carregarViewNoTemplate($nomeView,$dadosModel = array()){
        extract($dadosModel);
        require 'view/'.$nomeView.'.php';
    }


 
}
