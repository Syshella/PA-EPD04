<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php   
            session_start();
            if(!empty($_POST["inicio"])){
                $_SESSION["palabra"]=$_POST["input_palabra"];
                $_SESSION["size_palabra"]=strlen($_POST["input_palabra"]);
                $_SESSION["errores_max"]=$_POST["input_errores_max"];
                $_SESSION["errores"]=0;
                $arr = array();
                for($i=0;$i<$_SESSION["size_palabra"];$i++){
                    $arr[$_SESSION["palabra"][$i]]=0;
                }
                $_SESSION["encontradas"]=$arr;
            }
            
            
        
            function mostrarTabla(){
                $size = $_SESSION["size_palabra"];
                echo "<table border='1' width='75%' height='10%'>";
                    echo "<tr>";
                        for($i=0;$i<$size;$i++){
                            echo "<td>";
                            if($_SESSION["encontradas"][$_SESSION["palabra"][$i]]==1){
                                echo $_SESSION["palabra"][$i];
                            }
                            echo "</td>";
                        }
                    echo "</tr>";
                echo "</table>";
            }
            
            function compruebaError(){
                if(strpos($_SESSION["palabra"],$_POST["introducido"])===false){
                    $_SESSION["errores"]=$_SESSION["errores"]+1;
                }else{
                    $_SESSION["encontradas"][$_POST["introducido"]]=1;
                }
            }
            
            function ganado(){
                $i=0;
                $ganado=true;
                while($ganado && $i<$_SESSION["size_palabra"]){
                    if($_SESSION["encontradas"][$_SESSION["palabra"][$i]]!=1){
                        $ganado=false;
                    }else{
                        $i++;
                    }
                }
                return $ganado;
            }
            
            if(empty($_POST["inicio"])){
                compruebaError();
            }
            echo "<p>ERRORES MÁXIMOS: ".$_SESSION["errores_max"]."</p>";
            echo "<p>ERRORES ACTUALES: ".$_SESSION["errores"]."</p>";
            mostrarTabla();
            
        ?>
        <?php
        if($_SESSION["errores"]<$_SESSION["errores_max"] && !ganado()){
        ?>
        <form action="" method="post">
            Letra Introducida:
            <input type="text" maxlength="1" name="introducido"/>
            <input type="submit" value="SIGUIENTE"/>
        </form>
        <?php
        }else if(ganado()){
            echo "ENHORABUENA, HAS ACERTADO LA PALABRA";
        }else{
            echo 'DERROTA, LA PALABRA A ADIVINAR ERA "'.$_SESSION["palabra"].'"';
        }
        ?>
    </body>
</html>