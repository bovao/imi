<?php include('header.php');
include('menu.php');

require_once("../includes/fonctions.php");
$db = connect(); 

// Traitement des données du formulaire : uniquement si on rentre en POST
if($_SERVER["REQUEST_METHOD"] == "POST") {//id,login,mail,nom,secteur,niveau,rang
  $id = $_GET["id"];
  $login = verifLongueur("login", 4);
  $mail = verifMail("mail");
  $password = verifPassword2("password");
  $nom = verifLongueur("nom", 4);
  $secteur = verifChampRempli("secteur");
  $rang = verifChampRempli("rang");
    
    // Si on n'a pas d'erreur, on peut passer à la mise à jour de nos données.
    if(empty($erreur)) {
        $sql = "UPDATE membre
        SET login = :login, mail = :mail, password = :password, nom = :nom, secteur = :secteur, rang = :rang WHERE id = :id";
      try {
        $req = $db->prepare($sql);
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->bindParam(':login', $login, PDO::PARAM_STR);
            $req->bindParam(':mail',  $mail, PDO::PARAM_STR);
            $req->bindParam(':password', $password, PDO::PARAM_STR);
            $req->bindParam(':nom', $nom, PDO::PARAM_STR);
            $req->bindParam(':secteur', $secteur, PDO::PARAM_STR);  
            $req->bindParam(':rang', $rang, PDO::PARAM_STR); 
            $req->execute();
            header("location:gestionUtilisateur.php?modif=ok");
            echo "<script>alert(\"Nouvelle modification effectué !\")</script>"; 
        }  catch (PDOException $erreur) {
                echo $erreur->getMessage();
            }
    }

} else {
  $membre = getDetailsUtilisateur($db, $_GET["id"]);
  extract($membre);
}
    

?>

<body>

<?php
if(!empty($erreur)) {
    echo "<p class='erreur'>";
    foreach ($erreurs as $value) {
        echo $value.'<br />';
    }
    echo "</p>";
}
?>
    
<h1 class="custom-h1">Modifier Utilisateurs</h1>
    
<div id="">
     <!-- Formulaire de connexion -->
    <form name="formulaireModifMembre" action="" method="POST" id="formAjoutTache">
        <div class="row">   
            <input type="hidden" name="id" value="<?php echo intval($_GET["id"]); ?>">
            
            <input type="text" name="login" value="<?php if(isset($login)) 
            echo $login; ?>" placeholder="Login" class="custom-input" /> <!-- pseudo -->

            <input type="text" name="mail" value="<?php if(isset($mail)) echo $mail; ?>" placeholder="Adresse email" class="custom-input" /> <!-- pseudo -->       

            <input type="password" name="password" value="<?php if(isset($password)) echo $password; ?>" placeholder="password" class="custom-input" /> <!-- pseudo -->
   
                                    
            <input <?php if(isset($erreurs['file'])) echo "class='erreur'"; ?> value="<?php if(isset($file)) echo $file; ?>" type="file" name="file" id="file" class="inputfile top40px"/><!-- Photo -->
        </div>
            <p></p> 
        <div class="block">
                <select class="custom-select" name="secteur">
                    <option selected disabled>-- Secteur -- </option>
                    <option value="74">74</option>
                    <option value="73">73</option>
                    <option value="38">38</option>
                </select>
            
                    <select class="custom-select" name="rang">
                    <option selected disabled>-- Rang -- </option>
                    <option value="technicien">technicien</option>
                    <option value="secretaire">secretaire</option>
                </select>
                                             
            <input <?php if(isset($erreurs['nom'])) echo "class='erreur'"; ?>type="text" name="nom" value="<?php if(isset($nom)) echo $nom; ?>" placeholder="Votre nom" class="custom-input" /> <!-- pseudo --> 
        </div>
        
            <p></p>
        
            <input type="submit" value="Modifier" class="btnAjoutTache"/>  <!-- btn inscription -->
    </form><!-- fin form -->
</div>
    
    
    
</body>