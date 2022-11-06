<html>
    <head>
        <meta charset="UTF-8">
        <title>BackEnd Problema2</title>
    </head>
    <body>
        <?php

        function anonimar($dicAnonimaciones, $frase) {

            foreach ($dicAnonimaciones as $key => $value) {
                if ($key === array_keys($dicAnonimaciones)[0]) {
                    $anonimado = str_replace($key, $value, $frase);
                    $contadores[$value] = substr_count($frase, $key);
                } else {
                    $anonimado = str_replace($key, $value, $anonimado);
                    $contadores[$value] = substr_count($frase, $key);
                }
            }
            echo '<ul>';
            echo '<li>' . $anonimado . '</li>';
            echo '<li>' . "Anonimaciones totales: " . array_sum(array_values($contadores)) . '</li>';
            echo '<li>' . "Anonimaciones por termino: " . '</li>';
            echo '<ul>';
            foreach ($contadores as $key => $value) {

                echo '<li>' . $key . ': ' . $value . '</li>';
            }

            echo '</ul>';
            echo '</ul>';
        }

        if (isset($_POST['envio'])) {
            if ($_POST['frase'] == "" || !isset($_POST['frase'])) {
                $errores[] = "Tienes que introducir la frase";
            }

            if ($_POST['anonimizar'] == "" || !isset($_POST['anonimizar'])) {
                $errores[] = "Tienes que introducir los valores a anonimizar";
            } else {
                $frase = $_POST['frase'];
                $anonimacion = explode(";", $_POST['anonimizar']);
                foreach ($anonimacion as $regla) {
                    $regla = str_replace("(", "", $regla);
                    $regla = str_replace(")", "", $regla);
                    $contenido = explode(",", $regla);
                    $dicAnonimaciones[trim($contenido[1])] = trim($contenido[0]);
                }
                anonimar($dicAnonimaciones, $frase);
            }
        }
        ?>




        <?php
        if (isset($errores)) {
            foreach ($errores as $error) {
                echo $error . '<br>';
            }
            ?>
            <form action="back.php" method="POST">
                <label>Frase original: </label>
                <br>
                <textarea id="area" name="frase" rows="5" cols="80"></textarea>
                <br>
                <label>Tupla de palabras a anonimizar: </label>
                <br>
                <textarea id="area" name="anonimizar" rows="5" cols="80"></textarea>
                <br>
                <button type="submit" name="envio">Enviar</button>
            </form>
    <?php
}
?>

    </body>
</html>