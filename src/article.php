<?php
require_once __DIR__ . '/../config/db.php';
$connexion = getConnexion();
if ($connexion->connect_error) die("Erreur: " . $connexion->connect_error);
$sql = "SELECT id_article, designation, prix, categorie FROM articles";
$resultat = $connexion->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Articles</title>
    <style>
        table { border-collapse: collapse; width: 90%; margin: 20px auto; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .boutons { text-align: center; margin: 20px; }
        .btn {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-ajouter { background-color: #008CBA; color: white; }
        .btn-retour { background-color: #555555; color: white; }
        .btn:hover { opacity: 0.8; }
    </style>
</head>
<body>
    <h2 style="text-align:center"> – Infos articles</h2>

    <div class="boutons">
        <a href="ajoutarticle.php" class="btn btn-ajouter">+ Ajouter un article</a>
        <button onclick="history.back()" class="btn btn-retour">← Retour</button>
    </div>

    <table>
        <tr>
            <th>id_article</th>
            <th>designation</th>
            <th>prix</th>
            <th>categorie</th>
        </tr>
        <?php
        if ($resultat->num_rows > 0) {
            while($ligne = $resultat->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".htmlspecialchars($ligne["id_article"])."</td>";
                echo "<td>".htmlspecialchars($ligne["designation"])."</td>";
                echo "<td>".number_format($ligne["prix"], 2, ',', ' ')." €</td>";
                echo "<td>".htmlspecialchars($ligne["categorie"])."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Aucun article trouvé</td></tr>";
        }
        $connexion->close();
        ?>
    </table>
</body>
</html>