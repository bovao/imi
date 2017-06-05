<?php include('header.php');


include('menu.php'); ?>


<body>

<h1 class="custom-h1">Modifier une tâche</h1>

<div id="">
     <!-- Formulaire de connexion -->
    <form name="formulaireAjoutTache" action="" method="POST" id="formAjoutTache">
        
    <div class="row">
        <input type="text" name="pseudo" placeholder="Pseudo" class="custom-input"/> <!-- pseudo -->
        <input type="text" name="pseudo" placeholder="Pseudo" class="custom-input"/> <!-- pseudo -->
        <input type="password" name="pseudo" placeholder="Mot de passe" class="custom-input"/> <!-- mdp -->
        <input type="password" name="pseudo" placeholder="Confirme mot de passe" class="custom-input"/> <!-- confirm pass -->
    </div>
        <p></p>
     
    <div class="block">
        <input type="text" name="pseudo" placeholder="Email" class="custom-input"/> <!-- email -->
            <select id="" name="transporttype" class="custom-select">
            <option selected disabled>-- Etat / Statut -- </option>
            <option>Tâches crée</option>
            <option>Tâches en cours</option>
            <option>Tâche terminée</option>
        </select>
        
        <select id="" class="custom-select">
            <option selected disabled>-- Assigné à -- </option>
            <option>Tâches crée</option>
            <option>Tâches en cours</option>
            <option>Tâche terminée</option>
        </select>
        
            <select id="" class="custom-select">
            <option selected disabled>-- Secteur -- </option>
            <option>Tâches crée</option>
            <option>Tâches en cours</option>
            <option>Tâche terminée</option>
        </select>
    </div>
        <p></p> <!-- espace entre information et btn action  -->
    
    <div class="row ">
    <input type="file" name="file" id="file" class="inputfile top40px "  /><!-- Photo -->
  
    <textarea placeholder="Votre message..." class="custom-textarea"></textarea>

        <input type="submit" value="Modifier" class="btnAjoutTache"/>  <!-- btn inscription -->
    </div>
    </form>
</div>
    
    
    
</body>