<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            table, th, tr, td{
                border: 1px solid white;
                border-collapse: collapse;
                padding: 10px 20px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        
        
        <?php 
        
            function imprimir($MediaTotal, $criterio, $orden){
                
                if($criterio == "nombre"){
                    if($orden == "ascendente"){
                        ksort($MediaTotal);
                    }
                    else{
                        krsort($MediaTotal);
                    }
                }
                else{
                   if($orden == "ascendente"){
                        asort($MediaTotal);
                    }
                    else{
                        arsort($MediaTotal);
                    }
                }
                
                
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Taller</th>';
                echo '<th>Media</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($MediaTotal as $key => $value) {
                    echo '<tr>';
                    echo '<td>' . $key . '</td>';
                    echo '<td>' . $value . '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            }
        
            if(isset($_POST['envio'])){
                if($_POST['nombreTaller'] == '' || !isset($_POST['nombreTaller'])){
                    $errores[] = "Error nombre taller";
                    
                }
                
                if($_POST['Criticas'] == '' || !isset($_POST['Criticas'])){
                    $errores[] ="Error en las criticas";
                }
                else{
                    $criterio = $_POST['criterio'];
                    $orden = $_POST['orden'];
                    $criticasSeparadasIntro = explode("\n", $_POST['Criticas']);
                    foreach ($criticasSeparadasIntro as $criticas) {
                        $critica = explode(",", $criticas);
                        $talleres[] = $critica[0];
                        $notas[] = $critica[1];
                    }
                    
                    $nombresUnicos = array_unique($talleres);
                    foreach ($nombresUnicos as $nombre){
                        $cont = 0;
                        $sumaParcial = 0;
                        for($i = 0; $i < count($talleres); $i++){
                            if(strcmp($nombre, $talleres[$i]) == 0){
                                $cont++;
                                $sumaParcial += $notas[$i];
                            }
                        }
                        $MediaTotal[$nombre] = $sumaParcial / $cont;
                    }
                    imprimir($MediaTotal, $criterio, $orden);
                }
            }
        
        
        ?>
        
        <?php
        if(isset($errores)){
            foreach ($errores as $error){
                echo $error . '<br>';
            }
        ?>
        <form action="./back.php" method="POST">
            <input type="text" name="nombreTaller" required>
            <br>
            <br>
            <select name="criterio" id="criterio" required>
                <option id="criterio">Nombre</option>
                <option id="criterio">Nota</option>
            </select>
            <br>
            <input type="radio" name="orden" value="ascedente">
            <label>Ascendente</label>
            <input type="radio" name="orden" value="descendente" checked>
            <label>Descendente</label>
            <br>
            <br>
            <textarea name="Criticas" rows="10" cols="40" required></textarea>
            <br>
            <button type="submit" name="envio">Enviar</button>
        </form>
        <?php
        }
        ?>
    </body>
</html>