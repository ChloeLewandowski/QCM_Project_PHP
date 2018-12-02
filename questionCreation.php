<!DOCTYPE html>
<?php
include("connexionBD.php");
session_start();
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Dashboard</title>

  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <script>
  function getXhr(){
    var xhr = null;
    if(window.XMLHttpRequest) // Firefox et autres
    xhr = new XMLHttpRequest();
    else if(window.ActiveXObject){ // Internet Explorer
      try {
        xhr = new ActiveXObject("Msxml2.XMLHTTP");
      } catch (e) {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
      }
    }
    else { // XMLHttpRequest non supporté par le navigateur
      alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest");
      xhr = false;
    }
    return xhr;
  }

  function choixTheme(){
    var xhr = getXhr();
    // On défini ce qu'on va faire quand on aura la réponse
    xhr.onreadystatechange = function(){
      //Traitement seulement si on a tout reçu et que la réponse est ok
      if(xhr.readyState == 4 && xhr.status == 200){

        var html= this.responseText;
        document.getElementById('resultatradio').innerHTML=html;

      }
    }
    xhr.open("POST","creationTheme.php",true);
    xhr.send(null);
  }

  function reinitialiserChamps(){
    select = document.getElementById("affichageQuestions");
    //on choisit l'index qui est séléctionné
    choice = select.selectedIndex;
    //on recupère sa valeur
    nbQuestion = select.options[choice].value;
    //on initialise la zone de questions à vide
    document.getElementById('affichageQuestions').innerHTML="";

  }

  </script>

</head>

<body id="page-top">
  <?php
  echo 'Bonjour '.$_SESSION['pseudo']. '! Vous êtes '. $_SESSION['userType'].'.';
  ?>
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="dashboard.php">QCM Shuffle</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger">9+</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <span class="badge badge-danger">7</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Login Screens:</h6>
          <a class="dropdown-item" href="login.html">Login</a>
          <a class="dropdown-item" href="register.html">Register</a>
          <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Other Pages:</h6>
          <a class="dropdown-item" href="404.html">404 Page</a>
          <a class="dropdown-item" href="blank.html">Blank Page</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
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
        </ul>
        <div id="content-wrapper">

          <!-- Affichage de l'en-tête du QCM -->
          <div class="container-fluid">
            <div class="jumbotron jumbotron-fluid">
              <div class="container">
                <h4 class="display-4">Ajouter une question</h4>
              </div>
            </div>
            <form class="form" method="post" action="ajoutQuestionsTrtmt.php">
              <div class="form-group">

              </div>
            </br>
            <div id="affichageQuestions">
              <?php include("affichageThemes.php"); ?>
              <div class="form-group"> <label for="question"><i class="far fa-question-circle"></i> Question</label> <input class="form-control" name="question" id="question" aria-describedby="emailHelp" placeholder="Question..."></div>
              <i class="far fa-question-circle"></i> Réponses (cocher si correcte)</br><div class="input-group mb-3"><div class="input-group-prepend"><div class="input-group-text"><input type="checkbox" name="isChecked1" aria-label="Checkbox for following text input"></div></div><input type="text" class="form-control" aria-label="Text input with checkbox" name="reponse1" placeholder="Réponse proposée..."></div>
              <div class="input-group mb-3"><div class="input-group-prepend"><div class="input-group-text"><input type="checkbox" name="isChecked2" aria-label="Checkbox for following text input"></div></div><input type="text" class="form-control" aria-label="Text input with checkbox" name="reponse2" placeholder="Réponse proposée..."></div>
              <div class="input-group mb-3"><div class="input-group-prepend"><div class="input-group-text"><input type="checkbox" name="isChecked3" aria-label="Checkbox for following text input"></div></div><input type="text" class="form-control" aria-label="Text input with checkbox" name="reponse3" placeholder="Réponse proposée..."></div>
              <div class="input-group mb-3"><div class="input-group-prepend"><div class="input-group-text"><input type="checkbox" name="isChecked4" aria-label="Checkbox for following text input"></div></div><input type="text" class="form-control" aria-label="Text input with checkbox" name="reponse4" placeholder="Réponse proposée..."></div>
            </div>
          </br>
          <button class="btn btn-primary" type="submit">Valider</button>
          <button type="button" class="btn btn-danger">Effacer les données</button>

        </div>
      </form>
    </div>





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
