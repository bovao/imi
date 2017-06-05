<?php include ('fonctions.php') ; 
$db = connect(); 
   
if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['motdepasse'])) {
    try {
        $membre = connecteUtilisateur($db, $_POST['login'], $_POST['motdepasse']);
        

        if ($membre["rang"] == "secretaire") {
            session_start();
            $_SESSION['login'] = $_POST['login'];
            header("location:../secretaire/taches.php");
            exit();
        }

        if ($membre["rang"] == "technicien") {
            session_start();
            $_SESSION['login'] = $_POST['login'];
            header("location:../technicien/taches.php");
            exit();
        }


    } catch (PDOException $erreur) {
      echo $erreur->getMessage();
    }
}
?>



<head>
	<title>Formulaire de connexion</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="HTML5 &amp; CSS3">
	<meta name="keywords" content="HTML5, CSS3, PHP">
	<link rel="stylesheet" type="text/css" href="../assets/css/formulaires.css"><!--custom css-->
</head>

<body>

<div id="enteteFormConnexion">
    <a href="../index.php"><i class="fa fa-home fa-3x icon-home"></i></a>
    <h2 class="h2-custom">Formulaire de connexion</h2>
</div>

    
<img src="../assets/img/fond-connexion.jpg" id="imgConnexion">

<div id="fondConnexion">
     <!-- Formulaire de connexion -->
    <form name="formulaireConnexion" action="" method="POST" id="formConnexion">
        <input type="text" name="login" placeholder="login" class="custom-input"/> <!-- pseudo -->
        
        <p class="top40"></p>
        <input type="password" name="motdepasse" placeholder="Mot de passe"  class="custom-input"/> <!-- mot de passe -->
        <p class="oubliePass">Mot de passe oublié ?</p>  <!-- mot de passe oublié -->
        
        <p class="top50"></p> <!-- espace entre information et btn action  -->
        
        <a href="inscription.php"><input type="button" value="Inscription" class="btnEnvoie btnInscription"/></a>  <!-- btn inscription -->
        <input type="submit" value="Connexion" class="btnEnvoie"/>  <!-- btn connexion -->
    </form>
</div>
    
        <script src="https://use.fontawesome.com/39cfcc7a15.js"></script>
    
</body>