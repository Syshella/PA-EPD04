<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 1</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">        
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 10px 20px;
            }
        </style>
    </head>
    <body class="m-5">
        <h1>Ejercicio 1</h1>

        <?php
        checkErrors();
        ?>

        <!--Formulario a rellenar-->
        <form action="#" method='POST' >
            <label for="nombre">Nombre</label>
            <input type='nombre' id='nombre' name='nombre' value="Informe 1" required><br>
            <br>
            <label for="fecha">Fecha</label>
            <input type='date' id='fecha' name='fecha' value="2022-11-08" required><br>
            <br>
            <label for="tipoRegistro">Tipo de registro</label><br>
            <input type='radio' id='limpieza' name='tipoRegistro' value='Limpieza' checked>
            <label for='limpieza'>Limpieza</label><br>
            <input type='radio' id='chapa' name='tipoRegistro' value='Chapa'>
            <label for='chapa'>Chapa</label><br>
            <input type='radio' id='pintura' name='tipoRegistro' value='Pintura'>
            <label for='pintura'>Pintura</label><br>
            <br>
            <label for="costeHora">Coste por hora(&euro;)</label>
            <input type='number' id='costeHora' name='costeHora' min='0' step="0.01" value='99.99' required><br>
            <br>
            <label for="costeTarifa">Costa por tarifa cerrada(&euro;)</label>
            <input type='number' id='costeTarifa' name='costeTarifa' min='0' step='0.01' value='60.00' required><br>
            <br>
            <label for="conceptos">Conceptos</label><br>
            <textarea rows='10' cols='80' id='conceptos' name='conceptos'>
