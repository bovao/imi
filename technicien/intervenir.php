<?php include('header.php'); 

require_once("../includes/fonctions.php");
$db = connect(); 
session_start();


//Insertion des données
if($_SERVER["REQUEST_METHOD"] == "POST"){
   // copieNB, copieCouleur, arrive, depart, s, statut

  $copieNB = verifChampRempli("copieNB");
  $copieCouleur = verifChampRempli("copieCouleur");
  $arrive = verifChampRempli("arrive");
  $depart = verifChampRempli("depart");
  $descriptionIntervention = verifChampRempli("descriptionIntervention");
  $statut = verifChampRempli("statut");
    
if(empty($erreur)) {
      $sql = "INSERT INTO interventions VALUES (NULL, :copieNB, :copieCouleur, :arrive, :depart, :descriptionIntervention, :statut, NOW())";
  try {
    $req = $db->prepare($sql);
        $req->bindParam(':copieNB', $copieNB, PDO::PARAM_INT);
        $req->bindParam(':copieCouleur', $copieCouleur, PDO::PARAM_INT);
        $req->bindParam(':arrive', $arrive, PDO::PARAM_INT);
        $req->bindParam(':depart', $depart, PDO::PARAM_INT);
        $req->bindParam(':descriptionIntervention', $descriptionIntervention, PDO::PARAM_STR);    
        $req->bindParam(':statut', $statut, PDO::PARAM_STR); 
        $req->execute();
        echo "<script>alert(\"Nouvelle interventions ajouté !\")</script>"; 
        header("location:intervenir.php?add=ok");
  } catch (PDOException $erreur) {
        echo $erreur->getMessage();
    }
  
}  //end empty(erreur)   


} //end $_SERVER post 



if(!empty($erreur)) {
    echo "<p class='erreur'>";
    foreach ($erreurs as $value) {
        echo $value.'<br />';
    }
    echo "</p>";
}
?>


<body>

<div id="bloc_page">
    
<div class="row entete"> 
    <a href="detailTache.php" class="marginleft2 white left a-custom"><i class="fa fa-arrow-left fa-2x icon-logout"></i></a>
    <h1 class="h1-custom2">Intervention 1</h1>
</div>
    
<form action="" method="POST">
  <input type="hidden" name="id" value="<?php echo intval($_GET["id"]); ?>">
    <div class="row">
        <div class="col3">
         <fieldset><legend>Détails :</legend> 
            <input type="hidden" name="id" value="<?php echo intval($_GET["id"]); ?>">
             
             <input <?php if(isset($erreurs['copieNB'])) echo "class='erreur custom-input'"; ?>type="text" name="copieNB" value="<?php if(isset($copieNB)) echo $copieNB; ?>" placeholder="Nb copie N&B" class="custom-input" /> <!-- pseudo -->
             

            <input type="text" name="copieCouleur" placeholder="Nb copie couleur" class="custom-input" 
                 value="<?php echo $copieCouleur; ?>"/>
             
            <input type="time" name="arrive" class="custom-input" 
                    value="<?php echo $arrive; ?>"/><b>Arrivé</b>
            
             <b>Départ</b><input type="time" name="depart" class="custom-input" 
                value="<?php echo $depart; ?>"/>

            <textarea placeholder="Votre message..." class="custom-textarea" name="descriptionIntervention"
                value="<?php echo $descriptionIntervention; ?>"></textarea>
             
            <select id="" name="statut" class="custom-select">
                <option selected disabled>-- Etat / Statut -- </option>
                <option value="tacheEnCours">Tâches en cours</option>
                <option value="tachesEffectuee">Tâche Effectue</option>
            </select>
    
            <input type="submit" value="Valider" class="btnIntervenir"/>  <!-- btn inscription -->
        </fieldset> 
        </div>
    </div>
</form>
        
</div>

<script src="https://use.fontawesome.com/39cfcc7a15.js"></script>
</body>

<?php
function getInterventionsDetails($db, $id) {
  $sql = "SELECT * FROM interventions WHERE id = :id";
  try {
    // On prépare la requête : elle est envoyée au serveur sans les données variables
    $req = $db->prepare($sql);
    // On lie la donnée récupérée en GET avec notre requête préparée, et on déclare qu'elle doit être un entier.
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    // Exécution de la requête
    $req->execute();
    // Je récupère l'ensemble des données retournées par la requête grâce à fetchAll
    $interventions = $req->fetchAll()[0];
    // j'assigne ces données à mes variables utilisées dans mon formulaire
    return $interventions;

  } catch (PDOException $erreur) {
    echo $erreur->getMessage();
  }
}

$interventions = getInterventionsDetails($db, $_GET['id']);
extract($interventions);

//Recup le detail de la tâche pour mettre à jour le statut de la tâche afin de la basculé et ne plus l'affiche ds Taches.php
   $tache = getDetailsTache($db, $_GET["id"]);
   extract($tache);

//met à jour l'état de la tache 
if($statut == "tachesEffectuee"){
     $sql = "UPDATE taches SET id = :id, etat = 'tachesEffectuee' WHERE id = :id";
     try {
        $req = $db->prepare($sql);
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->bindParam(':statut', $statut, PDO::PARAM_STR);
        $req->execute();
        echo "<script>alert(\"Taches mise à jour !\")</script>"; 
        header("location:taches.php?edit=ok");
     }//end try
    catch (PDOException $erreur) {
        echo $erreur->getMessage();
    }
}//end if

?>


    
