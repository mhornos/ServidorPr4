<!-- Miguel Angel Hornos  -->

<?php

//funcio per registrar usuaris
function crearUsuari($usuari,$contrasenya,$correu,$ciutat){
    try{
        $errors = [];

        //ens connectem amb la base de dades
        $connexio = new PDO('mysql:host=localhost;dbname=pt04_miguel_hornos', 'root', '');  
        
        $existeixUsuari = false;
        //comprobem si el nom d'usuari ja existeix
        $consultaExistenciaUsuari = $connexio->prepare("SELECT * FROM usuaris WHERE nombreUsuario = :usuari");
        $consultaExistenciaUsuari->bindParam(':usuari', $usuari);
        $consultaExistenciaUsuari->execute();
        if ($consultaExistenciaUsuari->rowCount() > 0) {
            $existeixUsuari = true;
            $errors[] = "el nom d'usuari ja existeix ❌";
        }

        //comprobar si el correu ja existeix
        $consultaExistenciaCorreu = $connexio->prepare("SELECT * FROM usuaris WHERE correo = :correu");
        $consultaExistenciaCorreu->bindParam(':correu', $correu);
        $consultaExistenciaCorreu->execute();
        if ($consultaExistenciaCorreu->rowCount() > 0) {
            $existeixUsuari = true;
            $errors[] = "ja hi ha un usuari vinculat a aquest correu ❌";
            
        }

        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }

        // si no existeix, creem el nou usuari
        if (!$existeixUsuari){
            $insert = $connexio->prepare("INSERT INTO usuaris (nombreUsuario, contrasenya, correo, ciutat) VALUES (:usuari, :contrasenya, :correu, :ciutat)");
            
            $insert->bindParam(':usuari', $usuari);
            $insert->bindParam(':contrasenya', $contrasenya);
            $insert->bindParam(':ciutat', $ciutat);
            $insert->bindParam(':correu', $correu);

            $insert->execute();

            echo "usuari creat correctament! ✅";
        }
    } catch (PDOException $e) {
        // en cas d'error de connexió mostrem el missatge d'error
        echo "Error de connexió: " . $e->getMessage() . " ❌";
        
    }
}

?>