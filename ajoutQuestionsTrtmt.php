<?php
include ("connexionBD.php" );
require "verif_SessionTrtmt.php";

try {

  //on recupère l'id du thème
  $req1= $bdd->prepare ('SELECT themeID from tb_theme WHERE themeName=?');
  $req1->execute(array($_POST['nomThemeSelec']));
  $data=$req1->fetch();

  //on insert la nouvelle question avec la valeur du formulaire et l'id du thème obtenu précédemment
  $req2= $bdd->prepare('INSERT INTO tb_question(questionContent, themeID) values(?,?)');
  $req2->execute(array($_POST['question'], $data['themeID']));
  $questionID=$bdd->lastInsertId();

  //on insert les questions correspondant à la question
  for ($i=1;$i<=4;$i++){
    if(($_POST['reponse'.$i])!=""){
      if(isset($_POST['isChecked'.$i])){
        $istrue=1;
      } else {
        $istrue=0;
      }
      $req3= $bdd->prepare('INSERT INTO tb_answer(answerContent,trueOrFalse, questionID) values(?,?,?)');
      $req3->execute(array($_POST['reponse'.$i],$istrue, $questionID));
    }
  }


  header("Location: baseQuestions.php");





} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>
