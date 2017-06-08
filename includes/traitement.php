<?php require("fonctions.php");
$db = connect(); 

function getUtilisateurs($db) {
  // Code de récupération de notre liste d'utilisateurs
  // 1 - écriture de la requête SQL SELECT.
  $sql = "SELECT * FROM membre";
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
            <th>nom</th>
            <th>secteur</th>
            <th>niveau</th>
            <th>Rang</th>
      </tr>";
    while($membre = $donnees["donnees"]->fetch()) {
      // var_dump($utilisateur);
      $contenu["corps"].= "<tr>";
      $contenu["corps"].= "<td>".$membre["id"]."</td>";
      $contenu["corps"].= "<td>".$membre["login"]."</td>";
      $contenu["corps"].= "<td>".$membre["mail"]."</td>";   
      $contenu["corps"].= "<td>".$membre["nom"]."</td>";
      $contenu["corps"].= "<td>".$membre["secteur"]."</td>";
      $contenu["corps"].= "<td>".$membre["niveau"]."</td>";
      $contenu["corps"].= "<td>".$membre["rang"]."</td>";
        
      $contenu["corps"].= "<td>
        <a href='delete.php?id=".$membre["id"]."'>supprimer</a><br />
        <a href='update.php?id=".$membre["id"]."'>détails</a><br />
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

$page = listeUtilisateurs($db);
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
    <h2 class="h2-custom">Inscription terminée</h2>
</div>

    
<img src="../assets/img/fond-inscription.jpg" id="imgInscription">

<div id="fondInfo">
        
   <h1 class="white">Liste des utilisateurs</h1>    
        <?php  echo $page["corps"]; ?>
        
    <a href="connexion.php"><input type="button" value="Connexion" class="btnEnvoie top40"/></a>  <!-- btn inscription -->
</div>

    
</body>