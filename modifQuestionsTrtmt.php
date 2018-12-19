<?php
include ("connexionBD.php" );
require "verif_SessionTrtmt.php";

try {


  //modification du nom de la question et du thème
  $reqMAJThemeQuestion= $bdd->prepare('UPDATE tb_question SET questionContent =? , themeID=(SELECT themeID from tb_theme where themeName=?) where questionID=?');
  $reqMAJThemeQuestion->execute(array($_POST['question'], $_POST['nomThemeSelec'], $_GET['questionID']));
  $reqMAJReponses=$bdd->prepare('UPDATE ');

  //modification des Réponses déja renseignées
  //on recherche les réponses déjà existantes
  $reqExistingAnswer=$bdd->prepare('SELECT answerID, answerContent from tb_answer where questionID=?');
  $reqExistingAnswer->execute(array($_GET['questionID']));
  $nombrerow=0;
  while($data=$reqExistingAnswer->fetch()){
    $nombrerow=$nombrerow+1;

    if($_POST["reponse".$data["answerID"]]==""){

      $reqDeleteReponse=$bdd->prepare('DELETE FROM tb_answer where questionID=? and answerID=?');
      $reqDeleteReponse->execute(array($_GET['questionID'], $data["answerID"]));
    }
    else {
      if(isset($_POST[$data["answerID"]])){
        $istrue=1;
      } else {
        $istrue=0;
      }
      $reqMAJReponses=$bdd->prepare('UPDATE tb_answer SET answerContent=?, trueOrFalse=? where answerID=?');
      $reqMAJReponses->execute(array($_POST["reponse".$data["answerID"]], $istrue, $data["answerID"]));
    }
  }

  // s'il n'y a pas réponses on vérifie si l'utilisateur a rentré de nouvelles questions, et on les ajoute en base
  if ($nombrerow<4){
    for($j=0; $j<4-$nombrerow;$j++){
      if(isset($_POST["ischecked".$j])){
        $istrue=1;
      } else {
        $istrue=0;
      }
      $reqAjoutQuestions=$bdd->prepare('INSERT INTO tb_answer(answerContent,trueOrFalse, questionID) values(?,?,?)');
      $reqAjoutQuestions->execute(array($_POST['reponse'.$j],$istrue, $_GET['questionID']));

    }
  }
  $sucess="success";

  //enfin, on ajoute au log d'historique des modifications
  $date= new DateTime();
  $date->format('Y-m-d');
  $ajoutModifHistorique=$bdd->prepare('INSERT INTO tb_modificationsquestion values(?,?,?)');
  $ajoutModifHistorique->execute(array($_GET["questionID"], $_SESSION["userID"]), $date);
  header("Location:modifQuestion.php?questionID=".$_GET['questionID'])."&amp;modification=".$sucess;





}catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}





?>
