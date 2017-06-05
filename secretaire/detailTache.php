<?php include('header.php'); ?>
    

<body>
    <!-- img de fond accueil -->
<?php include('menu.php'); ?>


<h1 class="custom-h1">Details tâche</h1>
    <form action="modifTache.php" method="post">
    <div class="filterMessagerie">
        <input type="button" name="pseudo" value="" class="importanceRed">
        <input type="button" name="pseudo" value="Société" class="custom-input3">
        <input type="button" name="pseudo" value="Client" class="custom-input3">
        <input type="button" name="pseudo" value="Durée" class="custom-input3">
        <input type="button" name="pseudo" value="Secteur" class="custom-input3">
        <input type="button" name="pseudo" value="Adresse" class="custom-input3">
        <input type="button" name="pseudo" value="Assigné à xxxxx" class="custom-input3">
    </div><div class="retourligne"></div>
    
    <textarea placeholder="Votre message..." class="custom-textarea2"></textarea>
    <img src="../assets/img/vitrecassé.jpeg" class="imgTache">
    
    <input type="submit" value="Modifier" class="btnReponseMessage"/>  <!-- btn inscription -->
    </form>
    
<script src="https://use.fontawesome.com/39cfcc7a15.js"></script>
</body>
    
