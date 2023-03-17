<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pokemon Bank</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>

<body>

  <div id="index-banner" class="parallax-container banner">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <div class="card blue-grey darken-1">
          <div class="card-content white-text">
            <h1 class="center">Mis Finanzas</h1>
            <h3 class="center">Inicio de sesión</h3>
            <form>
              <div class="container">
                <div class="row">
                  <div class="input-field col s12 m6 offset-m3">
                    <input id="user-input" type="text" class="validate">
                    <label for="user-input">Usuario</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12 m6 offset-m3">
                    <input id="pin" type="password" class="validate">
                    <label for="pin">PIN</label>
                  </div>
                </div>
                <div class="row">
                  <a id="btn-login" class="col s12 m6 offset-m3 waves-effect waves-light btn-large button-text">Ingresar</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="background3.jpg" alt="Unsplashed background img 1"></div>
  </div>

  <footer class="page-footer teal">
    <div class="footer-copyright">
      <div class="container">
        <a class="brown-text text-lighten-3">Mis Finanzas ©</a> Copyright 2022 - LIS
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="js/init.js"></script>


</body>

</html>