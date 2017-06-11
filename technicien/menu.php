<?php include ('../includes/fonctions.php') ; 
$db = connect(); 
?>


<footer>
<div class="menu">          
<ul id="navigation">
 <li class="relative">
     <i class="fa fa-user fa-2x custom-brown"></i>
 <br><a href='compte.php' id="moncompte">Mon compte</a></li>

 <li class="relative">
     <i class="fa fa-tasks fa-2x black"></i>
     <span class="notification-counter">2</span>
 <br><a href="taches.php" id="mestaches">Mes tâches</a></li>
      
  <li class="relative">
      <i class="fa fa-envelope fa-2x black"></i>
      <span class="notification-counter">4</span>
   <br><a href="messagerie.php">Messageries</a></li>
</ul>
</div> 
</footer>
