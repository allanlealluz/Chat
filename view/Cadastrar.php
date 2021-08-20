<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel='stylesheet' href='CSS/Cadastrar.css'>
    </head>
    <body>
        <h1>Chat</h1> 
        <form method="POST" id="form" enctype="multipart/form-data">
            <H2>Cadastre-se</h2>
            <input type="text" name="Nome">
            <input type="text" name="Email"> 
            <input type="text" name="Senha"> 
            <input type='file' name='files'>
            <input type="submit" name="enviar" />
        </form>
        <?php
       
        require_once 'model/Usuarios.php';
        $con = new Usuarios('chat', 'localhost', 'root', '');
        if(isset($_POST['Nome'])){
           if(isset($_FILES['files'])){
               var_dump($_FILES['files']);
               $nome_arquivo = rand(1,99).$_FILES['files']['name'];
               move_uploaded_file($_FILES['files']['tmp_name'],'Imagens/'.$nome_arquivo);
           }
           $nome =  htmlentities(addslashes($_POST['Nome']));
           $email =  htmlentities(addslashes($_POST['Email']));
           $senha =  htmlentities(addslashes($_POST['Senha']));
           if(!isset($_FILES['files'])){
           $con->Cadastrar($nome, $email, $senha);
           header('Location:Login');
           }else{
           $con->Cadastrar($nome, $email, $senha,$nome_arquivo);  
           header('Location:Login');
           }
           
        }
        ?>
    </body>
</html>