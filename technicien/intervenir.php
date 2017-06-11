<?php include('header.php'); 

require_once("../includes/fonctions.php");
$db = connect(); 
session_start();
?>
    


<body>

<?php
if(!empty($erreur)) {
    echo "<p class='erreur'>";
    foreach ($erreurs as $value) {
        echo $value.'<br />';
    }
    echo "</p>";
}
?>


<div id="bloc_page">
    
<div class="row entete"> 
    <a href="detailTache.php" class="marginleft2 white left a-custom"><i class="fa fa-arrow-left fa-2x icon-logout"></i></a>
    <h1 class="h1-custom2">Intervention 1</h1>
</div>
    
<form action="" method="POST">
    <div class="row">
        <div class="col3">
         <fieldset><legend>Détails :</legend> 
            <input type="hidden" name="id" value="<?php echo intval($_GET["id"]); ?>">
             
             <input <?php if(isset($erreurs['copieNB'])) echo "class='erreur'"; ?>type="text" name="copieNB" value="<?php if(isset($copieNB)) echo $copieNB; ?>" placeholder="Nb copie N&B" class="custom-input" /> <!-- pseudo -->
             

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
        header("location:intervenir.php?intervention=ok");
        echo "<script>alert(\"Nouvelle intervention effectuée !\")</script>"; 
  } catch (PDOException $erreur) {
        echo $erreur->getMessage();
    }
  
    if($_POST["statut"] == "tachesEffectuee"){
         $sql = "UPDATE taches SET etat = :etat WHERE etat = 'TacheEffectue' and id = :id  ";
         try {
            $req = $db->prepare($sql);
            $req->bindParam(':statut', $statut, PDO::PARAM_STR);
            $req->execute();
            header("location:taches.php?intervention=ok");
            echo "<script>alert(\"Taches mise à jour !\")</script>"; 
         }//end try
        catch (PDOException $erreur) {
            echo $erreur->getMessage();
        }
    }//end if

}  //end empty(erreur)   


}
?>

    
