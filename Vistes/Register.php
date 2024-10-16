<!-- Miguel Angel Hornos -->

<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pr4</title>
    <link rel="stylesheet" href="..\Estils\estils.css">

</head>
<body>
    <h3>Crear compte:</h3>
    <form action="../Controlador/register.php" method="post">
    <input type="text" id="usuari" name="usuari" placeholder="Usuari"> </br> 
    <input type="email" id="correu" name="correu" placeholder="Correu"> </br> 
    <input type="password" id="contrasenya" name="contrasenya" placeholder="Contrasenya"> </br>
    <input type="password" id="contrasenya2" name="contrasenya2" placeholder="Repeteix la contrasenya"> </br>
    <input type="submit" name="Register" value="Register">
    Ja tinc un compte: <a href="Login.php"> Iniciar sessió </a>
    </form>
    <a href="../Index.php?pagina=<?php echo isset($_GET['pagina']) ? $_GET['pagina'] : 1; ?>">
            <button>Tornar a inici</button>
        </a>
</body>
</html>