<?php include('header.php');


require_once('../includes/fonctions.php');
$db = connect(); 



function getDetailsTache($db, $id) {
  $sql = "SELECT * FROM taches WHERE id = :id";
  // 2 - Envoi de la requête avec la méthode try catch
  try {
    // On prépare la requête : elle est envoyée au serveur sans les données variables
    $req = $db->prepare($sql);
    // On lie la donnée récupérée en GET avec notre requête préparée, et on déclare qu'elle doit être un entier.
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    // Exécution de la requête
    $req->execute();
    // Je récupère l'ensemble des données retournées par la requête grâce à fetchAll
    $membre = $req->fetchAll()[0];
    // j'assigne ces données à mes variables utilisées dans mon formulaire
    return $membre;

  } catch (PDOException $erreur) {
    echo $erreur->getMessage();
  }
}

  // si je rentre en GET (sans soumission de formulaire), je récupère simplement les données de l'utilisateur passé en get
$tache = getDetailsTache($db, $_GET["id"]);
extract($tache);

?>
    

<body>
<?php include('menu.php'); ?>


<h1 class="custom-h1">Details tâche</h1>
    <form action="modifTache.php" method="post">
    <div class="filterMessagerie">
        <input type="button" name="societe" class="importanceRed">
        <input type="button" name="societe" value="Societe : <?php if(isset($societe)) echo $societe; ?>" class="custom-input3">
        <input type="button" name="client" value="Client : <?php if(isset($client)) echo $client; ?>" class="custom-input3">
        <input type="button" name="adresse" value="<?php if(isset($adresse)) echo $adresse; ?>" class="custom-input3">
        <input type="button" name="secteur" value="Secteur : <?php if(isset($secteur)) echo $secteur; ?>" class="custom-input3">
        <input type="button" name="duree" value="Durée : <?php if(isset($duree)) echo $duree; ?>" class="custom-input3">

        <input type="button" name="assignea" value="Assigné à : <?php if(isset($assignea)) echo $assignea; ?>" class="custom-input3">
    </div><div class="retourligne"></div>
    
    <textarea placeholder="Votre message..." class="custom-textarea2" disabled>
        Description : <?php if(isset($descriptionTache)) echo $descriptionTache; ?></textarea>
    
    <img src="../assets/img/vitrecassé.jpeg" class="imgTache">
    </form>
<script src="https://use.fontawesome.com/39cfcc7a15.js"></script>
</body>
    
