<?php
include ("connexionBD.php" );

try {
  $req = $bdd->prepare('INSERT into tb_qcm (qcmTitle) values(?)');
  $req->execute(array($_POST['titreQCM']));
  $qcmID=$bdd->lastInsertId();


  $req3=$bdd->prepare('SELECT questionID from tb_question where themeID=(SELECT themeID from tb_theme where themeName=?)');
  $req3->execute(array($_POST['nomThemeSelec']));

  while($data=$req3->fetch()){
    if (isset($_POST['isChecked'.$data['questionID']])){
      $req2= $bdd->prepare('INSERT into tb_matchqcmquestion values(?,?)');
      $req2->execute(array($qcmID, $_POST['isChecked'.$data['questionID']]));
      echo'je suis passée';
    }
  }




//  header("location:http://localhost/projetQCM/baseQuestions.php");
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>
