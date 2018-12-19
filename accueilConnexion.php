<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>QCM Master- Se connecter</title>

  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Se connecter</div>
      <div class="card-body">
        <form class="form" method="post" action="loginTrtmt.php">
          <div class="form-group">
            <?php
            if (isset($_GET['connexion'])){
              echo '<div class="alert alert-danger" role="alert">
              Mot de passe ou login erroné... Veuillez réessayer </div>';} ?>
            <?php  if (isset($_GET['messageErreur'])){
                echo '<div class="alert alert-danger" role="alert">
                Vous n\'avez pas les autorisations requises afin d\'accéder à cette page. Contactez votre administrateur pour plus d\'informations. </div>';} ?>
                <?php if (isset($_GET['erreurConnexion'])){
                    echo '<div class="alert alert-danger" role="alert">
                    Vous devez vous connecter afin d\'accéder à ce contenu. </div>';}?>
              <div class="form-label-group">
                <input type="username" name="username" class="form-control" placeholder="Login" required="required" autofocus="autofocus">
                <label for="username">Login</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required="required">
                <label for="inputPassword">Mot de passe</label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <!-- <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label> -->
            </div>
          </div>
          <!-- <a class="btn btn-primary btn-block" href="index.html">Login</a> -->
          <input type="submit" name="Soummettre" class="btn btn-primary btn-block" value="Se connecter">
        </form>
        <!-- <div class="text-center">
        <a class="d-block small mt-3" href="register.html">Register an Account</a>
        <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
      </div> -->
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
