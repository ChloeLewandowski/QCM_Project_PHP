<?php
include ("connexionBD.php" );
require "verif_SessionTrtmt.php";

try {
// on vérifie d'abord que le nom du thème n'est pas déjà utilisé

//puis on insère le thème dans la base
  $reqAjoutTheme= $bdd->prepare('INSERT INTO tb_theme(themeName) values(?)');
  $reqAjoutTheme->execute(array($_POST['theme']));

  header("Location: themeCreation.php");

}catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}
