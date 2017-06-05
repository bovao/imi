
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Résultat formulaire</title>
  </head>
  <body>
    <h1>Bienvenue <?php echo htmlspecialchars($_POST["nom"]); ?><br/>Vous êtes désormais inscrit sur la plateforme IMI ! </h1>
      <p><b>Voici vos identifiant de connexion, il vous ont également été envoyé à l'adresse 
          <?php echo htmlspecialchars($_POST["mail"]); ?><br/></b></p>
      
    
    <?php echo 'login :'.htmlspecialchars($_POST["login"]); ?><br/>
    <?php echo 'password :'.htmlspecialchars($_POST["password"]); ?><br/>
      
    <?php echo 'Nom  :'.htmlspecialchars($_POST["nom"]); ?><br/>
    <?php echo 'Email :'.htmlspecialchars($_POST["mail"]); ?><br/>
      
    <?php echo 'secteur :'.htmlspecialchars($_POST["secteur"]); ?><br/>
    <?php echo 'niveau :'.htmlspecialchars($_POST["niveau"]); ?><br/>
            
  </body>
</html>



<?php     
    if(empty($erreur)) {
        // Code de récupération de notre liste d'utilisateurs
        // 1 - écriture de la requête SQL INSERT.
        $sql = "INSERT INTO membre VALUES (NULL, :login, :mail, :password, :nom, :secteur, :niveau)";
        // 2 - Envoi de la requête avec la méthode try catch
        try {
          // On prépare la requête : elle est envoyée au serveur sans les données variables
          $req = $db->prepare($sql);
          // On lie la donnée récupérée en GET avec notre requête préparée, et on déclare qu'elle doit être un entier.
          $req->bindParam(':login', $prenom, PDO::PARAM_STR);
          $req->bindParam(':mail', $mail, PDO::PARAM_STR);
          $req->bindParam(':password', $password, PDO::PARAM_STR);
          $req->bindParam(':nom', $nom, PDO::PARAM_STR);
          $req->bindParam(':secteur', secteur, PDO::PARAM_INT);
          $req->bindParam(':niveau', niveau, PDO::PARAM_STR);
            
        // Exécution de la requête
          $req->execute();
          header("location:traitement.php?create=ok");
        } catch (PDOException $erreur) {
          echo $erreur->getMessage();
        }
    }


?>


