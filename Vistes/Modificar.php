<!-- Miguel Angel Hornos -->

<!-- pagina per començar a modificar articles a la bd -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pr4</title>

    <link rel="stylesheet" href="..\Estils\estils.css">
</head>
<body>
    <!-- formulario per omplir l'id i modificar el titol i el cos -->
    <h3>Modificar article de la BD</h3>

    <form action="../Controlador/crud.php" method="post">
        <table>
        <label for="id">ID:  </label>    
        <input type="text" id="id" name="id" placeholder="Introdueix ID del article"> <br/>
        
            <label for="titol">Editar titol:  </label>    
            <input type="text" id="titol" name="titol" placeholder="Edita el titol"> <br/>

            <label for="cos">Editar cos: </label>    
            <input type="text" id="cos" name="cos" placeholder="Edita el cos"> <br/><br/>
            
            <input type="submit" value="Modificar" name="Enviar">
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
include "../Controlador/mostrarLlista.php";
?>