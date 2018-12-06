<?php
include("connexionBD.php");

?>
<i class="fas fa-book"></i> <label for="formGroupExampleInput"> Chosir un thème</label>
<select class="custom-select" name="nomThemeSelec" id="nomThemeSelec" onchange="displayQuestions()">
  <option selected>Choisir le thème</option>;

  <?php
  $req = $bdd->query('SELECT * FROM tb_theme');
  while ($data=$req->fetch()){
    echo "<option value='".$data['themeName']."'>".$data['themeName']."</option>";
  }
  echo' </select>';
  ?>
</select>
