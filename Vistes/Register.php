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
    <input type="text" id="usuari" name="usuar" placeholder="Usuari"> </br> 
    <input type="text" id="contrasenya" name="contrasenya" placeholder="Contrasenya"> </br>
    <input type="submit" name="Register" value="Register">
    Ja tinc un compte: <a href="../"> Iniciar sessió </a>
    </form>
</body>
</html>