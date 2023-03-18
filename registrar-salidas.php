<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mis Finanzas</title>

    <!-- CSS  -->
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <link
      href="css/materialize.css"
      type="text/css"
      rel="stylesheet"
      media="screen,projection"
    />
    <link
      href="css/style.css"
      type="text/css"
      rel="stylesheet"
      media="screen,projection"
    />
  </head>

  <body>
    <nav class="white" role="navigation">
      <div id="menu" class="nav-wrapper container">
        <ul class="left hide-on-med-and-down">
          <li><a>Fecha: 10/10/10</a></li>
        </ul>
        <a id="logo-container" href="#" class="brand-logo center"
          >Mis Finanzas</a
        >
        <ul class="right hide-on-med-and-down">
          <li>
            <a href="index.html"><i class="material-icons">exit_to_app</i></a>
          </li>
        </ul>
      </div>
    </nav>

    <div id="index-banner" class="parallax-container">
      <div class="section no-pad-bot">
        <a class="btn-back" href="menu.html"
          ><i class="material-icons medium">arrow_back</i></a
        >
        <div class="container">
          <br /><br />
          <h1 class="center">Retiro</h1>
          <div class="row">
            <div class="col s12 m6">
              <h5 class="center no-cuenta"></h5>
            </div>
            <div class="col s12 m6">
              <h5 class="center balance-general"></h5>
            </div>
          </div>
          <br /><br />
          <h4 class="center">Seleccione o ingrese la cantidad a retirar</h4>
          <div class="row">
            <div class="input-field col m6 offset-m3">
              <input
                id="withdraw-money-input"
                type="number"
                class="form-control txt-margin money-input"
                aria-label="Monto"
                placeholder="Monto"
                min="0.01"
                step="0.01"
              />
              <label class="white-text" for="withdraw-money-input"
                >Monto en USD</label
              >
            </div>
            <div class="col s12 m6">
              <a
                id="btn-add-25"
                class="btn-menu waves-effect waves-light btn-large"
                >$25</a
              >
            </div>
            <div class="col s12 m6">
              <a
                id="btn-add-50"
                class="btn-menu waves-effect waves-light btn-large"
                >$50</a
              >
            </div>
            <div class="col s12 m6">
              <a
                id="btn-add-100"
                class="btn-menu waves-effect waves-light btn-large"
                >$100</a
              >
            </div>
            <div class="col s12 m6">
              <a
                id="btn-add-200"
                class="btn-menu waves-effect waves-light btn-large"
                >$200</a
              >
            </div>
          </div>
          <div class="row">
            <div class="col m6 offset-m3">
              <a
                id="btn-withdraw"
                class="btn-menu waves-effect waves-light btn-large"
                >Retirar</a
              >
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
          <a class="brown-text text-lighten-3">Mis Finanzas ©</a> Copyright 2022
          - LIS
        </div>
      </div>
    </footer>

    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/jspdf.min.js"></script>
    <script src="js/init.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </body>
</html>
