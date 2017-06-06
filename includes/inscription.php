<?php 
require("fonctions.php");
$db = connect(); 


// Déclaration d'un tableau qui va stocker les erreurs
$erreurs = array();

function verifChampRempli($champ) {
  global $erreurs;
  if(!empty($_POST[$champ])) {
    return htmlspecialchars($_POST[$champ]);
  } else {
    $erreurs[$champ] = "Merci de remplir le champ ".$champ;
    return NULL;
  }
}


function verifMail($champ) {
  global $erreurs;
  if($mail = verifChampRempli($champ)) {
    if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $erreurs[$champ] = "L'adresse email du champ ".$champ." n'est pas valide";
    }
    return $mail;
  }
}

function verifLongueur($champ, $longueur) {
  global $erreurs;
  if($message = verifChampRempli($champ)) {
    if(strlen($message) < $longueur) {
      $erreurs[$champ] = "Attention, le champ ".$champ." est trop court : minimum ".$longueur." caractères";
    }
    return $message;
  }
}


//function verifPassword($champ) {
//  global $erreurs;
//  if(!empty($_POST[$champ])) {
//    return sha1($_POST[$champ]);
//  } else {
//    $erreurs[$champ] = "Merci de remplir le champ ".$champ;
//    return NULL;
//  }
//}

//---------- A REVOIR -_-"
function verifPassword($champ, $champ2) {
  global $erreurs;
  if((!empty($_POST[$champ]) && !empty($_POST[$champ2]))){
        if($_POST[$champ] != $_POST[$champ2]){
         $erreurs[$champ] = 'Les 2 mots de passe sont différents.';
            return false;    
        }
      else{
        return sha1(htmlentities($_POST[$champ]));  
      }
    
  } else {
      $erreurs[$champ] = "Merci de remplir les deux champs mot de passe !";
  }
}
    
    
    
if($_SERVER["REQUEST_METHOD"] == "POST"){
  // En fonction de nos besoins, on va utiliser les différentes fonctions décrites au-dessus.
  $login = verifLongueur("login", 4);
  $mail = verifMail("mail");
  $password = verifPassword("password", "pass_confirm");
  $nom = verifLongueur("nom", 4);
  $secteur = verifChampRempli("secteur");
  $niveau = verifChampRempli("niveau");
  $rang = verifChampRempli("rang");

  // Je regarde si mon tableau d'erreurs est vide et si c'est le cas, j'envoie le mail
  if(empty($erreurs)) {
    // phase d'envoi du mail

    $destinataire = $mail;
    $sujetMail = "Nouveau message via le formulaire";
    $messageMail = "
    Nouveau message :\n
    Login : $login \n
    Mail : $mail \n
    Nom technicien : $nom \n
    Secteur : $secteur \n
    Niveau : $niveau \n
    Rang : $rang \n";
    $headers = "";

    if(mail($destinataire, $sujetMail, $messageMail, $headers)) {
      $erreurs["mail"] = "Le message a bien été envoyé !";
    } else {
      $erreurs["mail"] = "Le message n'a pas pu être envoyé !";
    }
  }

}
    
  // Si on n'a pas d'erreur, on peut passer à l'insertion de nos données.
  if(empty($erreur)) {      
        $sql = "INSERT INTO membre VALUES (NULL, :login, :mail, :password, :nom, :secteur, :niveau, :rang)";
    // 2 - Envoi de la requête avec la méthode try catch
    try {
      // On prépare la requête : elle est envoyée au serveur sans les données variables
      $req = $db->prepare($sql);
      // On lie la donnée récupérée en GET avec notre requête préparée, et on déclare qu'elle doit être un entier.
          $req->bindParam(':login', $login, PDO::PARAM_STR);
          $req->bindParam(':mail', $mail, PDO::PARAM_STR);
          $req->bindParam(':password', $password, PDO::PARAM_STR);
          $req->bindParam(':nom', $nom, PDO::PARAM_STR);
          $req->bindParam(':secteur', $secteur, PDO::PARAM_INT);
          $req->bindParam(':niveau', $niveau, PDO::PARAM_STR);
          $req->bindParam(':rang', $rang, PDO::PARAM_STR);
      // Exécution de la requête
      $req->execute();
      header("location:traitement.php?create=ok");
    } catch (PDOException $erreur) {
      echo $erreur->getMessage();
    }

  }

?>



<html>
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
    <h2 class="h2-custom">Formulaire d'inscription</h2>
</div>
    
<img src="../assets/img/fond-inscription.jpg" id="imgInscription">
    
<div id="fondInscription">
<div id="contact">
    <?php
    if(!empty($erreur)) {
      echo "<p class='erreur'>";
      foreach ($erreurs as $value) {
        echo $value.'<br />';
      }
      echo "</p>";
    }
    ?>
    
    <ul id="boutons">
        <li id="a0">Etape 1</li><li id="a1">Etape 2</li>
    </ul>
	
    <div id="contenu-contact">        
<form method="POST" id="formulaire" action="">
     
    	<div class="partie">
        	<h1>Partie 1 / Vos coordonnées</h1>
            <p>Renseigner vos informations afin d'être enregistrer.</p>
            
            <input <?php if(isset($erreurs['login'])) echo "class='erreur obligatoire'"; ?> type="text" name="login" value="<?php if(isset($login)) echo $login; ?>" placeholder="Votre login *"><br />
            
            <input <?php if(isset($erreurs['password'])) echo "class='erreur obligatoire'"; ?> type="password" name="password" value="<?php if(isset($password)) echo $password; ?>" placeholder="Votre mot de passe *"><br />

            <input <?php if(isset($erreurs['pass_confirm"'])) echo "class='erreur obligatoire'"; ?> type="password" name="pass_confirm" value="<?php if(isset($pass_confirm)) echo $pass_confirm; ?>" placeholder="Confirmation mdp *"><br />
                        
            <span class="suite envoyer">Valider / Etape suivante</span> 
        </div>
            
    
        <div class="partie">
        	<h2>Partie 2 / Vos informations</h2>
            <p>Renseigner vos informations afin d'être enregistrer.</p>
          
               <input <?php if(isset($erreurs['mail'])) echo "class='erreur obligatoire'"; ?> type="email" name="mail" value="<?php if(isset($mail)) echo $pass_confirm; ?>" placeholder="Votre email *"><br />
            
                <select class="custom-select" name="secteur">
                    <option selected disabled>-- Secteur -- </option>
                    <option value="74">74</option>
                    <option value="73">73</option>
                    <option value="38">38</option>
                </select>
            
                <select id="" class="custom-select" name="niveau">
                    <option selected disabled>-- Niveau -- </option>
                    <option value="expert">Expert</option>
                    <option value="intermédiaire">Intermédiaire</option>
                    <option value="novice">Novice</option>
                </select>
            
                        
                <select id="" class="custom-select" name="rang">
                    <option selected disabled>-- Rang -- </option>
                    <option value="technicien">Technicien</option>
                    <option value="secretaire">Secretaire</option>
                </select>
            
               <input <?php if(isset($erreurs['nom'])) echo "class='erreur obligatoire'"; ?> type="text" name="nom" value="<?php if(isset($nom)) echo $nom; ?>" placeholder="Votre nom  *"><br />

            <input type="submit" value="Créer votre compte" id="envoyer" class="envoyer" />
        </div>
        
</form> 
    </div>

    
</div>
 </div>
        <script src="../assets/js/jquery-3.1.1.min.js"></script>
        <script src="../assets/js/script.js"></script>
    
</body>