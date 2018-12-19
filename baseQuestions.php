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
        <li class="nav-item">
          <a class="nav-link" href="baseQCM.php">
             <i class="fas fa-comment-dots"></i>
            <span>Publier des QCM</span></a>
        </li>
      </ul>

      <div id="content-wrapper">
        <div id="container-fluid">

        <?php  if(isset($_GET["ajout"])): ?>
          <div class="alert alert-success" role="alert">
La question a bien été ajoutée à la base!
</div>

<?php endif; ?>



          <!-- DataTables Example -->
          <?php
          $req1='SELECT * FROM tb_Theme';
          foreach  ($bdd->query($req1) as $row) {

            echo' <h3><i class="fas fa-hand-point-right"></i> '.$row["themeName"].'</h3></br>';
            $req ='SELECT * FROM tb_question WHERE themeID='.$row["themeID"];
            $resultat=$bdd->query($req);
            $num_of_rows = $resultat->rowCount() ;
            if ($num_of_rows>0){
              echo'<div class="col-md-12">

       <div class="table-responsive">';
              echo'<div class="table-responsive">


              <table id="mytable" class="table table-bordred table-striped">

              <thead>


              <th style="
              width: 60%;
              ">Question </th>
              <th>Créateur...</th>
              <th>Date de création</th>
              <th>Modifier</th>
              </thead>
              <tbody>';

              foreach  ($bdd->query($req) as $row) {
                $linkModifier="modifQuestion.php?questionID=".$row['questionID']."";
                $reqCreateur=$bdd->prepare('SELECT userName, userFirstName, dateAjout from tb_ajoutsquestion, tb_user where questionID=? and tb_user.userID=tb_ajoutsquestion.userID');
                $reqCreateur->execute(array($row['questionID']));
                $createur=$reqCreateur->fetch();
                // echo'<tr>
                // <td>'.$row["questionID"].'</td>
                // <td>'.$row["questionContent"].'</td>
                //
                // <td>'.$nbRep.'</td>
                //
                // </tr>';
                echo' <tr>
                <td>'.$row["questionContent"].'</td>';
                echo'<td>'.$createur["userName"].' '.$createur["userFirstName"].'</td>';
                echo'<td>'.$createur["dateAjout"].'</td>';
                echo'<td><a href="'.$linkModifier.'" class="btn btn-primary"><i class="fas fa-pen"></i></a>';
                  // <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" href='.$linkModifier.' ><i class="fas fa-pen"></i></button></p></td>

              }


              echo'  </tbody>
              </table>
              </div>
              </div>
              </div>';

            }
            else {
              echo'<div class="alert alert-light" role="alert">
              Pas de questions pour ce thème pour le moment...  Pour ajouter une nouvelle question cliquer<a href="questionCreation.php" class="alert-link"> ici</a>.
              </div>';
            }
            echo'<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
            <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
            </div>
            <div class="modal-body">
            <div class="form-group">
            <input class="form-control " type="text" placeholder="Mohsin">
            </div>
            <div class="form-group">

            <input class="form-control " type="text" placeholder="Irshad">
            </div>
            <div class="form-group">
            <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>


            </div>
            </div>
            <div class="modal-footer ">
            <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
            </div>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
            </div>';}
            ?>

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
