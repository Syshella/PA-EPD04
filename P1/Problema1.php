<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>FrontEnd Problema1</title>
    </head>

    <body>
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
    </body>
</html>