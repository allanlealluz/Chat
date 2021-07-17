<?php

class Core {
    function __construct() {
        $this->run();
    }
    function run(){     
        if(isset($_GET['url'])){
       $url =  $_GET['url'];
       $url = explode('/', $url);
       $parametros = array();
       
           $controller = $url[0].'controller';
           array_shift($url);
           if(!empty($url)){
               $method = $url[0];
           array_shift($url); 
           }else{
             $method = 'index';  
           }
           if(count($url) > 0){
               $parametros = $url;           
           }
           
       }else{
           $method = 'index';
           $controller = 'indexcontroller';
           $parametros = array();
       }
        $caminho = 'Chat/Controller/'.$controller.'.php';
  if(!file_exists($caminho) && !method_exists($controller, $method )){
      $controller = 'indexcontroller';
      $method  = 'index';
  }
       $c = new $controller();
       call_user_func_array(array($c,$method), $parametros);
    }
}
