<?php
require_once __DIR__ . '/../config/db.php';
$connexion = getConnexion();
if ($connexion->connect_error) die("Erreur: " . $connexion->connect_error);
$sql = "SELECT 
            v.id_vente,
            v.date_vente,
            cl.nom,
            cl.prenom,
            v.id_article,
            a.designation,
            a.categorie,
            v.quantite,
            v.prixunit,
            v.remise,
            v.tva,
            v.mode_paiement,
            v.statut,
            (v.quantite * v.prixunit) AS total_ht,
            (v.quantite * v.prixunit * (1 - v.remise/100)) AS total_remise,
            (v.quantite * v.prixunit * (1 - v.remise/100) * (1 + v.tva/100)) AS total_ttc
        FROM vente v
        JOIN client cl ON v.id_client = cl.id_client
        JOIN articles a ON v.id_article = a.id_article
        ORDER BY v.date_vente DESC, v.id_vente";

$resultat = $connexion->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ventes</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 98%; margin: 20px auto; font-size: 13px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .boutons { text-align: center; margin: 20px; }
        .btn { padding: 10px 20px; margin: 0 10px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; text-decoration: none; display: inline-block; }
        .btn-ajouter { background-color: #008CBA; color: white; }
        .btn-retour { background-color: #555555; color: white; }
        .total { font-weight: bold; text-align: right; }
        .statut-payee { color: green; font-weight: bold; }
        .statut-annulee { color: red; font-weight: bold; }
        .statut-cours { color: orange; font-weight: bold; }
    </style>
</head>
<body>
    <h2 style="text-align:center">Tableau des ventes détaillé</h2>
    
    <table>
        <tr>
            <th>N°</th>
            <th>Date</th>
            <th>Client</th>
            <th>Article</th>
            <th>Catégorie</th>
            <th>Qté</th>
            <th>PU HT</th>
            <th>Remise</th>
            <th>TVA</th>
            <th>Total HT</th>
            <th>Total TTC</th>
            <th>Paiement</th>
            <th>Statut</th>
        </tr>
        <?php
        $total_general_ttc = 0;
        if ($resultat->num_rows > 0) {
            while($ligne = $resultat->fetch_assoc()) {
                $classe_statut = 'statut-'.strtolower(str_replace('é', 'e', $ligne["statut"]));
                echo "<tr>";
                echo "<td>".$ligne["id_vente"]."</td>";
                echo "<td>".date('d/m/Y H:i', strtotime($ligne["date_vente"]))."</td>";
                echo "<td>".htmlspecialchars($ligne["nom"])." ".htmlspecialchars($ligne["prenom"])."</td>";
                echo "<td>".htmlspecialchars($ligne["id_article"])." - ".htmlspecialchars($ligne["designation"])."</td>";
                echo "<td>".htmlspecialchars($ligne["categorie"])."</td>";
                echo "<td>".$ligne["quantite"]."</td>";
                echo "<td>".number_format($ligne["prixunit"], 2, ',', ' ')." €</td>";
                echo "<td>".$ligne["remise"]."%</td>";
                echo "<td>".$ligne["tva"]."%</td>";
                echo "<td class='total'>".number_format($ligne["total_ht"], 2, ',', ' ')." €</td>";
                echo "<td class='total'>".number_format($ligne["total_ttc"], 2, ',', ' ')." €</td>";
                echo "<td>".$ligne["mode_paiement"]."</td>";
                echo "<td class='$classe_statut'>".$ligne["statut"]."</td>";
                echo "</tr>";
                if($ligne["statut"] == 'Payée') $total_general_ttc += $ligne["total_ttc"];
            }
            echo "<tr style='background-color:#ddd;'>";
            echo "<td colspan='10' class='total'>TOTAL VENTES PAYÉES TTC</td>";
            echo "<td colspan='3' class='total'>".number_format($total_general_ttc, 2, ',', ' ')." €</td>";
            echo "</tr>";
        } else {
            echo "<tr><td colspan='13'>Aucune vente trouvée</td></tr>";
        }
        $connexion->close();
        ?>
    </table>
</body>
</html>