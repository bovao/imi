<?php
require_once("../includes/fonctions.php");
$db = connect();


// Code de récupération de notre liste d'utilisateurs
// 1 - écriture de la requête SQL DELETE.
$sql = "DELETE FROM membre WHERE id= :id";
// 2 - Envoi de la requête avec la méthode try catch
try {
  // On prépare la requête : elle est envoyée au serveur sans les données variables
  $req = $db->prepare($sql);
  // On lie la donnée récupérée en GET avec notre requête préparée, et on déclare qu'elle doit être un entier.
  $req->bindParam(':id', $_GET["id"], PDO::PARAM_INT);
  // Exécution de la requête
  $req->execute();
  header("location:gestionUtilisateur.php?suppr=ok");
} catch (PDOException $erreur) {
  header("location:gestionUtilisateur.php?suppr=no");
}
