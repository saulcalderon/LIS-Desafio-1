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
  <title>Pokemon Bank</title>

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
      <a id="logo-container" href="#" class="brand-logo center">Pokemon Bank</a>
      <ul class="right hide-on-med-and-down">
        <li>
          <a href="index.html"><i class="material-icons">exit_to_app</i></a>
        </li>
      </ul>
    </div>
  </nav>

  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <a class="btn-back" href="menu.php"><i class="material-icons medium">arrow_back</i></a>
      <h1 class="center">Historial de transacciones</h1>
      <div class="container">
        <br /><br />
        <div class="row">
          <div class="col s12 m6">
            <h5 class="center income-title"></h5>
          </div>
          <div class="col s12 m6">
            <h5 class="center outcome-title"></h5>
          </div>
        </div>
        <div class="row">
          <div class="col m6">
            <div class="flex-container">
              <a id="transaction-income" class="waves-effect waves-light btn">Ingresos</a>
            </div>
            <ul id="transactions-income" class="collection"></ul>
          </div>
          <div class="col m6">
            <div class="flex-container">
              <a id="transaction-expense" class="waves-effect waves-light btn">Egresos</a>
            </div>
            <ul id="transactions-outcome" class="collection"></ul>
          </div>
          <div class="col m12">
            <canvas id="pie-chart" width="400" height="400"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="parallax">
      <img id="bc-image" src="background4.jpg" alt="" />
    </div>
  </div>

  <footer class="page-footer teal">
    <div class="footer-copyright">
      <div class="container">
        <a class="brown-text text-lighten-3">Pokemon Bank ©</a> Copyright 2022
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