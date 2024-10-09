<?php
// assignem la variable '$enviar' amb el valor que es troba al formulari al camp "Enviar"
$enviar = $_POST["Enviar"] ?? null;

try{
    // ens connectem amb la base de dades
    $connexio = new PDO('mysql:host=localhost;dbname=pt02_miguel_hornos', 'root', '');  
    
    // iniciem el switch per detectar l'acció a realitzar segons el valor de '$enviar'
    switch ($enviar) {
        case "Inserir":
            // obtenim el titol i cos del formulari
            $titol = $_POST["titol"] ?? null;
            $cos = $_POST["cos"] ?? null;
        
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                // preparem la consulta per inserir l'article a la base de dades
                $consultaInsert = $connexio->prepare("INSERT INTO article (titol, cos) VALUES (:titol, :cos)");
                $consultaInsert->bindParam(':titol', $titol);
                $consultaInsert->bindParam(':cos', $cos);
                
                // si algun dels camps és buit mostrem un missatge d'error
                if (empty($titol) || empty($cos)) {
                    echo "Els camps titol i cos són obligatoris ❌";
                // si tot està correcte executem la consulta i mostrem un missatge d'exit
                } else if ($consultaInsert->execute()) {
                    $ultimId = $connexio->lastInsertId();
                    echo "Article amb ID " . $ultimId . " inserit correctament ✅";
                } else echo "Error al inserir article ❌";        
            }
            break;
        
        case "Modificar":
            // obtenim l'id titol i cos del formulari
            $id = $_POST["id"] ?? null;
            $titol = $_POST["titol"] ?? null;
            $cos = $_POST["cos"] ?? null;
    
            // si falta l'id mostrem un missatge d'error
            if (empty($id)) {
                echo "Falta l'ID ❌";
                break;
            }
            
            // comprovem si existeix un article amb aquest id a la base de dades
            $consultaExistencia = $connexio->prepare("SELECT * FROM article WHERE id = :id");
            $consultaExistencia->bindParam(':id', $id);
            $consultaExistencia->execute();
    
            // si no hi ha cap article amb aquest id mostrem un error
            if ($consultaExistencia->rowCount() == 0) {
                echo "No s'ha trobat cap article amb aquest ID ❌";
                break;
            }
    
            // comencem a construir la consulta per modificar l'article
            $modificarDades = "UPDATE article SET ";
            $primeraModificacio = true;
    
            // si s'omple el titol l'afegim a la consulta
            if (!empty($titol)) {
                if (!$primeraModificacio) {
                    $modificarDades .= ", ";
                }
                $modificarDades .= "titol = :titol";
                $primeraModificacio = false;
            }
    
            // si s'omple el cos l'afegim a la consulta
            if (!empty($cos)) {
                if (!$primeraModificacio) {
                    $modificarDades .= ", ";
                }
                $modificarDades .= "cos = :cos";
                $primeraModificacio = false;
            }
    
            // si no hi ha dades per modificar mostrem un missatge d'error
            if ($primeraModificacio) {
                echo "No s'han proporcionat dades per modificar ❌";
                break;
            }
    
            // finalitzem la consulta afegint la condició where per seleccionar l'id
            $modificarDades .= " WHERE id = :id";
            $consultaModif = $connexio->prepare($modificarDades);
            $consultaModif->bindParam(':id', $id);
    
            // assignem els nous valors als seus corresponents paràmetres
            if (!empty($titol)) {
                $consultaModif->bindParam(':titol', $titol);
            }
    
            if (!empty($cos)) {
                $consultaModif->bindParam(':cos', $cos);
            }
            
            // executem la consulta de modificació i mostrem missatge d'èxit o error
            if ($consultaModif->execute()) {
                echo "Article amb ID " . $id . " modificat correctament ✅";
            } else {
                echo "Error al modificar article ❌";
            }
            break;
    
        case "Eliminar":
            // vinculem l'id del formulario a una variable
            $id = $_POST["id"] ?? null;

            // Si falta l'ID salta un error
            if (empty($id)) {
                echo "Falta l'ID ❌";
                break;
            }

            // verifiquem que l'article amb aquest id existeix
            $consultaExistencia = $connexio->prepare("SELECT * FROM article WHERE id = :id");
            $consultaExistencia->bindParam(':id', $id);
            $consultaExistencia->execute();

            if ($consultaExistencia->rowCount() == 0) {
                echo "No s'ha trobat cap article amb aquest ID ❌";
                break;
            }

            // mostrem el formulari de confirmacio d'eliminacio
            if (!isset($_POST['confirmar'])) {
                ?>
                <h2>Estàs segur que vols eliminar l'article amb ID <?php echo htmlspecialchars($id); ?>?</h2>
                <form method="post">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    <input type="hidden" name="Enviar" value="Eliminar">
                    <input type="submit" name="confirmar" value="Si">
                    <input type="submit" name="confirmar" value="No">
                </form>
                <?php
                break;
            }

            // si el usuari ha confirmat la eliminació s'elimina
            if ($_POST['confirmar'] === 'Si') {
                $consultaEliminar = $connexio->prepare("DELETE FROM article WHERE id = :id");
                $consultaEliminar->bindParam(':id', $id);

                if ($consultaEliminar->execute()) {
                    echo "Article amb ID " . htmlspecialchars($id) . " eliminat correctament ✅";
                } else {
                    echo "Error al eliminar article ❌";
                }
            } else {
                // si no, es cancela l'eliminacio
                echo "Eliminació cancel·lada ✅";
            }
            break;
    }   
} catch (PDOException $e) {
    // en cas d'error de connexió mostrem el missatge d'error
    echo "Error de connexió: " . $e->getMessage() . " ❌";
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

<!-- mostra la llista d'articles a sota de tot -->
<?php
include "../Controlador/mostrarLlista.php";
?>