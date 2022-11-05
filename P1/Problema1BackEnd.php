<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>BackEnd Problema1</title>
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
        /* Declaracion de funcion */

        function creacionTabla($mediaParcial, $criterio, $orden) {

            /* Ordenamos el vector asociativo segun el criterio */
            if ($criterio == "nombre") {
                if ($orden == "ascendente") {
                    ksort($mediaParcial);
                } else {
                    krsort($mediaParcial);
                }
            } else {
                if ($orden == "ascendente") {
                    asort($mediaParcial);
                } else {
                    arsort($mediaParcial);
                }
            }

            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Taller</th>";
            echo "<th>Media</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            foreach ($mediaParcial as $key => $value) {
                echo "<tr>";
                echo "<td>" . $key . "</td>";
                echo "<td>" . $value . "</td>";
            }

            echo "</tbody>";
            echo "</table>";
        }

        if (isset($_POST["envio"])) {
            if (!isset($_POST["nombreTaller"]) || $_POST["nombreTaller"] == "") {
                $errores[] = "Por favor introduzca un nombre de taller";
            }if (!isset($_POST["criticas"]) || $_POST["criticas"] == "") {
                $errores[] = "Por favor introduzca las criticas necesarias";
            } else {
                $criterio = $_POST["criterio"];
                $orden = $_POST["orden"];
                $criticasSeparadasIntro = explode("\n", $_POST["criticas"]);
                foreach ($criticasSeparadasIntro as $criticas) {
                    $critica = explode(",", $criticas);
                    $talleres[] = $critica[0];
                    $notas[] = $critica[1];
                }

                /* Nos permite conocer todos los nombres unicos de los talleres introducidos por el usuario */
                $nombresUnicos = array_unique($talleres);

                foreach ($nombresUnicos as $nombre) {

                    $contador = 0;
                    $sumaParcial = 0;

                    for ($i = 0; $i < count($talleres); $i++) {
                        if ($nombre === $talleres[$i]) {
                            $contador++;
                            $sumaParcial += $notas[$i];
                        }
                    }

                    $mediaParcial[$nombre] = $sumaParcial / $contador;
                }

                creacionTabla($mediaParcial, $_POST["criterio"], $_POST["orden"]);
            }
        }
        ?>

        <?php
        if (isset($errores)) {
            foreach ($errores as $error) {
                echo $error . "<br>";
            }
            ?>

            <form action="./Problema1BackEnd.php" method="POST">

                <input type="text" name="nombreTaller" required>
                <br>

                <select name="criterio" id="criterio" required>
                    <option id="criterio" value="nombre">Nombre</option>
                    <option id="criterio" value="nota">Nota</option>
                </select>
                <br><!-- comment -->

                <input type="radio" name="orden" value="ascendente">
                <label>Ascendente</label>
                <input type="radio" name="orden" value="descendente" checked>
                <label>Descendente</label>
                <br>
                <textarea name="criticas" rows="10" cols="40" required></textarea>
                <br><!-- comment -->
                <button type="submit" name="envio">Enviar</button>
            </form>
    <?php
}
?>
    </body>
</html>