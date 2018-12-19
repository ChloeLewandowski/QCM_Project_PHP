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
        <li class="nav-item active">
          <a class="nav-link" href="themeCreation.php">
            <i class="fas fa-fw fa-book"></i>
            <span>Gérer les thèmes</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="baseQCM.php">
               <i class="fas fa-comment-dots"></i>
              <span>Publier des QCM</span></a>
          </li>
        </ul>

        <div id="content-wrapper">
          <div class="container-fluid">
            <div class="jumbotron jumbotron-fluid">
              <div class="container">
                <h4 class="display-4">Ajouter des thèmes</h4>
              </div>
            </div>
            <form class="form" method="post" action="themeCreationTrtmt.php">
            <div class="form-group"> <label for="question"><i class="fas fa-book"></i> Nouveau thème</label> <input class="form-control" name="theme" id="theme" aria-describedby="emailHelp" placeholder="Theme...">

            </div>

              <button class="btn btn-primary btn-lg btn-block" type="submit">Ajouter</button>
            </form>
            <br></br>
            <ul class="list-group">
              <label><i class="fas fa-ellipsis-h"></i> Thèmes déjà existants </label>
              <?php
              $reqThemes= $bdd->query('SELECT * FROM tb_theme');
              while ($dataThemes=$reqThemes->fetch()){
              echo '<li class="list-group-item">'.$dataThemes["themeName"].'</li>';
            }
              ?>
            </ul>
          </div>


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
