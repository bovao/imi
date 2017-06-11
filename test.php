<?php include('header.php'); 
require_once('../includes/fonctions.php');
$db = connect(); 

function getDetailsTache($db, $id){
    $sql = "SELECT id, societe, client, adresse, duree, libelle, secteur, assignea, etat, file, descriptionTache, date 
    FROM taches WHERE id = :id";
    try {
    $req = $db->prepare($sql);
        $req->bindParam(':societe', $societe, PDO::PARAM_STR);
        $req->bindParam(':client', $client, PDO::PARAM_STR);
        $req->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $req->bindParam(':libelle', $libelle, PDO::PARAM_STR);    
        $req->bindParam(':secteur', $secteur, PDO::PARAM_STR); 
        $req->bindParam(':assignea', $assignea, PDO::PARAM_STR);
        $req->bindParam(':etat', $etat, PDO::PARAM_STR);
        $req->bindParam(':file', $file, PDO::PARAM_STR);
        $req->bindParam(':descriptionTache', $descriptionTache, PDO::PARAM_STR);
    $req->execute();
    // Je récupère l'ensemble des données retournées par la requête grâce à fetchAll
    $tache = $req->fetchAll()[0];
    return $tache;
  }
    catch (PDOException $erreur) {
    echo $erreur->getMessage();
  }
}


?>


<body>
    <!-- img de fond accueil -->
<?php include('menu.php'); ?>
    
<h1 class="custom-h1">Liste des tâches crée</h1>

<form action="modifTache.php" method="post">
<?php 
function listeTaches($db) {      
  $contenu = array();
  $contenu["corps"] = "";
  $donnees = getDetailsTache($db, $id);
  if($donnees["statut"] == "ok") {
    while($tache = $donnees["donnees"]->fetch()) {
        
    $id = $tache["id"];
    $societe = $tache["societe"];
    $client = $tache["client"];
    $adresse = $tache["adresse"];
    $secteur = $tache["secteur"];
    $duree = $tache["duree"];
    $assignea = $tache["assignea"];
    $descriptionTache = $tache["descriptionTache"];


        
    $contenu["corps"].="
        <div class='filterMessagerie'>
        <input type='hidden' name='id' value='<?php echo intval($_GET['id']); ?>'>
        <input type='button' name='societe' class='importanceRed'>
        <input type='button' name='societe' value='Societe : <?php if(isset($societe)) echo $societe; ?>' class='custom-input3'>
        <input type='button' name='client' value='Client : <?php if(isset($client)) echo $client; ?>' class='custom-input3'>
        <input type='button' name='adresse' value='Adresse : <?php if(isset($adresse)) echo $adresse; ?>' class='custom-input3'>
        <input type='button' name='secteur' value='Secteur : <?php if(isset($secteur)) echo $secteur; ?>' class='custom-input3'>
        <input type='button' name='duree' value='Durée : <?php if(isset($duree)) echo $duree; ?>' class='custom-input3'>

        <input type='button' name='assignea' value='Assigné à : <?php if(isset($assignea)) echo $assignea; ?>' class='custom-input3'>
    </div><div class='retourligne'></div>
    
    <textarea placeholder='Votre message...' class='custom-textarea2' value=''>
        Description : <?php if(isset($descriptionTache)) echo $descriptionTache; ?></textarea>
    
    <img src='../assets/img/vitrecassé.jpeg' class='imgTache'>
    ";
        
    }
  } else {
    $contenu["corps"].="<p class='erreur'>".$donnees["donnees"]."</p>";
  }

  return $contenu;
}

$page = listeTaches($db);
echo $page["corps"];

?>    
</form><!-- end ContentSecretaire -->
    

    
    
<script src="https://use.fontawesome.com/39cfcc7a15.js"></script>
</body>
    
