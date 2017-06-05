<?php include('header.php'); ?>

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
        <form action="intervenir.php" method="POST">
         <fieldset><legend>Détails :</legend>
            <input type="text" name="pseudo" value="Société" class="custom-input" disabled/>
            <input type="text" name="pseudo" value="Client" class="custom-input" disabled/>
            <input type="text" name="pseudo" value="Durée" class="custom-input" disabled/>
            <input type="text" name="pseudo" value="Secteur" class="custom-input" disabled/>
            <input type="text" name="pseudo" value="Adresse" class="custom-input" disabled/>
            <input type="text" name="pseudo" value="Assigné à xxxxx" class="custom-input" disabled/>
             <p><b>Description :</b> lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum
                lorem ipsum lorem ipsum lorem ipsum.</p>
            <b>Photo :</b> <img src="../assets/img/fonctionnalite.png" width="100%" id="imgDetailTache">
            <input type="submit" value="Intervenir" class="btnIntervenir"/>  <!-- btn inscription -->
        </fieldset> 
        </form>
    </div>
</div>
        
</div>

<script src="https://use.fontawesome.com/39cfcc7a15.js"></script>
</body>
    
