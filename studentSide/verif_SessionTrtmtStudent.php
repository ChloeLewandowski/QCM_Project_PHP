<?php
session_start();

if(!isset($_SESSION['pseudo'])){
  session_destroy();
  header("Location: ../accueilConnexion.php?erreurConnexion=statut");

}

else if($_SESSION["userID"]==2){

  session_destroy();
  header("Location: ../accueilConnexion.php?messageErreur=statut");
}

 ?>
