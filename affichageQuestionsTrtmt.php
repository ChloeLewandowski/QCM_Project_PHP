<?php
include("connexionBD.php");
//verifie si l'utilisateur est connecté
require "verif_SessionTrtmt.php";
$req1= $bdd->prepare ('SELECT themeID from tb_theme WHERE themeName=?');
$req1->execute(array($_GET['a']));
$dataTheme=$req1->fetch();
$req2= $bdd->prepare ('SELECT questionContent, questionID from tb_question WHERE themeID=?');
$req2->execute(array($dataTheme[0]));


echo'<div id="listQuestions">';




echo' <div class="table-responsive">
<table id="mytable" class="table table-bordred table-striped">

<thead>

<th><input type="checkbox" id="checkall" /></th>
<th>Question content</th>
</thead>
<tbody>';
while($data=$req2->fetch()){
  echo'<tr>';
  echo'<td><input type="checkbox" class="checkthis" id=checkQuestion'.$data['questionID'].'/></td>';
  echo'<td>'.$data['questionContent'].'</td></tr>';
}
echo'  </tbody></table></div></div>';
?>
