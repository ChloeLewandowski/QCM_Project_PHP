<?php
include ("connexionBD.php" );
require "verif_SessionTrtmt.php";
try{

  $reqChangementStatut=$bdd->prepare('UPDATE tb_qcm set statusID=1 where qcmID=?');
  $reqChangementStatut->execute(array($_GET['qcmID']));

    header("Location: baseQCM.php");

}catch(Exception $e) {
echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>
