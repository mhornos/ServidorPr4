<!-- Miguel Ángel Hornos -->

<!-- pagina per començar a inserir articles a la bd -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pr2</title>

    <link rel="stylesheet" href="..\Estils\estils.css">
</head>
<body>
    <!-- formulari que demana el titol y el cos per generar un article a la bd -->
    <h3>Inserir article a la BD</h3>

    <form action="../Model/crud.php" method="post">
        <table>
            <label for="titol">Titol:  </label>    
            <input type="text" id="titol" name="titol" placeholder="Introdueix un titol"> <br/>

            <label for="cos">Cos: </label>    
            <input type="text" id="cos" name="cos" placeholder="Introdueix un cos"> <br/><br/>
            
            <input type="submit" value="Inserir" name="Enviar">
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