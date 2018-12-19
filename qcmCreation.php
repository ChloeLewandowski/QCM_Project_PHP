<!DOCTYPE html>
<?php
include("connexionBD.php");
//verifie si l'utilisateur est connecté
require "verif_SessionTrtmt.php";

?>
<html lang="en">

<?php include("menus.php"); ?>

  <!-- customisation js de la liste avec Checkbox -->
  <script type="text/javascript" src="js/checkedListGroup.js"></script>
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


  function displayQuestions(){
    var xhr = getXhr();
    // On défini ce qu'on va faire quand on aura la réponse
    xhr.onreadystatechange = function(){
      //Traitement seulement si on a tout reçu et que la réponse est ok
      if(xhr.readyState == 4 && xhr.status == 200){

        var html= this.responseText;
        document.getElementById("listQuestions").innerHTML=html;

      }
    }
    xhr.open("GET","affichageQuestionsTrtmt.php?a="+document.getElementById('nomThemeSelec').value,true);
    xhr.send(null);
  }

  function eraseData(){
    document.getElementById("titreQCM").value='';
    document.getElementById("nomThemeSelec").value="";

    var table=document.getElementById('mytable');
    while (table.firstChild)
    {
      table.removeChild(table.firstChild);
    }

  }

  </script>



  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Tableau de bord</span>
        </a>
      </li>

      <li class="nav-item active">
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
        <li class="nav-item">
          <a class="nav-link" href="baseQCM.php">
             <i class="fas fa-comment-dots"></i>
            <span>Publier des QCM</span></a>
        </li>
      </ul>
      <div id="content-wrapper">

        <!-- Affichage de l'en-tête du QCM -->
        <div class="container-fluid">
          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h3 class="display-4">Créer le QCM</h3>
              <hr class="my-4">
              <p class="lead"> Renseignez les infos de base de votre nouveau QCM </p>
            </div>
          </div>

          <form class="form" method="post" action="ajoutQCMTrtmt.php">
            <div class="form-group">
              <i class="fas fa-pencil-alt"></i> <label for="formGroupExampleInput"> Titre</label>
              <input type="text" name="titreQCM" class="form-control" id="titreQCM" placeholder="titre QCM" required>
            </div>

            <div class="form-group">
              <?php include("affichageThemes.php"); ?>

              <div class="form-group">
    			<i class="fas fa-clock"></i> <label> Date limite</label>
          <?php $date= new DateTime();?>
    		    <input type="date" id="dateLimite" name="dateLimite" class="form-control" placeholder="Choose" format="yyyy/mm/dd" min="<?php echo $date->format('Y-m-d');?>" max="2025-01-01" required/>
    		</div>


            </div>



            <div class="col-xs-6">
              <!-- <h3 class="text-center">Selectionner les questions à ajouter au QCM</h3> -->
              <i class="far fa-question-circle"></i> <label for="listQuestions"> Selectionner les questions à ajouter au qcm</label>
              <?php echo'<div id="listQuestions"></div>'?>
            </div>
          </br>

          <button type="submit" class="btn btn-primary btn-lg btn-block">Création du QCM</button>
          <button type="button" class="btn btn-warning btn-lg btn-block" onclick="eraseData()">Réinitialiser les données saisies</button>
        </div>





      </form>
    </div>
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
