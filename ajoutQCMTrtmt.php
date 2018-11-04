<?php
include ("connexionBD.php" );
echo "nom du nouveau thème:".$_POST['nomTheme'];
try {
  $req = $bdd->prepare('INSERT into tb_qcm (qcmTitle) values(?)');
  $req->execute(array($_POST['titreQCM']));

  if(isset($_POST['nomThemeCree'])){
    $req1= $bdd->prepare('INSERT into tb_theme (themeName) values(?)');
    $req1->execute(array($_POST['titreQCM']));
  }
  header("location:http://localhost/projetQCM/questionCreation.php");
} catch (Exception $e) {
  echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>
