<?php
require_once __DIR__ . '/../config/db.php';
$connexion = getConnexion();
if ($connexion->connect_error) die("Erreur: " . $connexion->connect_error);
$message = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_client = $_POST['id_client'];
    $id_article = $_POST['id_article'];
    $quantite = $_POST['quantite'];
    $prixunit = $_POST['prixunit'];
    $remise = $_POST['remise'];
    $tva = $_POST['tva'];
    $mode_paiement = $_POST['mode_paiement'];
    $statut = $_POST['statut'];

    $sql = "INSERT INTO vente (id_client, id_article, quantite, prixunit, remise, tva, mode_paiement, statut) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("isidddss", $id_client, $id_article, $quantite, $prixunit, $remise, $tva, $mode_paiement, $statut);
    
    if ($stmt->execute()) {
        $success = true;
        $message = "Vente enregistrée avec succès !";
        // Actualise la page pour vider le formulaire
        header("Refresh: 2; url=enregistrervente.php");
    } else {
        $message = "Erreur : " . $stmt->error;
    }
    $stmt->close();
}

$clients = $connexion->query("SELECT id_client, nom, prenom FROM client ORDER BY nom");
$articles = $connexion->query("SELECT id_article, designation FROM articles ORDER BY designation");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nouvelle vente</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { width: 500px; margin: 30px auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        .row { display: flex; gap: 10px; }
        .col { flex: 1; }
        .btn-submit { background-color: #4CAF50; color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; width: 100%; margin-top: 20px; font-size: 16px; }
        .btn-submit:hover { background-color: #45a049; }
        .btn-retour { display: block; text-align: center; margin-top: 15px; color: #555; text-decoration: none; }
        .erreur { color: red; text-align: center; margin-bottom: 15px; }
        .succes { color: green; text-align: center; margin-bottom: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Enregistrer une vente</h2>
        <?php 
        if($message) {
            $class = $success ? 'succes' : 'erreur';
            echo "<p class='$class'>$message</p>";
        }
        ?>
        
        <form method="POST" action="">
            <label>Client :</label>
            <select name="id_client" required>
                <option value="">-- Choisir un client --</option>
                <?php 
                $clients->data_seek(0); // Reset le curseur
                while($cl = $clients->fetch_assoc()) {
                    echo "<option value='".$cl['id_client']."'>".htmlspecialchars($cl['nom'])." ".htmlspecialchars($cl['prenom'])."</option>";
                } ?>
            </select>

            <label>Article :</label>
            <select name="id_article" required>
                <option value="">-- Choisir un article --</option>
                <?php 
                $articles->data_seek(0); // Reset le curseur
                while($ar = $articles->fetch_assoc()) {
                    echo "<option value='".$ar['id_article']."'>".htmlspecialchars($ar['id_article'])." - ".htmlspecialchars($ar['designation'])."</option>";
                } ?>
            </select>

            <div class="row">
                <div class="col">
                    <label>Quantité :</label>
                    <input type="number" name="quantite" min="1" value="1" required>
                </div>
                <div class="col">
                    <label>Prix unitaire HT :</label>
                    <input type="number" step="0.01" name="prixunit" required>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>Remise % :</label>
                    <input type="number" step="0.01" name="remise" value="0">
                </div>
                <div class="col">
                    <label>TVA % :</label>
                    <input type="number" step="0.01" name="tva" value="20">
                </div>
            </div>

            <label>Mode de paiement :</label>
            <select name="mode_paiement">
                <option value="Espèces">Espèces</option>
                <option value="Carte">Carte bancaire</option>
                <option value="Chèque">Chèque</option>
                <option value="Virement">Virement</option>
            </select>

            <label>Statut :</label>
            <select name="statut">
                <option value="Payée">Payée</option>
                <option value="En cours">En cours</option>
                <option value="Annulée">Annulée</option>
            </select>

            <button type="submit" class="btn-submit">Enregistrer la vente</button>
            <a href="voirvente.php" class="btn-retour">Voir le tableau des ventes</a>
        </form>
    </div>
</body>
</html>
<?php $connexion->close(); ?>