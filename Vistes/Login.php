<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pr4</title>
    <link rel="stylesheet" href="Estils\estils.css">
</head>
<body>
    <h3>Benvingut! Inicia sessió:</h3>
    <form action="Controlador/login.php" method="post">
    <input type="text" id="usuari" name="usuar" placeholder="Usuari"> </br> 
    <input type="password" id="contrasenya" name="contrasenya" placeholder="Constrasenya"> </br>
    <input type="submit" name="Login"></br>
    No tinc compte: <a href="Controlador/register.php"> Crea un compte </a></br>
    </form>
</body>
</html>