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
          <li class="nav-item active">
            <a class="nav-link" href="baseQCM.php">
              <i class="fas fa-comment-dots"></i>
              <span>Publier des QCM</span></a>
            </li>


          </ul>

          <div id="content-wrapper">
            <div id="container-fluid">
              <div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h4 class="display-4">Publier des QCM</h4>
                </div>
              </div>

              <div class="table-responsive">


                <table id="mytable" class="table table-bordred table-striped">

                  <thead>


                    <th style="
                    width: 75%;
                    ">Nom du QCM </th>
                    <th>Statut</th>
                    <th> Date limite  </th>
                    <th></th>
                  </thead>
                  <tbody>
                    <?php
                    $req ='SELECT qcmID,qcmTitle,qcmLimitDate,statusName,tb_qcm.statusID FROM tb_qcm, tb_status where tb_qcm.statusID= tb_status.statusID';

                    foreach  ($bdd->query($req) as $row) {
                      $linkPublier="publierQCM.php?qcmID=".$row['qcmID']."";


                      echo' <tr>
                      <td>'.$row["qcmTitle"].'</td>';
                      echo'<td>'.$row["statusName"].'</td>';
                      echo'<td>'.$row["qcmLimitDate"].'</td>';

                      //si le statut du qcm en base est "publié", on rend inactif le bouton de publicatin
                      echo'<td><a href="'.$linkPublier.'" class="btn btn-primary';if ($row['statusID']==1){echo " disabled";}echo'">Publier</a></td>
                      </tr>';
                    }

                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>




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
