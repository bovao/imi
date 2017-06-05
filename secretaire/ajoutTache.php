<?php include('header.php');


include('menu.php'); ?>


<body>

<h1 class="custom-h1">Crée une tâche</h1>

<div id="">
     <!-- Formulaire de connexion -->
    <form name="formulaireAjoutTache" action="" method="POST" id="formAjoutTache">
        <div class="row">
            <input type="text" name="societe" value="" placeholder="Société" class="custom-input"/> <!-- pseudo -->
            <input type="text" name="client" placeholder="Client" class="custom-input"/> <!-- pseudo -->
            <input type="time" name="duree" placeholder="Durée" class="custom-input"/> <!-- mdp -->
            <input type="text" name="adresse" placeholder="Adresse" class="custom-input"/> <!-- confirm pass -->
        </div>
            <p></p>

        <div class="block">
            <input type="text" name="pseudo" placeholder="Email" class="custom-input"/> <!-- email -->        
            <select id="" class="custom-select">
                <option selected disabled>-- Secteur -- </option>
                <option>74 (Haute-savoie)</option>
                <option>73 (Savoie)</option>
                <option>38 (Isère)</option>
            </select>

            <select id="" class="custom-select">
                <option selected disabled>-- Assigné à -- </option>
                <option>Alexis</option>
                <option>Jean</option>
                <option>Luc</option>
            </select>

            <select id="" name="transporttype" class="custom-select">
                <option selected disabled>-- Etat / Statut -- </option>
                <option>Tâches à effectuée</option>
                <option>Tâches en cours</option>
                <option>Tâche terminée</option>
            </select>
        </div>
            <p></p>

        <div class="row ">
            <input type="file" name="file" id="file" class="inputfile top40px "  /><!-- Photo -->
            <textarea placeholder="Votre message..." class="custom-textarea"></textarea>
            <input type="submit" value="Ajouter" class="btnAjoutTache"/>  <!-- btn inscription -->
        </div>
    </form><!-- fin form -->
</div>
    
    
    
</body>