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
    <h2>Crear compte de mecànic:</h2><br>
    <form action="../Controlador/register.php" method="post">
    <input type="text" id="usuari" name="usuari" placeholder="Usuari"> 
    <input type="email" id="correu" name="correu" placeholder="Correu">
    <input type="text" id="ciutat" name="ciutat" placeholder="Ciutat"> 
    <input type="password" id="contrasenya" name="contrasenya" placeholder="Contrasenya">
    <input type="password" id="contrasenya2" name="contrasenya2" placeholder="Repeteix la contrasenya">
    <p>La contrasenya ha de tenir almenys 8 caràcters, un número, una majúscula i una minúscula.</p><br>
    <input type="submit" name="Register" value="Register">
    Ja tinc un compte: <a href="Login.php"> Iniciar sessió </a>

    </form>

    <a href="../Index.php?pagina=<?php echo isset($_GET['pagina']) ? $_GET['pagina'] : 1; ?>">
            <button>Tornar a inici</button>
        </a>
</body>
</html>