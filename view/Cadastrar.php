<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="POST" id="form" enctype="multipart/form-data">           
            <input type="type" name="Nome">
            <input type="type" name="Email"> 
            <input type="type" name="Senha"> 
            <input type="submit" name="enviar" />
        </form>
        <?php
        echo $_GET['url'];
        require_once 'model/Usuarios.php';
        $con = new Usuarios('chat', 'localhost', 'root', '');
        if(isset($_POST['Nome'])){
           $nome =  htmlentities(addslashes($_POST['Nome']));
           $email =  htmlentities(addslashes($_POST['Email']));
           $senha =  htmlentities(addslashes($_POST['Senha']));
           $con->Cadastrar($nome, $email, $senha);
        }
        ?>
    </body>
</html>