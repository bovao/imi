<?php include('header.php');
include('../includes/fonctions.php');
$db = connect();  
session_start();
?>



<body>

<div id="bloc_page">
    
<div class="row entete"> 
    <a href="../index.php" class="marginright2 white left a-custom"><i class="fa fa-search fa-2x"></i></a>
    <h1 class="h1-custom">Liste des tâches</h1>
    <a href="../index.php" class="marginright2 white right a-custom"><i class="fa fa-filter fa-2x"></i></a>
</div>
    
<p class="center custom-p">X tâches à effectuée</p>
    
<?php
    $taches = getTaches($db, $_SESSION['membre']['login']);

while($tache = $taches["donnees"]->fetch()) {
 if ($tache["assignea"] == $_SESSION['membre']['login']) { 
?>
     
<?php 
     $id = $tache["id"];
     $societe = $tache["societe"]; 
     $adresse = $tache["adresse"];
     
    ?>
    <div class="intervention">
        <a href="detailTache.php"> 
            <div class="row">
                <p class="fontweight100">Lundi 29 Mai 2017</p> 
                <img src="../assets/icon/arrow-left.png" class="arrow-left2">
                <p><input type="button" name="pseudo" value="" class="importanceRed"><b> - </b> <?= $id ?> :  - <?= $societe ?> - <?= $adresse?></p>
                <p><?= $tache["descriptionTache"] ?></p>
                
            </div>            
        </a>
        <div class="retourligne"></div>
    </div>
<?php
 }
}
?>                    
    
    
<?php include('menu.php'); ?>

    
</div>

<script src="https://use.fontawesome.com/39cfcc7a15.js"></script>
</body>
    
