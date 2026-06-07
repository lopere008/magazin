<?php
require_once __DIR__ . '/../config/db.php';
$connexion = getConnexion();
if ($connexion->connect_error) die("Erreur: " . $connexion->connect_error);
$message = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_article = $_POST['id_article'];
    $designation = $_POST['designation'];
    $prix = $_POST['prix'];
    $categorie = $_POST['categorie'];

    $sql = "INSERT INTO articles (id_article, designation, prix, categorie) VALUES (?, ?, ?, ?)";
    
    $stmt = $connexion->prepare($sql);
    $stmt->bind_param("ssds", $id_article, $designation, $prix, $categorie);
    
    if ($stmt->execute()) {
        $success = true;
        $message = "Article ajouté avec succès !";
        header("Refresh: 2; url=voir_article.php"); // Remplace par le nom de ta page liste
    } else {
        $message = "Erreur : " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ajouter un article</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { width: 500px; margin: 30px auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        .btn-submit { background-color: #008CBA; color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; width: 100%; margin-top: 20px; font-size: 16px; }
        .btn-submit:hover { background-color: #007399; }
        .btn-retour { display: block; text-align: center; margin-top: 15px; color: #555; text-decoration: none; }
        .erreur { color: red; text-align: center; margin-bottom: 15px; }
        .succes { color: green; text-align: center; margin-bottom: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ajouter un article</h2>
        <?php 
        if($message) {
            $class = $success ? 'succes' : 'erreur';
            echo "<p class='$class'>$message</p>";
        }
        ?>
        
        <form method="POST" action="">
            <label>Id Article :</label>
            <input type="text" name="id_article" required>

            <label>Désignation :</label>
            <input type="text" name="designation" required>

            <label>Prix :</label>
            <input type="number" step="0.01" name="prix" required>

            <label>Catégorie :</label>
            <input type="text" name="categorie" required>

            <button type="submit" class="btn-submit">Enregistrer l'article</button>
            
        </form>
    </div>
</body>
</html>
<?php $connexion->close(); ?>