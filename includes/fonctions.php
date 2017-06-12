<?php

function connect() {
  // Déclaration des variables de connexion à la BDD
  $user = "root";
  $pass = "root";
  try {
    $db = new PDO('mysql:host=localhost;dbname=imi_db;charset=UTF8', $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
  } catch (PDOException $erreur) {
    die("Problème : ".$erreur->getMessage());
  }
}



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

function verifLongueur($champ, $longueur) {
  global $erreurs;
  if($message = verifChampRempli($champ)) {
    if(strlen($message) < $longueur) {
      $erreurs[$champ] = "Attention, le champ ".$champ." est trop court : minimum ".$longueur." caractères";
    }
    return $message;
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

function verifPassword2($champ){
  global $erreurs;
  if(!empty($_POST[$champ])) {
     return sha1(htmlentities($_POST[$champ]));  
  } else {
    $erreurs[$champ] = "Merci de remplir le champ ".$champ;
    return NULL;
  }
}

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

function connecteUtilisateur($db, $login, $password) {
  // On récupère les données de l'utilisateur passé en GET.
  // Requête SQL SELECT avec utilisation des alias pour renommer les noms des colonnes afin de simplifier la manipulation des données dans la page.
  $sql = "SELECT id, login, password, mail, nom, secteur, rang
  FROM membre WHERE login = :login and password = :password";
  // 2 - Envoi de la requête avec la méthode try catch
  try {
    // On prépare la requête : elle est envoyée au serveur sans les données variables
    $req = $db->prepare($sql);
    // On lie la donnée récupérée en GET avec notre requête préparée, et on déclare qu'elle doit être un entier.
    $req->bindParam(':login', $login, PDO::PARAM_STR);
    $req->bindParam(':password', sha1($password), PDO::PARAM_STR);
    // Exécution de la requête
    $req->execute();
    // Je récupère l'ensemble des données retournées par la requête grâce à fetchAll
    $membre = $req->fetchAll()[0];
      
    // j'assigne ces données à mes variables utilisées dans mon formulaire
    return $membre;

  } catch (PDOException $erreur) {
    echo $erreur->getMessage();
  }
}



function getUtilisateurs($db) {
  // Code de récupération de notre liste d'utilisateurs
  // 1 - écriture de la requête SQL SELECT.
  $sql = "SELECT id, login, mail, password, nom, secteur, rang FROM membre";
  // 2 - Envoi de la requête avec la méthode try catch
  try {
    $retour["donnees"] = $db->query($sql);
    $retour["statut"] = "ok";
  } catch (PDOException $erreur) {
    $retour["donnees"] = $erreur->getMessage();
    $retour["statut"] = "erreur";
  }
  return $retour;
}




function getDetailsUtilisateur($db, $id) {
  // On récupère les données de l'utilisateur passé en GET.
  // Requête SQL SELECT avec utilisation des alias pour renommer les noms des colonnes afin de simplifier la manipulation des données dans la page.
  $sql = "SELECT * FROM membre WHERE id = :id";
  // 2 - Envoi de la requête avec la méthode try catch
  try {
    // On prépare la requête : elle est envoyée au serveur sans les données variables
    $req = $db->prepare($sql);
    // On lie la donnée récupérée en GET avec notre requête préparée, et on déclare qu'elle doit être un entier.
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    // Exécution de la requête
    $req->execute();
    // Je récupère l'ensemble des données retournées par la requête grâce à fetchAll
    $membre = $req->fetchAll()[0];
    // j'assigne ces données à mes variables utilisées dans mon formulaire
    return $membre;

  } catch (PDOException $erreur) {
    echo $erreur->getMessage();
  }
}



function listeUtilisateurs($db) {
  $contenu = array();
  $contenu["titre"] = "Liste des utilisateurs du site.";
  $contenu["corps"] = "";

  $donnees = getUtilisateurs($db);

  if($donnees["statut"] == "ok") {
    $contenu["corps"] .= "<table style='margin:0 auto;'>
      <tr>
          <th>id</th>
          <th>login</th>
          <th>mail</th>
            <th>password</th>
            <th>nom</th>
            <th>secteur</th>
            <th>Rang</th>
      </tr>";
    while($membre = $donnees["donnees"]->fetch()) {

        $nom = $membre["nom"];
      // var_dump($utilisateur);
      $contenu["corps"].= "<tr>";
      $contenu["corps"].= "<td>".$membre["id"]."</td>";
      $contenu["corps"].= "<td>".$membre["login"]."</td>";
      $contenu["corps"].= "<td>".$membre["mail"]."</td>";   
      $contenu["corps"].= "<td>".$membre["password"]."</td>";  
      $contenu["corps"].= "<td>".$membre["nom"]."</td>";
      $contenu["corps"].= "<td>".$membre["secteur"]."</td>";
      $contenu["corps"].= "<td>".$membre["rang"]."</td>";
        
      $contenu["corps"].= "<td>
        <a href='deleteUtilisateur.php?id=".$membre["id"]."'>supprimer</a><br />
        <a href='updateUtilisateur.php?id=".$membre["id"]."'>détails</a><br />
      </td>";
      $contenu["corps"].= "</tr>";
    }
    $contenu["corps"].="</table>";
  } 
    
    else {
    $contenu["corps"].="<p class='erreur'>".$donnees["donnees"]."</p>";
  }

  return $contenu;
}


function listeNomUtilisateurs($db) {
  $contenu = array();
  $contenu["corps"] = "";

  $donnees = getUtilisateurs($db);

  if($donnees["statut"] == "ok") {
      $contenu["corps"].= "<select class='custom-select' name='assignea'>";
    while($membre = $donnees["donnees"]->fetch()) {  
      $contenu["corps"].= "<option value=".$membre["login"].">".$membre["login"]."</option>
     ";
    }
    $contenu["corps"].= "</select>";
  } 
    else {
    $contenu["corps"].="<p class='erreur'>".$donnees["donnees"]."</p>";
  }
  return $contenu;
}



function getDetailsTache($db, $id) {
  $sql = "SELECT * FROM taches WHERE id = :id";
  // 2 - Envoi de la requête avec la méthode try catch
  try {
    // On prépare la requête : elle est envoyée au serveur sans les données variables
    $req = $db->prepare($sql);
    // On lie la donnée récupérée en GET avec notre requête préparée, et on déclare qu'elle doit être un entier.
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    // Exécution de la requête
    $req->execute();
    // Je récupère l'ensemble des données retournées par la requête grâce à fetchAll
    $detailTache = $req->fetchAll()[0];
    // j'assigne ces données à mes variables utilisées dans mon formulaire
    return $detailTache;

  } catch (PDOException $erreur) {
    echo $erreur->getMessage();
  }
}



function getTaches($db, $login) {
  $sql = "SELECT * FROM taches";
  if ($login != NULL) {
    $sql .= " WHERE assignea = '" . $login . "'";
  }
  try {
    $retour["donnees"] = $db->query($sql);
    $retour["statut"] = "ok";
  } catch (PDOException $erreur) {
    $retour["donnees"] = $erreur->getMessage();
    $retour["statut"] = "erreur";
  }
  return $retour;
}


function getUsers($db, $login) {
  $sql = "SELECT * FROM membre";
      if ($login != NULL) {
    $sql .= " WHERE login = '" . $login . "'";
  }  try {
    // On prépare la requête : elle est envoyée au serveur sans les données variables
    $req = $db->prepare($sql);
    // On lie la donnée récupérée en GET avec notre requête préparée, et on déclare qu'elle doit être un entier.
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    // Exécution de la requête
    $req->execute();
    // Je récupère l'ensemble des données retournées par la requête grâce à fetchAll
    $detailTache = $req->fetchAll()[0];
    // j'assigne ces données à mes variables utilisées dans mon formulaire
    return $detailTache;

  } catch (PDOException $erreur) {
    echo $erreur->getMessage();
  }
}











?>
