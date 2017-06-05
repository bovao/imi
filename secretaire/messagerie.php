<?php include('header.php'); ?>
    

<body>
    <!-- img de fond accueil -->
<?php include('menu.php'); ?>

    
<div class="mainAccueil">
        <select id="SelectTypeTache">
            <option disabled selected value> -- Filtrer par date -- </option>
            <option>Le plus récent</option>
            <option>Le moins récent</option>
        </select>

    <div class="Contentsearch">
        <span class="fa fa-search"></span>
        <input type="search" id="rechercher" placeholder="Rechercher un message">
    </div>    
</div>
    
    
<h1 class="custom-h1">Messagerie</h1>
    
    <div class="filterMessagerie">
        <a href="ajoutMessage.php"><input type="button" name="pseudo" value="Nouveau message" class="custom-input"></a>
        <a href="lien"><input type="button" name="pseudo" value="Boite de réception" class="custom-input"></a>
        <a href="lien"><input type="button" name="pseudo" value="Message envoyé" class="custom-input"></a>
        <a href="lien"><input type="button" name="pseudo" value="Message supprimé" class="custom-input"></a>
    </div><div class="retourligne"></div>
    
    
    <div class="top40px center">
        <span class="fa fa-envelope center"> 5 nouveaux messages</span> 
    </div>

<div class="ContentSecretaire">
    <!-- new task -->
    <div class="taches">
        <a href="detailMessage.php"><!-- lien detail tache -->
            <div class="row">
                <p>Vendredi </p>
                    <p class="left85">21 Avril 2017</p>  
            </div>

            <div class="row">
                <p><input type="button" name="pseudo" value="" class="importanceRed"><b> - </b> ID : 1 - Société - Nom client - Lieux</p>
                <p class="left80 top-10"><img src="../assets/icon/arrow-left.png" class="arrow-left"></p>
            </div>

            <p class="left70 top-20">Installation pilotes postes clients + Création d’un scan SMB</p>
        </a>
        <div class="retourligne"></div>
    </div>
    
    <!-- new task -->
    <div class="taches">
        <div class="row">
            <p>Vendredi </p>
                <p class="left85">21 Avril 2017</p>  
        </div>
        
        <div class="row">
            <p><input type="button" name="pseudo" value="" class="importanceRed"><b> - </b> ID : 1 - Société - Nom client - Lieux</p>
            <p class="left80 top-10"><img src="../assets/icon/arrow-left.png" class="arrow-left"></p>
        </div>
        
        <p class="left70 top-20">Installation pilotes postes clients + Création d’un scan SMB</p>
        <div class="retourligne"></div>
    </div>
    
    <!-- new task -->
    <div class="taches">
        <div class="row">
            <p>Vendredi </p>
                <p class="left85">21 Avril 2017</p>  
        </div>
        
        <div class="row">
            <p><input type="button" name="pseudo" value="" class="importanceRed"><b> - </b> ID : 1 - Société - Nom client - Lieux</p>
            <p class="left80 top-10"><img src="../assets/icon/arrow-left.png" class="arrow-left"></p>
        </div>
        
        <p class="left70 top-20">Installation pilotes postes clients + Création d’un scan SMB</p>
        <div class="retourligne"></div>
    </div>
</div><!-- end ContentSecretaire -->
    

    
    
<script src="https://use.fontawesome.com/39cfcc7a15.js"></script>
</body>
    
