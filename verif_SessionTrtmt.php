<?php
session_start();
if(!isset($_SESSION['pseudo'])) {
  header("Location: accueilConnexion.php");
  exit();
}

 ?>
