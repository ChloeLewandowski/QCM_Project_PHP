<!DOCTYPE html>
<?php
include("../connexionBD.php");

//verifie si l'utilisateur est connecté
require "verif_SessionTrtmtStudent.php";

?>
<html lang="en">

<?php include("menus.php"); ?>

<div id="wrapper">

  <!-- Sidebar -->
  <ul class="sidebar navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="dashboardEtudiant.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Tableau de bord</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="themeCreation.php">
        <i class="fas fa-graduation-cap"></i>
        <span>Mes résultats</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="reponsesQCM.php">
          <i class="fas fa-comments"></i>
          <span>Répondre aux QCM</span></a>
        </li>
      </ul>

      <div id="content-wrapper">
      
        <div class="container-fluid">
            <form class="form" method="post" <?php echo 'action="soumettreQCMTrtmt.php?qcmID='.$_GET["qcmID"].'"';?>>

          <?php
          $reqQuestions='SELECT questionContent, tb_question.questionID from tb_question, tb_matchqcmquestion where tb_matchqcmquestion.qcmID='.$_GET["qcmID"].' and tb_matchqcmquestion.questionID=tb_question.questionID';

          foreach ($bdd->query($reqQuestions) as $dataQuestions){
            echo'<div class="card text-center">
            <div class="card-header">
            question 1/n
            </div>
            <div class="card-body">
            <h5 class="card-title">'.$dataQuestions["questionContent"].'</h5>';

            $reqReponses='SELECT * from tb_answer where tb_answer.questionID='.$dataQuestions["questionID"];


            echo'</div>
            <ul class="list-group list-group-flush" >';
            foreach ($bdd->query($reqReponses) as $dataReponses){
              echo'<li class="list-group-item" style="
              text-align: left;
              "><div class="checkbox">
              <label>
              <input type="checkbox" name="'.$dataReponses["answerID"].'">
              <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>'.$dataReponses["answerContent"].'
              </label>
              </div>
              </li>';


            }
            echo'
            </ul>


            </div>
            </br>';
          }
          ?>

          <button class="btn btn-primary btn-lg btn-block" type="submit">Valider mes réponses</button>
          <button type="button" class="btn btn-warning btn-lg btn-block">Effacer mes réponses</button>

        </form>
          <!--
          <div class="progress">

          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
        </div> -->
        <!-- <br></br> -->




      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2018</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>



  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="../vendor/datatables/jquery.dataTables.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../js/demo/datatables-demo.js"></script>
  <script src="../js/demo/chart-area-demo.js"></script>

</body>

</html>
