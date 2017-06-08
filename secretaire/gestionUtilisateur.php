<?php include('header.php'); 

require_once("../includes/fonctions.php");
$db = connect(); 

function getUtilisateurs($db) {
  // Code de récupération de notre liste d'utilisateurs
  // 1 - écriture de la requête SQL SELECT.
  $sql = "SELECT id, login, mail, password, nom, secteur, niveau, rang FROM membre";
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

$page = listeUtilisateurs($db);
?>



<body>
    <!-- img de fond accueil -->
<?php include('menu.php'); ?>


<h1 class="custom-h1">Gestion des utilisateurs</h1>
<br/>
<?php  echo $page["corps"]; ?>

<script src="https://use.fontawesome.com/39cfcc7a15.js"></script>
</body>
    
