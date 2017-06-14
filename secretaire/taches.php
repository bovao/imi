<?php include('header.php'); 
require_once('../includes/fonctions.php');
$db = connect(); 


?>

      
<body>
    <!-- img de fond accueil -->
<?php include('menu.php'); ?>

    
<div class="mainAccueil">
<form method="post" action="">
    <select name="trier" id="SelectTypeTache">
        <option disabled selected value> -- Filtrer par -- </option>
        <option value="tri_encours" >Tâches en cours</option>
        <option value="tri_terminee">Tâche terminée</option>
    </select>
    <input type="submit" valu="ok"/>
</form>
    
    <div class="Contentsearch">
        <span class="fa fa-search"></span>
        <input type="search" id="rechercher" placeholder="Rechercher une tâche">
    </div>    
</div>
    
    
<h1 class="custom-h1">Liste des tâches</h1>

<div class="ContentSecretaire">
    
<!-- traitement des données --> 
    <?php 
function listeTaches($db) {
      
  $contenu = array();
  $contenu["corps"] = "";
     //tri tache en cours
    if(!empty($_POST["trier"]) && $_POST["trier"] == "tri_encours"){
        $donnees = getTacheEnCours($db);
    }
     //tri tache effectuee
    if(!empty($_POST["trier"]) && $_POST["trier"] == "tri_terminee"){
        $donnees = getTacheEffectuee($db);
    }
    else if(empty($_POST["trier"])) {
        $donnees = getTaches($db);
    }

  if($donnees["statut"] == "ok") {
      
    while($tache = $donnees["donnees"]->fetch()) {
        
    $id = $tache["id"];
    $societe = $tache["societe"];
    $client = $tache["client"];
    $adresse = $tache["adresse"];
    $libelle = $tache["libelle"];
    $etat = $tache["etat"];        
    $date = strtotime($tache["date"]);
     
     $format = new IntlDateFormatter("fr_FR", IntlDateFormatter::FULL, IntlDateFormatter::NONE);
     $datePropre = $format->format($date);
     
     
     $jour = explode(" ", $datePropre);
     $jourLettre = $jour[0];
     $jourNum = $jour[1];
     $jourMois= $jour[2];
     $jourAnnee = $jour[3];
?>
    
    
<script>
function confirmationSuppression(){
  if(confirm("Sur ?")) {
      <?php 
        header("location:'delete.php?id=".$tache["id"]."'");
        ?>
    }  
}
</script>

<!-- Affichage des données --> 
<?php
    $contenu["corps"].="
        <div class='taches'>
        <a href='detailTache.php?id=".$tache["id"]."'>
        <div class='row'>
            <p>$jourLettre</p>
                <p class='left85'>$jourNum $jourMois $jourAnnee</p>  
        </div>
        
        <div class='row'>
            <p><input type='button' name='pseudo' class='importanceRed'><b> - </b> ID : $id - $societe - $client - $etat</p>
            <p class='left65 top10px'><img src='../assets/icon/arrow-left.png' class='arrow-left'></p>
        </div>
        <p class='left70 top-20'>$libelle</p>
        </a>
        <div class='retourligne'></div>

        <hr>
        <ul id='mesActions'>
        <li><i class='fa fa-pencil-square-o fa-2x'></i><a href='modifTache.php?id=".$tache["id"]."'>Modifier</a></li>
            <li><i class='fa fa-trash-o fa-2x'></i>
            
            <a href='' onclick='confirmationSuppression()'>Supprimer
            </a>
                        
            </li>
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
    
