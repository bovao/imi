<?php include('header.php');
include('../includes/fonctions.php');
$db = connect();  
session_start();
?>

<body>

<div id="bloc_page">
    
<div class="row entete"> 
    <a href="taches.php" class="marginleft2 white left a-custom"><i class="fa fa-arrow-left fa-2x icon-logout"></i></a>
    <h1 class="h1-custom2">Détail tâche</h1>
</div>
        
<div class="technicien">
    <p>Etat : <input type="button" name="pseudo" value="" class="importanceRed"></p>
</div>
    
<div class="row">
    <div class="col3">
        <form action="intervenir.php?id=<?= $_GET["id"]; ?>" method="POST">
         <fieldset><legend>Détails :</legend>
             
             
<?php
   $tache = getDetailsTache($db, $_GET["id"]);
   extract($tache);
?>
          
            <input type="text" name="societe" value="<?= $societe?>" class="custom-input" disabled/>
            <input type="text" name="client" value="<?= $client?>" class="custom-input" disabled/>
            <input type="text" name="adresse" value="<?= $duree?>" class="custom-input" disabled/>
            <input type="text" name="duree" value="<?= $secteur?>" class="custom-input" disabled/>
            <input type="text" name="secteur" value="<?= $adresse?>" class="custom-input" disabled/>
             <input type="date" name="date" value="<?= $date?>" class="custom-input" disabled/>
             <p><b>Description :</b> <?= $descriptionTache?></p>
            <b>Photo :</b> <img src="../assets/img/fonctionnalite.png" width="100%" id="imgDetailTache">
            <input type="submit" value="Intervenir" class="btnIntervenir"/>  <!-- btn inscription -->
        </fieldset> 
            
      
            
            
        </form>
    </div>
</div>
        
</div>

<script src="https://use.fontawesome.com/39cfcc7a15.js"></script>
</body>
    
