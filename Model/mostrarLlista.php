<?php
// connectar a la base de dades amb PDO
try {
    $connexio = new PDO('mysql:host=localhost;dbname=pt04_miguel_hornos', 'root', '');
    $connexio->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // definim el nombre de resultats per pàgina
    $resultatsPerPagina = 5;
    
    // definim la pàgina actual, estableix la pàgina a 1 si el valor a l'url és menor a 1
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
    
    // botó de pagina seguent
    if ($paginaActual < $totalPags) {
        echo '<a href="?pagina=' . ($paginaActual + 1) . '">Següent</a>';
    }
    echo "</div>";
    
    // div per a la taula d'articles
    echo "<div class='articles'>";
    
    // mostrar la taula si hi ha articles
    if (count($articles) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Marca</th><th>Model</th><th>Color</th><th>Matricula</th><th>Mecànic</th><th>Ciutat</th></tr>";
        
        foreach ($articles as $article) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($article['ID']) . "</td>";
            echo "<td>" . htmlspecialchars($article['marca']) . "</td>";
            echo "<td>" . htmlspecialchars($article['model']) . "</td>";
            echo "<td>" . htmlspecialchars($article['color']) . "</td>";
            echo "<td>" . htmlspecialchars($article['matricula']) . "</td>";
            echo "<td>" . htmlspecialchars($article['nom_usuari']) . "</td>";
            echo "<td>" . htmlspecialchars($article['ciutat']) . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "No s'han trobat articles.<br>";
    }
    echo "</div>";
    
} catch (PDOException $e) {
    echo "Error de connexió: " . htmlspecialchars($e->getMessage()) . " ❌";
}
?>
