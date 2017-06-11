<?php
/*
Fonction permettant de déconnecter un utilisateur en supprimant sa session et en vidant les variables liées.
*/
function deconnexion() {
  session_destroy();
  header("location:../connexion.php");
  exit;
}
?>