Taller 1; Limpieza ; Daniel G. F. ; tiempo estimado ; 0:30
Taller 1; Chapa ; Pablo N. J. ; tarifa cerrada ;
Taller 1; Chapa; Daniel G. F. ; tiempo estimado ; 1:30
Taller 2; Limpieza ; Pablo N. J. ; tiempo estimado ; 0:20
Taller 1; Pintura ; Rosa H. G ; tarifa cerrada ;
Taller 1; Pintura ; Pablo N. J. ; tiempo estimado ; 0:20
Taller 2; Chapa ; Pablo N. J. ; tiempo estimado ; 0:40
Taller 1; Chapa ; Pablo N. J. ; tiempo estimado ; 0:20
Taller 2; Limpieza ; Rosa H. G ; tarifa cerrada ;
Taller 2; Pintura ; Pablo N. J. ; tiempo estimado ; 0:30
            </textarea>

            <br>
            <input type='submit' id='generarInforme' name='generarInforme' value='Generar Informe'>
        </form>
        <br>

        <?php

        // Esta parte de errores solo se activa si se salta la condicion de required manipulando el HTML
        function checkErrors() {
            if (isset($_POST["generarInforme"])) {
                if (!isset($_POST["nombre"])) {
                    echo "<p class=\"text-danger\">ERROR: Introduzca un nombre</p>";
                }
                if (!isset($_POST["fecha"])) {
                    echo "<p class=\"text-danger\">ERROR: Introduzca una fecha</p>";
                }
                if (!isset($_POST["tipoRegistro"])) {
                    echo "<p class=\"text-danger\">ERROR: Introduzca un Tipo de registro</p>";
                }
                if (!isset($_POST["costeHora"])) {
                    echo "<p class=\"text-danger\">ERROR: Introduzca un coste/hora</p>";
                } else {
                    // Comprueba el numero de decimales en caso de que pase la validacion del form
                    $costeHora = $_POST["costeHora"];
                    $decimals = (strlen($costeHora) - strpos($costeHora, '.')) - 1;
                    if ($decimals != 2) {
                        echo "<p class=\"text-danger\">ERROR: El n&uacute;mero de decimales para COSTE HORA ha de ser 2</p>";
                    }
                }
                if (!isset($_POST["costeTarifa"])) {
                    echo "<p class=\"text-danger\">ERROR: Introduzca un coste/hora</p>";
                } else {
                    // Comprueba el numero de decimales en caso de que pase la validacion del form
                    $costeTarifa = $_POST["costeTarifa"];
                    $decimals = (strlen($costeTarifa) - strpos($costeTarifa, '.')) - 1;
                    if ($decimals != 2) {
                        echo "<p class=\"text-danger\">ERROR: El n&uacute;mero de decimales para COSTE TARIFA ha de ser 2</p>";
                    }
                }
            }
        }

        // Funcion que calcula el coste en funcion del tiempo y coste por hora
        function getCoste($tiempo, $coste) {
            $time = explode(":", $tiempo);
            $horas = $time[0];
            $minutos = $time[1];
            // Calcula el coste en un funcion de tramos de hora
            return $horas * $coste + ($minutos / 60) * $coste;
        }
        
        // Funcion que genera la cabecera del informe
        function getCabeceraInforme() {
            return "<table>
                                <tr>
                                    <td class=\"font-weight-bold\">Nombre de informe</td>
                                    <td class=\"font-italic\"> &emsp; " . $_POST["nombre"] . "</td>
                                </tr>
                                <tr>
                                    <td class=\"font-weight-bold\">Fecha</td>
                                    <td class=\"font-italic\">&emsp;" . $_POST["fecha"] . "</td>
                                </tr>
                                <tr>
                                    <td class=\"font-weight-bold\">Tipo de registro</td>
                                    <td class=\"font-italic\">&emsp;" . $_POST["tipoRegistro"] . "</td>
                                </tr>
                                <tr>
                                    <td class=\"font-weight-bold\">Coste por hora</td>
                                    <td class=\"font-italic\">&emsp;" . number_format($_POST["costeHora"], 2, ".") . "&euro;" . "</td>
                                </tr>
                                <tr>
                                    <td class=\"font-weight-bold\">Coste tarifa cerrada</td>
                                    <td class=\"font-italic\">&emsp;" . number_format($_POST["costeTarifa"], 2, ".") . "&euro;" . "</td>
                                </tr>
                              </table>
                              <br>";
        }

        function getTablaInforme() {

            // Seguido hacemos un trim para eliminar espacios redundantes
            // Separa cada fila en un array
            $arrayData = explode("\n", trim($_POST["conceptos"]));
            $tiempoTotal = 0;
            $costeTotal = 0;
            // String que contendra el resultado
            // Recorre los datos del array
            $res .= " 
                     <table>
                         <thead>
                             <tr>
                                 <th>Taller</th>
                                 <th>T&eacute;cnico</th>
                                 <th>Tiempo empleado</th>
                                 <th>Coste</th>
                             </tr>
                         </thead>
                         <tbody>";
            for ($i = 0; $i < count($arrayData); $i++) {
                // Deshacemos la fila en un array separado por ;
                $arrayRow = explode(";", trim($arrayData[$i]));
                if(strcmp(trim($arrayRow[1]), $_POST["tipoRegistro"])==0){
                    echo "." . trim($arrayRow[1]) .  ". es igual a ." . $_POST["tipoRegistro"] . ".<br>";
                    $res .= "<tr>";
                    // Calcula el coste en funcion del tipo de coste
                    if (strcasecmp(trim($arrayRow[3], " "), "tiempo estimado") == 0) {
                        $coste = getCoste($arrayRow[4], $_POST["costeHora"]);
                        $t = explode(":", trim($arrayRow[4]));
                        if (is_numeric($t[0]) == 1 && $t[0] > 0) {
                            $tiempoTotal += $t[0] * 60;
                        }
                        if (is_numeric($t[1]) == 1 && $t[1] > 0)  {
                            $tiempoTotal += $t[1];
                        }
                        $tiempoEmpleadoCol = $arrayRow[4];
                    } else {
                        $coste = $_POST["costeTarifa"];
                        $tiempoEmpleadoCol = "Tarifa cerrada";
                    }
                    $costeTotal += $coste;
                    // Cuerpo de la tabla
                    $res .= "<td> " . $arrayRow[0] . "</td>";
                    $res .= "<td> " . $arrayRow[2] . "</td>";
                    $res .= "<td> " . $tiempoEmpleadoCol . "</td>";
                    $res .= "<td> " . number_format($coste, 2, ".") . " &euro;</td>";
                    $res .= "</tr>";
                }
            }

            $tiempoTotal = $tiempoTotal > 0 ? $tiempoTotal / 60 : 0 + $tiempoTotal % 60;

            $res .= "<tr><td></td><td></td><td class=\"font-weight-bold\">Tiempo total</td><td class=\"font-weight-bold\">Coste total</td></tr>";
            $res .= "<tr><td></td><td></td><td class=\"font-weight-bold\">" . number_format($tiempoTotal, 2, ".") . " horas" . "</td><td class=\"font-weight-bold\">" . number_format($costeTotal, 2, ".") . " &euro;</td></tr>";

            $res .= "</tbody>
                    </table>";
            return $res;
        }

        // Ejecucion
        // Si no hay errores y se ha presionado el boton de enviar, se genera la tabla
        if (isset($_POST["generarInforme"])) {
            $res = "";

            if (isset($_POST["nombre"]) && isset($_POST["fecha"]) && isset($_POST["tipoRegistro"]) && isset($_POST["costeHora"]) && isset($_POST["costeTarifa"])) {
                $res = getCabeceraInforme();
                $res .= getTablaInforme();
            }
        }
        echo $res;
        ?>
    </body>
</html>
