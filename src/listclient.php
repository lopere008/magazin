<?php
require_once __DIR__ . '/../config/db.php';
$connexion = getConnexion();
if ($connexion->connect_error) die("Erreur: " . $connexion->connect_error);
$sql = "SELECT id_client, nom, prenom, ville, cp FROM client ORDER BY nom, prenom";
$resultat = $connexion->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des clients</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 80%; margin: 20px auto; font-size: 14px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Liste des clients</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Ville</th>
            <th>Code Postal</th>
        </tr>
        <?php
        if ($resultat->num_rows > 0) {
            while($ligne = $resultat->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$ligne["id_client"]."</td>";
                echo "<td>".htmlspecialchars($ligne["nom"])."</td>";
                echo "<td>".htmlspecialchars($ligne["prenom"])."</td>";
                echo "<td>".htmlspecialchars($ligne["ville"])."</td>";
                echo "<td>".htmlspecialchars($ligne["cp"])."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='text-align:center'>Aucun client trouvé</td></tr>";
        }
        $connexion->close();
        ?>
    </table>
</body>
</html>