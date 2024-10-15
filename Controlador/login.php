<!-- Miguel Angel Hornos -->

<?php
require "../Model/login.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuari = $_POST["usuari"] ?? null;
    $contrasenya = $_POST["contrasenya"] ?? null;

    $errors = [];

    if (empty($usuari)){
        $errors[] = "falta el nom d'usuari ❌";
    }
    if (empty($contrasenya)){
        $errors[] = "falta la contrasenya ❌";
    }

    if(empty($errors)){
        iniciarSesio($usuari,$contrasenya);
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