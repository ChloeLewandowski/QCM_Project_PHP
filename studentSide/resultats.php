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
    <li class="nav-item active">
      <a class="nav-link" href="resultats.php">
        <i class="fas fa-graduation-cap"></i>
        <span>Mes résultats</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="affichageQCM.php">
          <i class="fas fa-comments"></i>
          <span>Répondre aux QCM</span></a>
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">


        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php if(isset($_GET["success"])){
          echo'<div class="alert alert-success" role="alert">
          Vos réponses ont bien été soumises! Vous pouvez consulter vos résultats.
          </div>';
        }

        //reponses correctes donnnées par l'étudiant

        //nombre de réponses correctes dans le qcm
          $reponsesSupposees=0;
          $reqQCM='SELECT qcmID from tb_qcm';

          //on parcours tous les qcm
          foreach ($bdd->query($reqQCM) as $listQCM){
            $sumNotes=0;

            $reqReponses="SELECT tb_answer.answerID, trueOrFalse from tb_studentsanswer, tb_answer where qcmID=".$listQCM['qcmID']." and userID=".$_SESSION['userID']." and tb_studentsanswer.answerID=tb_answer.answerID";
            //pour chaque qcm on regarde chaque réponse donnée par l'étudiant

            foreach ($bdd->query($reqReponses) as $listRepEtudiant){

              if($listRepEtudiant["trueOrFalse"]==1){
                  $sumNotes=$sumNotes+1;
               }
             }

             $reqQuestionsDuQCM="SELECT tb_question.questionID from tb_question, tb_matchqcmquestion where qcmID=".$listQCM['qcmID'];
             foreach($bdd->query($reqQuestionsDuQCM) as $listQuestions){
               $reqReponsesAttendues="SELECT trueOrFalse from tb_answer where questionID=".$listQuestions["questionID"];
               foreach ($bdd->query($reqReponsesAttendues) as $listReponsesAttendues) {
                 if($listReponsesAttendues["trueOrFalse"]==1){
                   $reponsesSupposees=$reponsesSupposees+1;
                 }
               }
             }
              // $reqNoteBase="SELECT trueOrFalse from tb_answer";
              //
              // // je calcule le nombre de réponses correctes dans le qcm
              // foreach ($bdd->query($reqNoteBase) as $listNotesBase){
              //
              //   if($listNotesBase['trueOrFalse']==1){
              //
              //     $reponsesSupposees=$reponsesSupposees+1;
              //   }
              // }
              // //j'ai terminé de calculer le nombre totale de réponses correctes dans le qcm
              // //je calcule le nombre de réponse correcte donnée par l'étudiant
              // $reqNote="SELECT trueOrFalse from tb_answer where answerID=".$listRepEtudiant["answerID"];
              // // foreach ($bdd->query($reqNote) as $listNotes){
              // //   if($listNotes["trueOrFalse"]==1){
              // //     $sumNotes=$sumNotes+1;
              // //   }
              // //
              // //
              // // }


            echo "note obtenue au qcm:".$listQCM["qcmID"]."-->".$sumNotes."              \n";
            echo "reponses attendues".$reponsesSupposees;
          }



            ?>
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
