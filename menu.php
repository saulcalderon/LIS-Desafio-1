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
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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

  <!-- <ul id="nav-mobile" class="sidenav">
        <li><a href="#">Navbar Link</a></li>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a> -->
  <!-- </div>
  </nav> -->

  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="center">Menú</h1>
        <h3 class="center bienvenida"></h3>
        <br><br>
        <h3 class="center">Elija un servicio</h3>
        <div class="row">
          <div class="col s12 m6">
            <a class="btn-menu waves-effect waves-light btn-large" href="registrar-entradas.php">Registrar entrada</a>
          </div>
          <div class="col s12 m6">
            <a class="btn-menu waves-effect waves-light btn-large" href="transactions.html">Ver entradas</a>
          </div>
          <div class="col s12 m6">
            <a class="btn-menu waves-effect waves-light btn-large" href="registrar-salidas.php">Registrar salida</a>
          </div>
          <div class="col s12 m6">
            <a class="btn-menu waves-effect waves-light btn-large" href="services.html">Ver salidas</a>
          </div>
          <div class="col m6 offset-m3">
            <a class="btn-menu waves-effect waves-light btn-large" href="services.html">Mostrar balance</a>
          </div>
        </div>
      </div>
    </div>
    <div class="parallax"><img id="bc-image" src="background4.jpg" alt=""></div>
  </div>

  <footer class="page-footer teal">
    <div class="footer-copyright">
      <div class="container">
        <a class="brown-text text-lighten-3">Pokemon Bank ©</a> Copyright 2022 - LIC
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

</body>

</html>