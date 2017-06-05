<?php include('header.php'); ?>

<body>

<div id="bloc_page">
    
<div class="row entete"> 
    <a href="detailTache.php" class="marginleft2 white left a-custom"><i class="fa fa-arrow-left fa-2x icon-logout"></i></a>
    <h1 class="h1-custom2">Intervention 1</h1>
</div>
    
<div class="technicien">
    <p>Date : <input type="date" name="date" value=""></p>
</div>
    
<div class="row">
    <div class="col3">
        <form action="traitement-intevention.php" method="POST">
         <fieldset><legend>Détails :</legend>
            <input type="text" name="pseudo" placeholder="Nb copie N&B" class="custom-input" />
            <input type="text" name="pseudo" placeholder="Nb copie couleur" class="custom-input" />
             <b>Arrivé</b>
            <input type="time" name="pseudo" value="08:56" class="custom-input" />
            
             <b>Départ</b><input type="time" name="pseudo" value="09:32" class="custom-input" />
            <input type="text" name="pseudo" placeholder="Prendre photo" class="custom-input" />
            <input type="text" name="pseudo" placeholder="Cherche photo" class="custom-input" />

            <textarea placeholder="Votre message..." class="custom-textarea"></textarea>
            <select id="" name="transporttype" class="custom-select">
                <option selected disabled>-- Etat / Statut -- </option>
                <option>Tâches en cours</option>
                <option>Tâche terminée</option>
            </select>
    
            <input type="submit" value="Valider" class="btnIntervenir"/>  <!-- btn inscription -->
        </fieldset> 
        </form>
    </div>
</div>
        
</div>

<script src="https://use.fontawesome.com/39cfcc7a15.js"></script>
</body>
    
