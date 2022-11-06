<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>FrontEnd Problema1</title>
    </head>

    <body>
        <form action="./Problema1BackEnd.php" method="POST">

            <label>Nombre del Taller:</label>
            <br>
            <input type="text" name="nombreTaller" required>
            <br>

            <label>Criterio de Ordenaci&oacute; (Nombre/Nota): </label>
            <br>
            <select name="criterio" id="criterio" required>
                <option id="criterio" value="nombre">Nombre</option>
                <option id="criterio" value="nota">Nota</option>
            </select>
            <br><!-- comment -->
            
            <label>Criterio de Ordenaci&oacute; (Ascendente/Descendente): </label>
            <br>
            <input type="radio" name="orden" value="ascendente">
            <label>Ascendente</label>
            <input type="radio" name="orden" value="descendente" checked>
            <label>Descendente</label>
            <br>
            <label>Comentarios: </label>
            <br>
            <textarea name="criticas" rows="10" cols="40" required></textarea>
            <br><!-- comment -->
            <button type="submit" name="envio">Enviar</button>
        </form>
    </body>
</html>