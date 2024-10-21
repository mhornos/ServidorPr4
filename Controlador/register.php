<!-- Miguel Angel Hornos -->

<?php
// incloem el fitxer de registre que conté la funció crearUsuari
require "../Model/register.php";

// comprovem si la petició s'ha fet mitjançant POST (formulari enviat)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // recollim els valors del formulari amb l'operador nul (per si algun no ha estat enviat)
    $usuari = $_POST["usuari"] ?? null;
    $correu = $_POST["correu"] ?? null;
    $ciutat = $_POST["ciutat"] ?? null;
    $contrasenya = $_POST["contrasenya"] ?? null;
    $contrasenya2 = $_POST["contrasenya2"] ?? null;

    // array per guardar els errors que es puguin produir durant la validació
    $errors = [];

    // comprovem si el nom d'usuari està buit
    if (empty($usuari)) {
        $errors[] = "falta el nom d'usuari ❌";
    }

    // comprovem si el correu està buit i si té un format vàlid
    if (empty($correu)) {
        $errors[] = "falta el correu ❌";
    } elseif (!filter_var($correu, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "el correu no és vàlid ❌";
    }

    // comprovem si la ciutat està buida
    if (empty($ciutat)) {
        $errors[] = "falta la ciutat ❌";
    }

    // comprovem si les contrasenyes estan buides i si coincideixen
    if (empty($contrasenya)) {
        $errors[] = "falta la contrasenya ❌";
    } elseif (empty($contrasenya2)) {
        $errors[] = "has de repetir la contrasenya ❌";
    } elseif ($contrasenya !== $contrasenya2) {
        $errors[] = "les contrasenyes no coincideixen ❌";
    }

    // comprovació de la validesa de la contrasenya

    // comprovem si la longitud de la contrasenya és inferior a 8 caràcters
    if (strlen($contrasenya) < 8) {
        $errors[] = "la contrasenya ha de tenir almenys 8 caràcters ❌";
    }
    
    // comprovem si la contrasenya conté almenys un número
    if (!preg_match('/[0-9]/', $contrasenya)) {
        $errors[] = "la contrasenya ha de contenir almenys un número ❌";
    }

    // comprovem si la contrasenya conté almenys una lletra majúscula
    if (!preg_match('/[A-Z]/', $contrasenya)) {
        $errors[] = "la contrasenya ha de contenir almenys una lletra majúscula ❌";
    }

    // comprovem si la contrasenya conté almenys una lletra minúscula
    if (!preg_match('/[a-z]/', $contrasenya)) {
        $errors[] = "la contrasenya ha de contenir almenys una lletra minúscula ❌";
    }

    // si no hi ha errors, creem l'usuari cridant la funció crearUsuari
    if (empty($errors)) {
        crearUsuari($usuari, $contrasenya, $correu, $ciutat);
    }

    // mostrem tots els errors trobats en el procés de validació
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
    <title>Pr4</title>

    <link rel="stylesheet" href="..\Estils\estils.css">
</head>
<body>
    <br><form method="POST">
        <label for="usuari">Nom d'usuari:</label>
        <input type="text" name="usuari" value="<?php echo htmlspecialchars($usuari ?? ''); ?>">

        <label for="correu">Correu:</label>
        <input type="text" name="correu" value="<?php echo htmlspecialchars($correu ?? ''); ?>">

        <label for="ciutat">Ciutat:</label>
        <input type="text" name="ciutat" value="<?php echo htmlspecialchars($ciutat ?? ''); ?>">

        <label for="contrasenya">Contrasenya:</label>
        <input type="password" name="contrasenya" value="">

        <label for="contrasenya2">Repeteix la contrasenya:</label>
        <input type="password" name="contrasenya2" value="">

        <input type="submit" value="Registrar-se">
    </form>

    <br><a href="../Index.php?pagina=<?php echo isset($_GET['pagina']) ? $_GET['pagina'] : 1; ?>">
        <button>Tornar a inici</button>
    </a><br>
</body>
</html>
