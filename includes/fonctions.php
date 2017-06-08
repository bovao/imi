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




function getDetailsUtilisateur($db, $id) {
  // On récupère les données de l'utilisateur passé en GET.
  // Requête SQL SELECT avec utilisation des alias pour renommer les noms des colonnes afin de simplifier la manipulation des données dans la page.
  $sql = "SELECT *
  FROM membre WHERE id = :id";
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

function connecteUtilisateur($db, $login, $password) {
  // On récupère les données de l'utilisateur passé en GET.
  // Requête SQL SELECT avec utilisation des alias pour renommer les noms des colonnes afin de simplifier la manipulation des données dans la page.
  $sql = "SELECT id, login, password, mail, nom, secteur, niveau, rang
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














?>
