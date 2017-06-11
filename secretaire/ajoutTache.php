<?php include('header.php');


include('menu.php');


require_once("../includes/fonctions.php");
$db = connect(); 

$page = listeNomUtilisateurs($db);

    
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //societe, client, adresse, duree, libelle, secteur, assignea, etat, file, descriptionTache
  $societe = verifLongueur("societe", 3);
  $client = verifLongueur("client", 3);
  $adresse = verifLongueur("adresse", 8);
  $duree = verifChampRempli("duree");
  $libelle = verifLongueur("libelle", 4);
  $secteur = verifChampRempli("secteur");
  $assignea = verifChampRempli("assignea");
  $etat = verifChampRempli("etat");
  $file = verifChampRempli("file");
  $descriptionTache = verifChampRempli("descriptionTache");

    
if(empty($erreur)) {
      $sql = "INSERT INTO taches VALUES (NULL, :societe, :client, :adresse, :duree, :libelle, :secteur, :assignea, :etat, :file, :descriptionTache, NOW())";
  try {
    $req = $db->prepare($sql);
        $req->bindParam(':societe', $societe, PDO::PARAM_STR);
        $req->bindParam(':client', $client, PDO::PARAM_STR);
        $req->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $req->bindParam(':duree', $duree, PDO::PARAM_STR);
        $req->bindParam(':libelle', $libelle, PDO::PARAM_STR);    
        $req->bindParam(':secteur', $secteur, PDO::PARAM_STR); 
        $req->bindParam(':assignea', $assignea, PDO::PARAM_STR);
        $req->bindParam(':etat', $etat, PDO::PARAM_STR);
        $req->bindParam(':file', $file, PDO::PARAM_STR);
        $req->bindParam(':descriptionTache', $descriptionTache, PDO::PARAM_STR);
      
        $req->execute();
        header("location:tache.php?create=ok");
        echo "<script>alert(\"Nouvelle tâche ajouté !\")</script>"; 
  } catch (PDOException $erreur) {
        echo $erreur->getMessage();
    }
  } else {}
}
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
    
<h1 class="custom-h1">Crée une tâche</h1>

<div id="">
     <!-- Formulaire de connexion -->
    <form name="formulaireAjoutTache" action="" method="POST" id="formAjoutTache">
        <div class="row">
           <input <?php if(isset($erreurs['societe'])) echo "class='erreur'"; ?>type="text" name="societe" value="<?php if(isset($societe)) echo $societe; ?>" placeholder="Société" class="custom-input" /> <!-- pseudo -->
           <input <?php if(isset($erreurs['client'])) echo "class='erreur'"; ?>type="text" name="client" value="<?php if(isset($client)) echo $client; ?>" placeholder="Nom client" class="custom-input" /> <!-- pseudo -->
           <input <?php if(isset($erreurs['adresse'])) echo "class='erreur'"; ?>type="text" name="adresse" value="<?php if(isset($adresse)) echo $adresse; ?>" placeholder="Lieux" class="custom-input" /> <!-- pseudo -->            
            
           <label for="duree">Durée :</label>
            <input <?php if(isset($erreurs['duree'])) echo "class='erreur'"; ?>value="<?php if(isset($duree)) echo $duree; ?>" type="time" name="duree" placeholder="Durée" class="custom-input"/> <!-- mdp -->
        </div>
            <p></p> 
        <div class="block">
            <input <?php if(isset($erreurs['libelle'])) echo "class='erreur'"; ?> value="<?php if(isset($libelle)) echo $libelle; ?>" type="text" name="libelle" placeholder="Libelle du problème" class="custom-input"/> <!-- email -->        
            <select class="custom-select" name="secteur">
                <option selected disabled>-- Secteur -- </option>
                <option value="74">74 (Haute-savoie)</option>
                <option value="73">73 (Savoie)</option>
                <option value="38">38 (Isère)</option>
            </select>

            <!-- renvoie select nom utilisateur inscrit (voir listeNomUtilisateurs()) -->
            <?php echo $page["corps"];?>

            
            <select class="custom-select" name="etat">
                <option selected disabled>-- Etat / Statut -- </option>
                <option value="tacheEnCours">Tâches en cours</option>
                <option value="tachesEffectuee">Tâches effectuée</option>
            </select>
        </div>
            <p></p>

        <div class="row ">

            
            <input <?php if(isset($erreurs['file'])) echo "class='erreur'"; ?> value="<?php if(isset($file)) echo $file; ?>" type="file" name="file" id="file" class="inputfile top40px"/><!-- Photo -->
            
            <textarea placeholder="Votre message..." class="custom-textarea" name="descriptionTache"></textarea>
            <input type="submit" value="Ajouter" class="btnAjoutTache"/>  <!-- btn inscription -->
        </div>
    </form><!-- fin form -->
</div>
    
    
    
</body>