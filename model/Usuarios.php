<?php

class Usuarios {
    private $pdo;
    
    function __construct($dbname,$host,$user,$password) {
        try {
          $this->pdo = new PDO('mysql:dbname='.$dbname.';host='.$host,$user,$password);  
        } catch (Exception $ex) {
          echo $ex->getCode(),$ex->getMessage(),$ex->getLine();  
        }
        
    }
    function Cadastrar($nome,$email,$senha,$imagem){
         $cmd = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = :e');
        $cmd->bindValue(':e', $email);
        $cmd->execute();
        if($cmd->rowCount() > 0){
            return false;
        }else{
            $cmd = $this->pdo->prepare("INSERT INTO usuarios (nome,email,senha,imagem) VALUES (:n,:e,:s,:i)");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":e", $email);
            $cmd->bindValue(":s", $senha);
            $cmd->bindValue(":i", $imagem);
            $cmd->execute();
            
        }
}
     function entrar($email,$senha){
    $cmd = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = :e and senha = :s');
        $cmd->bindValue(':e', $email);
        $cmd->bindValue(':s', $senha);
        $cmd->execute();
        if($cmd->rowCount() > 0){
            $dados =  $cmd->fetch();
            session_start();
            $_SESSION['id_user'] = $dados['id'];
            return true;
        }else{
            return false;
        }
}
     function BuscarUsuarios(){
         $cmd = $this->pdo->prepare('SELECT * FROM usuarios');
         $cmd->execute();
         $dados = $cmd->fetchAll();
         return $dados;
     }
     function BuscarUmUsuario($id){
         $cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
         $cmd->bindValue(':id', $id);
         $cmd->execute();
         $dados = $cmd->fetchAll();
         if(empty($dados)){
             return false;
         }
         return $dados;
     }
     function InserirConversa($conversa,$id,$id_destino){
         $cmd = $this->pdo->prepare("INSERT INTO conversas (conversa,fk_remetente,fk_destinatario) VALUES (:c,:fkr,:fkd)");       
         $cmd->bindValue(':c', $conversa);
         $cmd->bindValue(':fkr', $id);
         $cmd->bindValue(':fkd', $id_destino);
         $cmd->execute();
         $cmds = $this->pdo->prepare("INSERT INTO conversa_arm (conversa,fk_remetente,fk_destinatario) VALUES (:c,:fkr,:fkd)");
         $cmds->bindValue(':c', $conversa);
         $cmds->bindValue(':fkr', $id);
         $cmds->bindValue(':fkd', $id_destino);
         $cmds->execute();
     }
     function buscarMensagens($id,$id_destino){
         $cmd = $this->pdo->prepare('SELECT * FROM conversas where fk_remetente = :fkr and fk_destinatario = :fkd OR fk_remetente = :fkd and fk_destinatario = :fkr');
         $cmd->bindValue(':fkr', $id);
         $cmd->bindValue(':fkd', $id_destino);
         $cmd->execute();
         $dados = $cmd->fetchAll();
         return $dados;
     }
      function buscarMensagensArm($id,$id_destino){
         $cmd = $this->pdo->prepare('SELECT * FROM conversa_arm where fk_remetente = :fkr and fk_destinatario = :fkd OR fk_remetente = :fkd and fk_destinatario = :fkr');
         $cmd->bindValue(':fkr', $id);
         $cmd->bindValue(':fkd', $id_destino);
         $cmd->execute();
         $dados = $cmd->fetchAll();
         return $dados;
     }
     function deletar($id){
         $cmd = $this->pdo->prepare('delete from conversas where id = :id');
         $cmd->bindValue(':id', $id);      
         $cmd->execute();
     }
     function BuscarUltimaMensagem($id,$id_destino){
         $cmd = $this->pdo->prepare('select * from conversas where  fk_remetente = :fkd and fk_destinatario = :fkr limit 1 ');
         $cmd->bindValue(':fkr', $id);
         $cmd->bindValue(':fkd', $id_destino);
         $cmd->execute();
         $dados = $cmd->fetchAll();
         return $dados;
     }
}
