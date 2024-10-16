<!-- Miguel Angel Hornos  -->

<?php
// funcio per comprobar que l'usuari existeix
function iniciarSesio($usuari,$contrasenya){
    try{
        $errors = [];

        //ens connectem amb la base de dades
        $connexio = new PDO('mysql:host=localhost;dbname=pt04_miguel_hornos', 'root', '');

        //comprobem si l'usuari existeix
        $existeixUsuari = $connexio->prepare("SELECT * FROM usuaris WHERE nombreUsuario = :usuari");
        $existeixUsuari->bindParam(":usuari",$usuari);
        $existeixUsuari->execute();
        
        //si existeix, comprobem que la password es correcta
        if ($existeixUsuari->rowCount() > 0){
            $usuariDades = $existeixUsuari->fetch(PDO::FETCH_ASSOC);
            $contrasenyaBD = $usuariDades["contrasenya"];

            if($contrasenyaBD === $contrasenya){
                return $usuariDades;
            } else {
                return false;
            }
        } else {
            return false;
        }

    } catch (PDOException $e) {
        // en cas d'error de connexió mostrem el missatge d'error
        echo "Error de connexió: " . $e->getMessage() . " ❌";
        
    }
}

?>

