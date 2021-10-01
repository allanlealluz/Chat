          
        <?php
        $perg = $_GET['perg'];       
        $perg = str_replace(' ','-',$perg);     
       $url = file_get_contents("http://127.0.0.1:8000/polls/$perg/teste");
       $json = json_encode($url);
       echo $json;
        ?>
