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
        <li>
          <a href="index.html"><i class="material-icons">exit_to_app</i></a>
        </li>
      </ul>
    </div>
  </nav>

  <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <a class="btn-back" href="menu.html"><i class="material-icons medium">arrow_back</i></a>
      <h1 class="center">Historial de transacciones</h1>
      <div class="container">
        <br /><br />
        <div class="row">
          <div class="col s12 m6">
            <h5 class="center no-cuenta"></h5>
          </div>
          <div class="col s12 m6">
            <h5 class="center balance-general"></h5>
          </div>
        </div>
        <br /><br />
        <div class="row">
          <div class="col m6">
            <canvas id="myChart" width="400" height="400"></canvas>
            <canvas id="myChart2" width="400" height="400"></canvas>
          </div>
          <div class="col m6">
            <div class="flex-container">
              <a id="transaction-all" class="waves-effect waves-light btn">Todos</a>
              <a id="transaction-income" class="waves-effect waves-light btn">Ingresos</a>
              <a id="transaction-expense" class="waves-effect waves-light btn">Egresos</a>
            </div>
            <ul id="transactions" class="collection"></ul>
          </div>
        </div>
      </div>
    </div>
    <div class="parallax">
      <img id="bc-image" src="pikachu-wallpaper.jpeg" alt="" />
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
  <script src="js/init.js"></script>
</body>

</html>