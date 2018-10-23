<?php
include("connexion.php");
session_start();
?>
<label for="formGroupExampleInput">Chosir un thème déja existant</label>
<select class="custom-select" name="nomTheme">
  <option selected>Choisir le thème</option>;

  <?php
  $req = $bdd->query('SELECT * FROM tb_theme');
  while ($data=$req->fetch()){
    echo "<option value='".$data['themeName']."'>".$data['themeName']."</option>";
  }
  echo' </select>';
  ?>
</select>
