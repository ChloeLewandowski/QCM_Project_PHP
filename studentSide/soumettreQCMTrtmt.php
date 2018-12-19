<?php

include("../connexionBD.php");

//verifie si l'utilisateur est connecté
require "verif_SessionTrtmtStudent.php";

try{
  //on recupère d'abord la liste des questions possibles
  $reqRecuperationQuestions='SELECT questionContent, tb_question.questionID from tb_question, tb_matchqcmquestion where tb_matchqcmquestion.qcmID='.$_GET["qcmID"].' and tb_matchqcmquestion.questionID=tb_question.questionID';
  //pour chaque question je recupère ses réponses correspondantes et je vérifie si l'étudiant les a cochées ou pas
  foreach ($bdd->query($reqRecuperationQuestions) as $dataQuestions){
    $reqRecuperationReponses='SELECT * from tb_answer where tb_answer.questionID='.$dataQuestions["questionID"];
    foreach ($bdd->query($reqRecuperationReponses) as $dataReponses){
      if(isset($_POST[$dataReponses["answerID"]])){
        $reqReponsesEtudiant=$bdd->prepare('INSERT INTO tb_studentsanswer values(?,?,?)');
        $reqReponsesEtudiant->execute(array($_SESSION["userID"], $dataReponses["answerID"], $_GET["qcmID"]));
      }
    }
  }

  header("Location:resultats.php?success=true");
}catch(Exception $e){
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}


?>
