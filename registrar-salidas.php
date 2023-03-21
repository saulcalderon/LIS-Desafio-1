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
      <div class="container">
        <br /><br />
        <h1 class="center">Salidas</h1>
        <br /><br />
        <h4 class="center">Ingrese los datos solicitados para agregar una salida</h4>
        <div class="row" style="margin-top: 50px; background-color: gray; padding: 20px;">
          <div class="input-field col m6 offset-m3">
            <input id="type" type="text" class="validate inputs">
            <label class="white-text" for="last_name">Tipo</label>
          </div>
          <div class="input-field col m6 offset-m3">
            <input id="money-input" type="text" class="form-control txt-margin inputs" aria-label="Monto" placeholder="Monto" />
            <label class="white-text" for="money-input">Monto en USD</label>
          </div>
          <div class="input-field col m6 offset-m3">
            <select id="select-type">
              <option value="salida" selected>Salida</option>
            </select>
            <label class="white-text">Tipo de transacción</label>
          </div>
          <div class="input-field col m6 offset-m3">
            <input id="transaction-date" type="text" class="datepicker white-text">
            <label class="white-text" for="transaction-date">Fecha transacción</label>
          </div>
          <div class="file-field input-field col m6 offset-m3">
            <div class="btn">
              <span>Adjuntar foto</span>
              <input id="photo-input" type="file" accept="image/*">
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate white-text" type="text">
            </div>
          </div>
          <div class="row">
            <div class="col m6 offset-m3">
              <a id="btn-transaction" class="btn-menu waves-effect waves-light btn-large">Agregar salida</a>
            </div>
          </div>
        </div>
      </div>
      <div class="parallax">
        <img id="bc-image" src="background4.jpg" alt="" />
      </div>
    </div>
  </div>
  <footer class="page-footer teal">
    <div class="footer-copyright">
      <div class="container">
        <a class="brown-text text-lighten-3">Mis Finanzas ©</a> Copyright 2022
        - LIS
      </div>
    </div>
  </footer>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/jspdf.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="js/init.js"></script>
</body>

</html>