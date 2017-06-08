<?php include('header.php');

require_once("../includes/fonctions.php");
$db = connect(); 

include('menu.php');


function updateTache($db, $tabMembre) {
  $sql = "UPDATE taches
  SET id = :id, societe = :societe, client = :client, adresse = :adresse, duree = :duree, libelle = :libelle, secteur = :secteur, assignea = :assignea, etat = :etat, file = :file, descriptionTache = :descriptionTache WHERE id = :id";
  // 2 - Envoi de la requête avec la méthode try catch
  try {
    $req = $db->prepare($sql);
        $req->bindParam(':id', $tabMembre["id"], PDO::PARAM_INT);
        $req->bindParam(':societe', $tabMembre["societe"], PDO::PARAM_STR);
        $req->bindParam(':client',  $tabMembre["client"], PDO::PARAM_STR);
        $req->bindParam(':adresse', $tabMembre["adresse"], PDO::PARAM_STR);
        $req->bindParam(':duree',   $tabMembre["duree"], PDO::PARAM_STR);
        $req->bindParam(':libelle', $tabMembre["libelle"], PDO::PARAM_STR);    
        $req->bindParam(':secteur', $tabMembre["secteur"], PDO::PARAM_STR); 
        $req->bindParam(':assignea',$tabMembre["assignea"], PDO::PARAM_STR);
        $req->bindParam(':etat',  $tabMembre["etat"], PDO::PARAM_STR);
        $req->bindParam(':file',  $tabMembre["file"], PDO::PARAM_STR);
        $req->bindParam(':descriptionTache',  $tabMembre["descriptionTache"], PDO::PARAM_STR);
      
        $req->execute();
        header("location:taches.php?modif=ok");
        echo "<script>alert(\"Nouvelle modification effectué !\")</script>"; 
  } catch (PDOException $erreur) {
    echo $erreur->getMessage();
  }
}

function verifTexte($donnee, $longueur=46) {
  if(empty($donnee) || strlen($donnee) > $longueur) {
    return false;
  } else {
    return htmlspecialchars($donnee);
  }
}


function verifFormulaire() {
  $retour = array(
    "erreur" => array(),
    "donnees" => array()
  );

  if(!empty($_POST["id"])) {
    $retour["donnees"]["id"] = intval($_POST["id"]);
  } else {
    $retour["erreur"]["id"] = "Un problème est survenu !";
  }
  if(!$retour["donnees"]["societe"] = verifLongueur("societe", 3) ) {
    $retour["erreur"]["societe"] = "La longueur de votre societe doit être comprise entre 0 et 45 caractères.";
  }
  if(!$retour["donnees"]["client"] = verifLongueur("client", 3) ) {
    $retour["erreur"]["client"] = "La longueur de votre client doit être comprise entre 0 et 45 caractères.";
  }
  if(!$retour["donnees"]["adresse"] =  verifLongueur("adresse", 8) ) {
    $retour["erreur"]["adresse"] = "La longueur de votre adresse doit être comprise entre 0 et 45 caractères.";
  }
  if(!$retour["donnees"]["duree"] = verifChampRempli("duree") ) {
    $retour["erreur"]["duree"] = "Votre âge doit être compris entre 17 et 127 ans.";
  }
  if(!$retour["donnees"]["libelle"] = verifLongueur("libelle", 4) ) {
    $retour["erreur"]["libelle"] = "La longueur de votre libelle doit être comprise entre 0 et 21 caractères.";
  }
  if(!$retour["donnees"]["secteur"] = verifChampRempli("secteur") ) {
    $retour["erreur"]["secteur"] = "La longueur de votre secteur doit être comprise entre 0 et 21 caractères.";
  }
  if(!$retour["donnees"]["assignea"] = verifChampRempli("assignea") ) {
    $retour["erreur"]["assignea"] = "La longueur de votre assignea doit être comprise entre 0 et 21 caractères.";
  }
  if(!$retour["donnees"]["etat"] = verifChampRempli("etat") ) {
    $retour["erreur"]["etat"] = "La longueur de votre etat doit être comprise entre 0 et 21 caractères.";
  }
  if(!$retour["donnees"]["file"] = verifChampRempli("file") ) {
    $retour["erreur"]["file"] = "La longueur de votre file doit être comprise entre 0 et 21 caractères.";
  }
  if(!$retour["donnees"]["descriptionTache"] = verifChampRempli("descriptionTache") ) {
    $retour["erreur"]["descriptionTache"] = "La longueur de votre descriptionTache doit être comprise entre 0 et 21 caractères.";
  }
  return $retour;
}


