<?php
/*
Fonction permettant de déconnecter un utilisateur en supprimant sa session et en vidant les variables liées.
*/
function deconnexion() {
  session_destroy();
  $_SESSION = array();
  header("location:../index.php");
  exit;
}
?>
