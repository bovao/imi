<?php include('header.php'); ?>
    

<body>
<div class="row entete"> 
    <h1 class="h1-custom2">Ajout message</h1>
</div>
    
<div id="ajoutMessage">
    <form action="" method="POST">
    <fieldset><legend>Détails :</legend>
    <select id="" name="transporttype" class="custom-select">
            <option selected disabled>-- Etat / Statut -- </option>
            <option>Rouge</option>
            <option>Orange</option>
            <option>Vert</option>
        </select>
        
        <input type="text" name="pseudo" placeholder="Destinataire" class="custom-input">
        <input type="text" name="pseudo" placeholder="Objet" class="custom-input">
         <input type="file" name="pseudo" value="" class="custom-input">
    
    <textarea placeholder="Votre message..." class="custom-textarea"></textarea>
            <input type="submit" value="Nouveau message" class="btnIntervenir"/>  <!-- btn inscription -->
        </fieldset>
    </form>
</div>
<!-- img de fond accueil -->
<?php include('menu.php'); ?>

    
<script src="https://use.fontawesome.com/39cfcc7a15.js"></script>
</body>
    
