<?php include('header.php'); 

require_once("../includes/fonctions.php");
$db = connect(); 


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
    
