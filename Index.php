<!-- Miguel Ángel Hornos -->

<!-- pagina principal de la web -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pr4</title>

        <link rel="stylesheet" href="Estils\estils.css">
    </head>
    <body>
        <!-- 3 botons que ens envien al document corresponent per tractar les dades -->
        <!-- <h3>Que vols fer?</h3> 
        <a href="Vistes/Inserir.php?pagina=<?php echo isset($_GET['pagina']) ? $_GET['pagina'] : 1; ?>"> 
            <button>Inserir article</button>
        </a><br>
        <a href="Vistes/Modificar.php?pagina=<?php echo isset($_GET['pagina']) ? $_GET['pagina'] : 1; ?>">
            <button>Modificar article</button>
        </a><br>
        <a href="Vistes/Esborrar.php?pagina=<?php echo isset($_GET['pagina']) ? $_GET['pagina'] : 1; ?>">
            <button>Esborrar article</button>
        </a><br><br>-->

    </body>
</html>
<!-- mostra la llista d'articles a sota de tot -->
<?php
include "Vistes/Login.php";
include "Controlador/mostrarLlista.php";
?>