// Traitement des données du formulaire : uniquement si on rentre en POST
if($_SERVER["REQUEST_METHOD"] == "POST") {

  $formulaire = verifFormulaire();

  if(empty($formulaire["erreur"])) {
    updateMembre($db, $formulaire["donnees"]);
  }
  extract($formulaire["donnees"]);

} else {
  $tache = getDetailsTache($db, $_GET["id"]);
  extract($tache);

}
    
?>
<!--
  $sql = "UPDATE taches
  SET societe = :societe, client = :client, adresse = :adresse, duree = :duree, libelle = :libelle, secteur = :secteur, assignea = :assignea,
  etat = :etat, file = :file, descriptionTache = :descriptionTache
  WHERE id = :id";
-->


<body>
    
<?php 
   if(!empty($formulaire["erreur"])) {
      echo "<p class='erreur'>";
      foreach ($formulaire["erreur"] as $value) {
        echo $value.'<br />';
      }
      echo "</p>";
    }
?>

<h1 class="custom-h1">Modifier une tâche</h1>  
<div id="">
     <!-- Formulaire de connexion -->
    <form name="formulaireModifTache" action="" method="POST" id="formAjoutTache">

    <div class="row">
           <input type="text" name="societe" value="<?php if(isset($societe)) echo $societe; ?>" placeholder="Société" class="custom-input" /> <!-- pseudo -->
           <input type="text" name="client" value="<?php if(isset($client)) echo $client; ?>" placeholder="Nom client" class="custom-input" /> <!-- pseudo -->
           <input type="text" name="adresse" value="<?php if(isset($adresse)) echo $adresse; ?>" placeholder="Adresse client" class="custom-input" /> <!-- pseudo -->            
            
           <label for="duree">Durée :</label>
            <input value="<?php if(isset($duree)) echo $duree; ?>" type="time" name="duree" placeholder="Durée" class="custom-input"/> <!-- mdp -->
        </div>
            <p></p> 
        <div class="block">
            <input value="<?php if(isset($libelle)) echo $libelle; ?>" type="text" name="libelle" placeholder="Libelle du problème" class="custom-input"/> <!-- email -->        
            <select class="custom-select" name="secteur">
                <option selected disabled>-- Secteur -- </option>
                <option value="74">74 (Haute-savoie)</option>
                <option value="73">73 (Savoie)</option>
                <option value="38">38 (Isère)</option>
            </select>

            <select class="custom-select" name="assignea">
                <option selected disabled>-- Assigné à -- </option>
                <option value="Alexis">Alexis</option>
                <option value="Jean">Jean</option>
                <option value="Luc">Luc</option>
            </select>

            <select class="custom-select" name="etat">
                <option selected disabled>-- Etat / Statut -- </option>
                <option value="tachesEffectuee">Tâches à effectuée</option>
                <option value="tacheEnCours">Tâches en cours</option>
                <option value="tacheTerminee">Tâche terminée</option>
            </select>
        </div>
            <p></p>

        <div class="row ">
            <input value="<?php if(isset($file)) echo $file; ?>" type="file" name="file" id="file" class="inputfile top40px"/><!-- Photo -->
            
            <textarea placeholder="Votre message..." class="custom-textarea" name="descriptionTache" value="<?php if(isset($descriptionTache)) echo $descriptionTache; ?>"></textarea>
            <input type="submit" value="Modifier" class="btnAjoutTache"/>  <!-- btn inscription -->
        </div>
    </form>
</div>
    
    
    
</body>