<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <form action="./Problema1BackEnd.php" method="POST">
            <label>Nombre del Taller:</label>
            <br>
            <br>
            <input type="text" name="nombreTaller" required>
            <br>

            <label>Criterio de Ordenaci&oacute; (Nombre/Nota): </label>
            <br>
            <br>
            <select name="criterio" id="criterio" required>
                <option id="criterio" value="nombre">Nombre</option>
                <option id="criterio" value="nota">Nota</option>
            </select>
            <br>
            <label>Criterio de Ordenaci&oacute; (Ascendente/Descendente): </label>
            <br>
            <br>
            <input type="radio" name="orden" value="ascendente">
            <label>Ascendente</label>
            <input type="radio" name="orden" value="descendente" checked>
            <label>Descendente</label>
            <br>
            <br>
            <label>Comentarios: </label>
            <br>
            <textarea name="Criticas" rows="10" cols="40" required></textarea>
            <br>
            <button type="submit" name="envio">Enviar</button>
        </form>

    </body>
</html>
