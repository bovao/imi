<?php include('header.php'); ?>

<body>

<div id="bloc_page">
    
<div class="row entete"> 
    <a href="../index.php" class="marginleft2 white left a-custom"><i class="fa fa-sign-out fa-2x icon-logout"></i></a>
    <h1 class="h1-custom">Mon espace personnel</h1>
    <a href="../includes/deconnexion.php" class="marginright2 white right a-custom"><i class="fa fa-edit fa-2x icon-logout"></i></a>
</div>
    
<div class="technicien">
    <p>Technicien : Grimonprez Alexis</p>
</div>
    
<div class="row">
    <div class="col3">
        <img src="../assets/img/698.jpg" id="imgPerso">
      <input type="text" name="pseudo" placeholder="Pseudo" class="custom-input"/> <!-- pseudo -->
      <input type="password" name="password" placeholder="Mot de passe" class="custom-input"/> <!-- pseudo -->
      <input type="text" name="emal" placeholder="Email" class="custom-input"/> <!-- pseudo -->
    </div>
    
    <div class="col3">
      <input type="text" name="pseudo" placeholder="Secteur" class="custom-input"/> <!-- pseudo -->
      <input type="text" name="pseudo" placeholder="Téléphnone" class="custom-input"/> <!-- pseudo -->
    </div>
    
</div>
    
<div class="lastIntervention white">
    <h1>Dernière intervention</h1>
</div>
    
<input type="search" name="Recherche" placeholder="Rechercher" class="custom-input"/> <!-- pseudo -->
    
    <div class="intervention">
        <a href="detailIntervention.php"> 
            <div class="row">
                <p class="fontweight100">Vendredi 21 Avril 2017</p> 
                <img src="../assets/icon/arrow-left.png" class="arrow-left">
                <p><input type="button" name="pseudo" value="" class="importanceRed"><b> - </b> ID : 1 - Société - Lieux</p>
                
            </div>            
        </a>
        <div class="retourligne"></div>
    </div>
    <div class="intervention">
        <a href="intervenir.php"> 
            <div class="row">
                <p class="fontweight100">Vendredi 21 Avril 2017</p>  
                 <img src="../assets/icon/arrow-left.png" class="arrow-left">
                <p><input type="button" name="pseudo" value="" class="importanceVert"><b> - </b> ID : 1 - Société - Lieux</p>
               
            </div>            
        </a>
        <div class="retourligne"></div>
    </div>
   
    
<?php include('menu.php'); ?>


    
</div>

<script src="https://use.fontawesome.com/39cfcc7a15.js"></script>
</body>
    
