<?php include('header.php'); 

require_once("../includes/fonctions.php");
$db = connect(); 

//$test = $_SESSION['login'];
//$_SERVER["PHP_AUTH_USER"];


function detailUtilisateur($db, $id) {
  $contenu = array();
  $contenu["corps"] = "";

  $donnees = getUtilisateurs($db);

  if($donnees["statut"] == "ok") {
      
    while($membre = $donnees["donnees"]->fetch()) {
        
    $id = $membre["id"];
    $login = $membre["login"];
    $password = $membre["password"];
    $mail = $membre["mail"];
    $secteur = $membre["secteur"];
    $nom = $membre["nom"];
    }
      
    $contenu["corps"].="
      <div class='technicien'>
        <p>Technicien : $nom </p>
    </div>

    <div class='row'>
        <div class='col3'>
            <img src='../assets/img/698.jpg' id='imgPerso'>
               <input type='text' name='login' value='$login' placeholder='Login' class='custom-input' /> <!-- pseudo -->

            <input type='password' name='password' value='$password' placeholder='password' class='custom-input' /> <!-- pseudo -->
             <input type='text' name='mail' value='$mail' placeholder='Adresse email' class='custom-input' />
        </div>

        <div class='col3'>
           <select class='custom-select blockCenter' name='secteur'>
            <option selected disabled>-- Secteur -- </option>
            <option value='$secteur'>74</option>
            <option value='$secteur'>73</option>
            <option value='$secteur'>38</option>
        </select>
        </div>
    </div>
    ";
        
  
  } else {
    $contenu["corps"].="<p class='erreur'>".$donnees["donnees"]."</p>";
  }

  return $contenu;
}

$page = detailUtilisateur($db, $_GET["id"]);




// Traitement des données du formulaire : uniquement si on rentre en POST
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET["id"];
    // En fonction de nos besoins, on va utiliser les différentes fonctions décrites au-dessus.
      $login = verifLongueur("login", 4);
      $password = verifPassword2("password");
      $mail = verifMail("mail");
      $secteur = verifChampRempli("secteur");

    // Si on n'a pas d'erreur, on peut passer à la mise à jour de nos données.
    if(empty($erreur)) {
        $sql = "UPDATE membre
        SET login = :login, password = :password, mail = :mail, secteur = :secteur WHERE id = :id";
      try {
        $req = $db->prepare($sql);
            $req->bindParam(':id', $id, PDO::PARAM_INT);
            $req->bindParam(':login', $login, PDO::PARAM_STR);
            $req->bindParam(':mail', $mail, PDO::PARAM_STR);
            $req->bindParam(':password', $password, PDO::PARAM_STR);
            $req->bindParam(':secteur', $secteur, PDO::PARAM_INT);
            $req->execute();
            header("location:compte.php?modif=ok");
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


<body>

<div id="bloc_page">
    
<div class="row entete"> 
    <a href="../index.php" class="marginleft2 white left a-custom"><i class="fa fa-sign-out fa-2x icon-logout"></i></a>
    <h1 class="h1-custom">Mon espace personnel</h1>
    <a href="" class="marginright2 white right a-custom"><i class="fa fa-edit fa-2x"></i></a>
</div>
    
<!-- formulaire de modification -->
<form name="formulaireModifTache" action="" method="POST" id="formAjoutTache">
    <input type="hidden" name="id" value="<?php echo intval($_GET["id"]); ?>">

    <?php echo $page["corps"]; ?>
  
     <input type="submit" class="center" id="btnModifCompte" value="Sauvegarder modification">   

</form>
    
<div class="lastIntervention white">
    <h1>Dernière intervention</h1>
</div>
    
<input type="search" name="Recherche" placeholder="Rechercher" class="custom-input"/> <!-- pseudo -->
    
    <div class="intervention">
        <a href="detailIntervention.php"> 
            <div class="row">
                <p class="fontweight100">Vendredi 21 Avril 2017</p> 
                <img src="../assets/icon/arrow-left.png" class="arrow-left">
                <p><input type="button" name="pseudo" value="" class="importanceRed"><b> - </b> ID : 1 - Société - Lieux</p>
                
            </div>            
        </a>
        <div class="retourligne"></div>
    </div>
    <div class="intervention">
        <a href="intervenir.php"> 
            <div class="row">
                <p class="fontweight100">Vendredi 21 Avril 2017</p>  
                 <img src="../assets/icon/arrow-left.png" class="arrow-left">
                <p><input type="button" name="pseudo" value="" class="importanceVert"><b> - </b> ID : 1 - Société - Lieux</p>
               
            </div>            
        </a>
        <div class="retourligne"></div>
    </div>
   
    
<?php include('menu.php'); ?>


    
</div>

<script src="https://use.fontawesome.com/39cfcc7a15.js"></script>
</body>
    
