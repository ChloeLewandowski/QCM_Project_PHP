<?php
session_start();

$bool=session_destroy();

if($bool){

  header("location:http://localhost/projetQCM/accueilConnexion.php");
}
 ?>
