<?php
include ("connexionBD.php" );


$req = $bdd->prepare('SELECT * FROM tb_user WHERE userLogin= ? AND userPassword= ?');
$req->execute(array($_POST['username'], $_POST['password']));

$data=$req->fetch();

// if ($data['userLogin'] == md5($_POST['password']))
if($data) // Acces OK !
{
  session_start();

  $_SESSION['userID'] = $data['userID'];
  $_SESSION['pseudo'] = $data['userLogin'];
  $_SESSION['id'] = $data['userTypeId'];
  $_SESSION['nom']=$data['userName'];
  $_SESSION['prenom']=$data['userFirstName'];
  $_SESSION['mail']=$data['userEmail'];
  $_SESSION['dateInscription']=$data['registrationDate'];
  // // $_SESSION['level'] = $data['membre_rang'];
  $req2 = $bdd->prepare('SELECT userTypeName FROM tb_usertype WHERE userTypeId= ?');
  $req2->execute(array($_SESSION['id']));

  while($row = $req2->fetch()){
    $_SESSION['userType']=$row['userTypeName'];
  }



if ($_SESSION['id']==2){
  header("location:http://localhost/projetQCM/dashboard.php");
}

else {
  header("location:http://localhost/projetQCM/studentSide/dashboardEtudiant.php");
}


}
else // Acces pas OK !
{
  // echo'<p>Une erreur s\'est produite
  // pendant votre identification.<br /> Le mot de passe ou le pseudo
  // entré n\'est pas correcte.</p><p>Cliquez <a href="./connexion.php">ici</a>
  // pour revenir à la page précédente
  // <br /><br />Cliquez <a href="./index.php">ici</a>
  // pour revenir à la page d accueil</p>';

  header("location:http://localhost/projetQCM/accueilConnexion.php?connexion=error");
}
$req->CloseCursor();






?>
