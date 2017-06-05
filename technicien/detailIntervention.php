<?php include('header.php'); ?>

<body>

<div id="bloc_page">
    
<div class="row entete"> 
    <a href="compte.php" class="marginleft2 white left a-custom"><i class="fa fa-arrow-left fa-2x"></i></a>
    <h1 class="h1-custom2">Détail intervention 1</h1>
</div>
    
<div class="row">
    <div class="col3">
        <form action="intervenir.php" method="POST">
            <fieldset><legend>Détails :</legend>
            <input type="text" name="pseudo" value="1200 copie N&B" class="custom-input" disabled/>
            <input type="text" name="pseudo" value="600 copie couleur" class="custom-input" disabled/>
             <b>Arrivé</b>
            <input type="time" name="pseudo" value="08:56" class="custom-input" disabled/>
            
             <b>Départ</b><input type="time" name="pseudo" value="09:32" class="custom-input" disabled/>

            <hr>
            <p class="custom-textarea">
                Livraison C750, + formation client, création de scan SMB et ajout d'un raccourci sur postes clients
                </p>
            <hr>
            <select id="" name="transporttype" class="custom-select" disabled>
                <option>-- Etat / Statut -- </option>
                <option >Tâches en cours</option>
                <option selected>Tâche terminée</option>
            </select>
        </fieldset> 
        </form>
    </div>
</div>
        
</div>

<script src="https://use.fontawesome.com/39cfcc7a15.js"></script>
</body>
    
