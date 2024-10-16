<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pr4</title>
</head>
<body>

    <!--si l'usuari está logat -->
    <?php if (isset($_SESSION['usuari'])):  ?> 
        <div class="navbar">
        <a href="Controlador/logout.php"><button>Deslogar-se</button></a>
        </div>

        <!-- 3 botons que ens envien al document corresponent per tractar les dades -->
        <h3>Que vols fer?</h3> 
        <a href="Vistes/Inserir.php?pagina=<?php echo isset($_GET['pagina']) ? $_GET['pagina'] : 1; ?>"> 
            <button>Inserir article</button>
        </a><br>
        <a href="Vistes/Modificar.php?pagina=<?php echo isset($_GET['pagina']) ? $_GET['pagina'] : 1; ?>">
            <button>Modificar article</button>
        </a><br>
        <a href="Vistes/Esborrar.php?pagina=<?php echo isset($_GET['pagina']) ? $_GET['pagina'] : 1; ?>">
            <button>Esborrar article</button>
        </a><br><br>

    <!-- si l'usuari no està logat -->
    <?php else: ?> 
        <div class="navbar">
        <a href="Vistes/Login.php"><button>Logar-se</button></a>
        <a href="Vistes/Register.php"><button>Registrar-se</button></a>
        </div>
    <?php endif; ?>
</body>
</html>