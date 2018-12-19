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
      <a class="nav-link" href="resultats.php">
        <i class="fas fa-graduation-cap"></i>
        <span>Mes résultats</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="affichageQCM.php">
          <i class="fas fa-comments"></i>
          <span>Répondre aux QCM</span></a>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">
          <!-- affichage de chaque thème pour trier les QCM -->
          <?php

          $reqThemes='SELECT * FROM tb_theme';
          foreach ($bdd->query($reqThemes) as $dataThemes){


          echo'<ol class="breadcrumb">'.$dataThemes['themeName'].'</ol>';

          $reqQCMTheme='SELECT tb_qcm.qcmID, qcmTitle, qcmLimitDate from tb_matchqcmquestion, tb_question,tb_qcm where tb_question.themeID='.$dataThemes["themeID"].' and statusID=1 and tb_matchqcmquestion.questionID=tb_question.questionID and tb_qcm.qcmID=tb_matchqcmquestion.qcmID GROUP BY tb_qcm.qcmID';


          echo'<div class="row">';

          foreach  ($bdd->query($reqQCMTheme) as $dataQCM) {
            // echo $dataQCM["qcmLimitDate"]."versus".new DateTime('now');
          $datelimite= new dateTime($dataQCM["qcmLimitDate"]);
          $dateActuelle=new dateTime('now');
            if ($datelimite>$dateActuelle){
             $linkConsulter="reponsesQCM.php?qcmID=".$dataQCM['qcmID']."";

            echo'<div class="col-sm">

              <div class="card-body">
                <h5 class="card-title">'.$dataQCM["qcmTitle"].'</h5>
                <p class="card-text">Disponible jusqu\'au '.$dataQCM["qcmLimitDate"].'</p>
                <a href="'.$linkConsulter.'" class="btn btn-primary">Remplir!</a>
              </div>
            </div>';
          }
          }
          echo '</div>';

        }
          ?>

          <!-- affichage des QCM -->
          <!-- <div class="row">


            <div class="col-sm">

              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
            <div class="col-sm">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>

          </div> -->
          <!-- fin affichage des QCM -->


        </div>





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
