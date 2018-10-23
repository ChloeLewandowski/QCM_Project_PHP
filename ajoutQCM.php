<?php
include ("connexion.php" );
echo "nom du nouveau thème:".$_POST['nomTheme'];
$req = $bdd->prepare('INSERT into tb_qcm (qcmTitle) values(?)');
$req->execute(array($_POST['titreQCM']));

$req1= $bdd->prepare('INSERT into tb_theme (themeTitle) values(?)');
$req->execute(array($_POST['titreQCM']));


 ?>
