<!DOCTYPE html>
<?php
include("connexionBD.php");
//verifie si l'utilisateur est connecté
require "verif_SessionTrtmt.php";

?>
<html lang="en">

<head>

  <?php include("menus.php"); ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Tableau de bord</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="qcmCreation.php">
          <i class="fas fa-fw fa-question"></i>
          <span>Créer un QCM</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-brain"></i>
            <span>Gérer la base de questions</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="baseQuestions.php"><i class="fas fa-glasses"></i> Consulter</a>
            <a class="dropdown-item" href="questionCreation.php"><i class="fas fa-plus"></i> Ajouter</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="themeCreation.php">
            <i class="fas fa-fw fa-book"></i>
            <span>Gérer les thèmes</span></a>
        </li>
      </ul>

      <div id="content-wrapper">
        <div class="container-fluid">
          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h4 class="display-4">Modifier la question</h4>
            </div>
          </div>
          <form method="post" action="<?php echo("modifQuestionsTrtmt.php?questionID=".$_GET['questionID']); ?>">
            <div class="form-group">

            </div>
          </br>
          <div id="affichageQuestions">
            <?php
            $req = $bdd->prepare('SELECT questionContent, themeName FROM tb_question, tb_theme where questionID=? and tb_theme.themeID=tb_question.themeID');
            $req->execute(array($_GET['questionID']));
            $data=$req->fetch();
            echo'<i class="fas fa-book"></i> <label for="formGroupExampleInput"> Chosir un thème</label>
            <select class="custom-select" name="nomThemeSelec" id="nomThemeSelec">
            <option selected>'.$data["themeName"].'</option>';


            $reqTheme = $bdd->query('SELECT * FROM tb_theme');
            while ($dataTheme=$reqTheme->fetch()){
              if($dataTheme["themeName"]!=$data["themeName"]){
                echo "<option value='".$dataTheme['themeName']."'>".$dataTheme['themeName']."</option>";
              }
            }
            echo' </select>';




            $reqReponses=$bdd->prepare('SELECT answerContent, answerID, trueOrFalse from tb_answer where questionID=?');
            $reqReponses->execute(array($_GET['questionID']));




            echo'  <div class="form-group"> <label for="question"><i class="far fa-question-circle"></i> Question</label> <input class="form-control" name="question" id="question" aria-describedby="emailHelp" value="'.$data['questionContent'].'"></div>
            <i class="far fa-question-circle"></i> Réponses (cocher si correcte)</br><div class="input-group mb-3">';
            $nombrerow=0;
            while($dataRep=$reqReponses->fetch()){
              echo'  <div class="input-group mb-3"><div class="input-group-prepend"><div class="input-group-text"><input type="checkbox" id="'.$dataRep["answerID"].'" aria-label="Checkbox for following text input"';if ($dataRep["trueOrFalse"]==1){echo 'checked';} echo'></div></div><input type="text" class="form-control" aria-label="Text input with checkbox" name="reponse2" value="'.$dataRep["answerContent"].'"></div>';
              $nombrerow=$nombrerow+1;
              }
              if ($nombrerow<4){
                for($j=0; $j<4-$nombrerow;$j++){
                  echo '<div class="input-group mb-3"><div class="input-group-prepend"><div class="input-group-text"><input type="checkbox" id="ischecked'.$j.'" aria-label="Checkbox for following text input"></div></div><input type="text" class="form-control" aria-label="Text input with checkbox" name="reponse'.$j.'" placeholder="Nouvelle réponse proposée..."></div>';
                }
              }
              ?>
            </div>
          </br>
          <button class="btn btn-primary" type="submit">Modifier</button>
          <button type="button" class="btn btn-danger">Effacer les données</button>
        </form>

      </div>
      <!-- suppression de l'objet sélectionné dans la table -->
      <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading">Supprimer cette question</h4>
            </div>
            <div class="modal-body">

              <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Etes-vous sûr de vouloir supprimer cette question?</div>

            </div>
            <div class="modal-footer ">
              <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Oui</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Non</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <!-- <footer class="sticky-footer">
      <div class="container my-auto">
      <div class="copyright text-center my-auto">
      <span>Copyright © Your Website 2018</span>
    </div>
  </div>
</footer> -->
</div>
<!-- /#wrapper -->


</div>
<!-- /.content-wrapper -->
</div>



<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>



<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="js/demo/datatables-demo.js"></script>
<script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
