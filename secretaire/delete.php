<?php
require_once("../includes/fonctions.php");
$db = connect();

$sql = "DELETE FROM taches WHERE id = :id";
try {
      $req = $db->prepare($sql);
      $req->bindParam(':id', $_GET["id"], PDO::PARAM_INT);
      $req->execute();
      header("location:taches.php?suppr=ok");
} catch (PDOException $erreur) {
        header("location:taches.php?suppr=no");
    } 

?>
