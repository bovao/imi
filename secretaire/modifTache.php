<?php include('header.php');

require_once("../includes/fonctions.php");
$db = connect(); 

include('menu.php');

?>
<!--
  $sql = "UPDATE taches
  SET societe = :societe, client = :client, adresse = :adresse, duree = :duree, libelle = :libelle, secteur = :secteur, assignea = :assignea,
  etat = :etat, file = :file, descriptionTache = :descriptionTache
  WHERE id = :id";
-->


<body>

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