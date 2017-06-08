<?php include('header.php'); 
require_once('../includes/fonctions.php');
$db = connect(); 


function getTaches($db) {
  $sql = "SELECT id, societe, client, adresse, libelle, etat, date FROM taches";
  try {
    $retour["donnees"] = $db->query($sql);
    $retour["statut"] = "ok";
  } catch (PDOException $erreur) {
    $retour["donnees"] = $erreur->getMessage();
    $retour["statut"] = "erreur";
  }
  return $retour;
}

?>

      
<body>
    <!-- img de fond accueil -->
<?php include('menu.php'); ?>

    
<div class="mainAccueil">
        <select id="SelectTypeTache">
            <option disabled selected value> -- Filtrer par Type -- </option>
            <option>Tâches crée</option>
            <option>Tâches en cours</option>
            <option>Tâche terminée</option>
        </select>

    <div class="Contentsearch">
        <span class="fa fa-search"></span>
        <input type="search" id="rechercher" placeholder="Rechercher une tâche">
    </div>    
</div>
    
    
<h1 class="custom-h1">Liste des tâches crée</h1>

<div class="ContentSecretaire">
    
    <?php 
    function listeTaches($db) {
      
  $contenu = array();
  $contenu["corps"] = "";

  $donnees = getTaches($db);

  if($donnees["statut"] == "ok") {
      
    while($tache = $donnees["donnees"]->fetch()) {
        
    $id = $tache["id"];
    $societe = $tache["societe"];
    $client = $tache["client"];
    $adresse = $tache["adresse"];
    $libelle = $tache["libelle"];
    $etat = $tache["etat"];
    $date = $tache["date"];

        
    $contenu["corps"].="
        <div class='taches'>
        <a href='detailTache.php?id=".$tache["id"]."'>
        <div class='row'>
            <p>Vendredi</p>
                <p class='left85'>$date</p>  
        </div>
        
        <div class='row'>
            <p><input type='button' name='pseudo' class='importanceRed'><b> - </b> ID : 1 - $societe - $client - $adresse</p>
            <p class='left75 top10px'><img src='../assets/icon/arrow-left.png' class='arrow-left'></p>
        </div>
        <p class='left70 top-20'>$libelle</p>
        </a>
        <div class='retourligne'></div>

        <hr>
        <ul id='mesActions'>
        <li><i class='fa fa-pencil-square-o fa-2x'></i><a href='modifTache.php?id=".$tache["id"]."'>Modifier</a></li>
            <li><i class='fa fa-trash-o fa-2x'></i><a href='delete.php?id=".$tache["id"]."'>Supprimer</a></li>
        </ul>
    </div>";
        
    }
  } else {
    $contenu["corps"].="<p class='erreur'>".$donnees["donnees"]."</p>";
  }

  return $contenu;
}

$page = listeTaches($db);
echo $page["corps"];

?>    
</div><!-- end ContentSecretaire -->
    

    
    
<script src="https://use.fontawesome.com/39cfcc7a15.js"></script>
</body>
    
