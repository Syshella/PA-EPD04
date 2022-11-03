<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="partida.php" method="post">
            Introduzca la palabra:
            <input type="text" name="input_palabra"/>
            <br/>
            Introduzca el número de errores permitidos:
            <input type="number" name="input_errores_max" max="50"/>
            <br/>
            <input type="hidden" name="inicio" value="asd"/>
            <input type="submit" name="Submit" value="COMENZAR PARTIDA"/>
            <?php
                
            ?>
        </form>
    </body>
</html>
