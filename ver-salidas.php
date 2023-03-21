<?php

session_start();

// check if user is already logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mis Finanzas</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>

<body>
  <nav class="white" role="navigation">
    <div id="menu" class="nav-wrapper container">
      <ul class="left hide-on-med-and-down">
        <li><a>Fecha: 10/10/10</a></li>
      </ul>
      <a id="logo-container" href="#" class="brand-logo center">Mis Finanzas</a>
      <ul class="right hide-on-med-and-down">
        <li><a class="logout"><i class="material-icons">exit_to_app</i></a></li>
      </ul>
    </div>
  </nav>

  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <a class="btn-back" href="menu.php"><i class="material-icons medium">arrow_back</i></a>
      <h1 class="center">Ver salidas</h1>
      <div class="container">
        <div class="row" style="margin-top:80px">
          <div class="col s12">
            <ul id="transactions-outcome" class="collection"></ul>
          </div>
        </div>
      </div>
    </div>
    <div class="parallax">
      <img id="bc-image" src="background4.jpg" alt="" />
    </div>
  </div>

  <div id="modal1" class="modal">
    <div class="modal-content">
      <h5>Recibo</h5>
      <div id="image-container" style="display:flex;justify-content:space-around;"></div>

    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Salir</a>
    </div>
  </div>

  <footer class="page-footer teal">
    <div class="footer-copyright">
      <div class="container">
        <a class="brown-text text-lighten-3">Mis Finanzas ©</a> Copyright 2022
        - LIC
      </div>
    </div>
  </footer>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
  <script src="js/init.js"></script>
</body>

</html>