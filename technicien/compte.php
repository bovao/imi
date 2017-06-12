<?php include('header.php'); 

require_once("../includes/fonctions.php");
$db = connect(); 
session_start();

//$test = $_SESSION['login'];
//$_SERVER["PHP_AUTH_USER"];
?>

<body>

<div id="bloc_page">
    
<div class="row entete"> 
    <a href="../index.php" class="marginleft2 white left a-custom"><i class="fa fa-sign-out fa-2x icon-logout"></i></a>
    <h1 class="h1-custom">Mon espace personnel</h1>
    <a href="" class="marginright2 white right a-custom"><i class="fa fa-edit fa-2x"></i></a>
</div>
    
<?php 
    
$membre = getUsers($db, $_SESSION['membre']['login']);
extract($membre);
?>

    
<!-- formulaire de modification -->
    <input type="hidden" name="id" value="<?php echo intval($_GET["id"]); ?>">

         <div class="technicien">
        <p>Technicien : <?= $nom; ?></p>
    </div>

    <div class="row">
        <div class="col3">
            <img src="../assets/img/698.jpg" id="imgPerso">
               <input type="text" name="login" value="<?= $login; ?>" placeholder="Login" class="custom-input" disabled/> <!-- pseudo -->

            <input type="password" name="password" value="<?= $password; ?>" placeholder="password" class="custom-input" disabled/> <!-- pseudo -->
             <input type="text" name="mail" value="<?= $mail; ?>" placeholder="Adresse email" class="custom-input" disabled/>
             <input type="text" name="nom" value="<?= $nom; ?>" placeholder="Nom" class="custom-input" disabled/>
        </div>
    </div>
  
<!--     <input type="submit" class="center" id="btnModifCompte" value="Sauvegarder modification">   -->
  
    
    
    
<!-- Affichage des dernière interventions terminée -->
<div class="lastIntervention white">
    <h1>Dernière intervention</h1>
</div>
    
<?php
    $taches = getTaches($db, $_SESSION['membre']['login']);

while($tache = $taches["donnees"]->fetch()) {
 if ($tache["assignea"] == $_SESSION['membre']['login'] && $tache["etat"] == "tachesEffectuee") { 
     
     $id = $tache["id"];
     $societe = $tache["societe"]; 
     $adresse = $tache["adresse"];
     $etat = $tache["etat"];//si tacheeffectue pas de tache à afficher si non affiche
     
    ?>
        
<input type="search" name="Recherche" placeholder="Rechercher" class="custom-input"/> <!-- pseudo -->
    
    <div class="intervention">
        <a href="detailIntervention.php"> 
            <div class="row">
                <p class="fontweight100">Vendredi 21 Avril 2017</p> 
                <img src="../assets/icon/arrow-left.png" class="arrow-left">
                <p><input type="button" name="pseudo" value="" class="importanceRed"><b> - </b> <?= $id ?> :  - <?= $societe ?> - <?= $adresse?></p>
                
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
    
