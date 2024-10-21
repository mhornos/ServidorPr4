<!-- Miguel Angel Hornosa -->
<?php
// conectar a la base de dades amb PDO
try {
    $connexio = new PDO('mysql:host=localhost;dbname=pt04_miguel_hornos', 'root', '');
    $connexio->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // cefinir el nombre de resultats per pàgina
    $resultatsPerPagina = 5;
    
    // cefinir la pàgina actual
    $paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    if ($paginaActual < 1) {
        $paginaActual = 1;
    }
    
    // calcular l'offset
    $offset = ($paginaActual - 1) * $resultatsPerPagina;
    
    // consulta per comptar el total d'articles
    $consultaTotal = $connexio->prepare("SELECT COUNT(*) as total FROM article");
    $consultaTotal->execute();
    $totalArticles = $consultaTotal->fetchColumn();
    
    // calcular el número total de pàgines
    $totalPags = ceil($totalArticles / $resultatsPerPagina);
    
    // consulta per obtenir els articles per a la pàgina actual
    $consulta = $connexio->prepare("
        SELECT a.*, u.ciutat 
        FROM article a 
        LEFT JOIN usuaris u ON a.nom_usuari = u.nombreUsuario 
        LIMIT :offset, :limit
    ");
    $consulta->bindValue(':offset', $offset, PDO::PARAM_INT);
    $consulta->bindValue(':limit', $resultatsPerPagina, PDO::PARAM_INT);
    $consulta->execute();
    
    // obtenir articles
    $articles = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
    // div per a la paginació
    echo "<div class='paginacio'>";
    
    // botó de página anterior
    if ($paginaActual > 1) {
        echo '<a href="?pagina=' . ($paginaActual - 1) . '">Anterior</a>';
    }
    
    // enllaços a totes les pàgines
    for ($i = 1; $i <= $totalPags; $i++) {
        if ($i == $paginaActual) {
            echo '<strong>' . $i . '</strong>'; // destacar la pàgina actual
        } else {
            echo '<a href="?pagina=' . $i . '">' . $i . '</a>';
        }
    }
    
    // botó de pàgina següent
    if ($paginaActual < $totalPags) {
        echo '<a href="?pagina=' . ($paginaActual + 1) . '">Següent</a>';
    }
    echo "</div> <br>";
    
    // div per als articles
    echo "<div class='articles-container'>";
    
    // mostrar els articles si n'hi ha
    if (count($articles) > 0) {
        foreach ($articles as $article) {
            echo "<div class='article-box'>";
            echo "<td>" . htmlspecialchars($article['ID']) . "</td>";
            echo "<h3>" . htmlspecialchars($article['marca']) . "</h3>";
            echo "<p><strong>Model:</strong> " . htmlspecialchars($article['model']) . "</p>";
            echo "<p><strong>Color:</strong> " . htmlspecialchars($article['color']) . "</p>";
            echo "<p><strong>Matrícula:</strong> " . htmlspecialchars($article['matricula']) . "</p>";
            echo "<p><strong>Mecànic:</strong> " . htmlspecialchars($article['nom_usuari']) . "</p>";
            echo "<p><strong>Ciutat:</strong> " . htmlspecialchars($article['ciutat']) . "</p>";
            
            // mostrar la imatge si existeix
            if (!empty($article['imatge'])) {
                echo "<img src='" . htmlspecialchars($article['imatge']) . "' alt='Imatge' width='150'>";
            } else {
                echo "<p>No hi ha imatge</p>";
            }
            echo "</div>";
        }
    } else {
        echo "<p>No s'han trobat articles.</p>";
    }
    
    echo "</div>";
    
} catch (PDOException $e) {
    echo "Error de connexió: " . htmlspecialchars($e->getMessage()) . " ❌";
}
?>
