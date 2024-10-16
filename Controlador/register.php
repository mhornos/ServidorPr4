<!-- Miguel Angel Hornos -->

<?php
require "../Model/register.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuari = $_POST["usuari"] ?? null;
    $correu = $_POST["correu"] ?? null;
    $ciutat = $_POST["ciutat"] ?? null;
    $contrasenya = $_POST["contrasenya"] ?? null;
    $contrasenya2 = $_POST["contrasenya2"] ?? null;

    $errors = [];

    if (empty($usuari)){
        $errors[] = "falta el nom d'usuari ❌";
    }

    if (empty($correu)){
        $errors[] = "falta el correu ❌";
    } elseif (!filter_var($correu,FILTER_VALIDATE_EMAIL)){
        $errors[] = "el correu no es valid❌";
    }

    if (empty($ciutat)){
        $errors[] = "falta la ciutat ❌";
    }

    if (empty($contrasenya)){
        $errors[] = "falta la contrasenya ❌";
    } elseif(empty($contrasenya2)){
        $errors[] = "has de repetir la contrasenya ❌";
    } elseif ($contrasenya !== $contrasenya2){
        $errors[] = "les contrasenyes no coincideixen ❌";
    }

    //comprobar validesa password:

    //comprobar longitud minima (8)
    //comprobar si te al menys 1 nombre

    //comprobar si te al menys 1 majuscula

    //comprobar si te al menys 1 minuscula

    if(empty($errors)){
        crearUsuari($usuari,$contrasenya,$correu,$ciutat);
    }

    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pr2</title>

    <link rel="stylesheet" href="..\Estils\estils.css">
</head>
<body>
<br><a href="../Index.php?pagina=<?php echo isset($_GET['pagina']) ? $_GET['pagina'] : 1; ?>">
            <button>Tornar a inici</button>
        </a><br>
</body>
</html>