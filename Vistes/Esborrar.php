<!-- Miguel Angel Hornos -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pr4</title>

    <link rel="stylesheet" href="..\Estils\estils.css">
</head>
<body>
    <!-- formulari per escollir l'id per borrar article de la bd -->
    <h3>Eliminar article de la BD</h3>

    <form action="../Model/crud.php" method="post">
        <table>
        <label for="id">ID:  </label>    
        <input type="text" id="id" name="id" placeholder="Introdueix ID del article a eliminar"> <br/>

        <input type="submit" value="Eliminar" name="Enviar">
        <input type="reset" value="Buidar">
        </table>     
    </form>

<!-- botó per tornar a començar amb l'ultima pagina de la llista escollida-->
    <br><a href="../Index.php?pagina=<?php echo isset($_GET['pagina']) ? $_GET['pagina'] : 1; ?>">
        <button>Tornar a inici</button>
    </a><br>
</body>
</html>

<!-- mostra la llista d'articles a sota de tot -->
<?php
include "../Model/mostrarLlista.php";
?>