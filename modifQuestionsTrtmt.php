<?php
include ("connexionBD.php" );
require "verif_SessionTrtmt.php";

try {


  //modification du nom de la question et du thème
  $reqMAJThemeQuestion= $bdd->prepare('UPDATE tb_question SET questionContent =? , themeID=(SELECT themeID from tb_theme where themeName=?) where questionID=?');
  $reqMAJThemeQuestion->execute(array($_POST['question'], $_POST['nomThemeSelec'], $_GET['questionID']));
  $reqMAJReponses=$bdd->prepare('UPDATE ');

  //modification des Réponses déja renseignées
  $reqMAJReponses=$bdd->prepare('UPDATE tb_answer SET answerContent=')


  //modification des nouvelles réponses renseignées 



}catch (Exception $e) {
echo 'Caught exception: ',  $e->getMessage(), "\n";
}





 ?>
