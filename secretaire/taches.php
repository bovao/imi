<?php include('header.php'); ?>
    

<body>
    <!-- img de fond accueil -->
<?php include('menu.php'); ?>

    
<div class="mainAccueil">
        <select id="SelectTypeTache">
            <option disabled selected value> -- Filtrer par Type -- </option>
            <option>Tâches crée</option>
            <option>Tâches en cours</option>
            <option>Tâche terminée</option>
        </select>

    <div class="Contentsearch">
        <span class="fa fa-search"></span>
        <input type="search" id="rechercher" placeholder="Rechercher une tâche">
    </div>    
</div>
    
    
<h1 class="custom-h1">Liste des tâches crée</h1>

<div class="ContentSecretaire">
    <!-- tache -->
    <div class="taches">
        <a href="detailTache.php"><!-- lien detail tache -->
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
    <hr>
        
    <ul id="mesActions">
        <li><i class="fa fa-pencil-square-o fa-2x"></i><a href="modifTache.php">Modifier</a></li>
        <li><i class="fa fa-trash-o fa-2x"></i><a href="">Supprimer</a></li>
    </ul>
        
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

        <hr>
        <ul id="mesActions">
        <li><i class="fa fa-pencil-square-o fa-2x"></i><a href="modifTache.php">Modifier</a></li>
            <li><i class="fa fa-trash-o fa-2x"></i><a href="">Supprimer</a></li>
        </ul>
    </div>
    
    <!-- new task -->
    <div class="taches">
        <div class="row">
            <p>Vendredi </p>
                <p class="left85">21 Avril 2017</p>  
        </div>
        
        <div class="row">
            <p><input type="button" name="pseudo" value="" class="importanceVert"><b> - </b> ID : 1 - Société - Nom client - Lieux</p>
            <p class="left80 top-10"><img src="../assets/icon/arrow-left.png" class="arrow-left"></p>
        </div>
        
        <p class="left70 top-20">Installation pilotes postes clients + Création d’un scan SMB</p>
        <div class="retourligne"></div>
        <hr>
        <ul id="mesActions">
        <li><i class="fa fa-pencil-square-o fa-2x"></i><a href="modifTache.php">Modifier</a></li>
            <li><i class="fa fa-trash-o fa-2x"></i><a href="">Supprimer</a></li>
        </ul>
    </div>
</div><!-- end ContentSecretaire -->
    

    
    
<script src="https://use.fontawesome.com/39cfcc7a15.js"></script>
</body>
    
