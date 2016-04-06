<?php
function hlavicka($nazov) {      // priraba hlavicku
?>
<!DOCTYPE HTML>
<html>
  <head>
  <meta charset="utf-8">
  <title><?php  echo $nazov; ?></title>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  </head>
    <body>
    <div class="container">
       <div class="container">
       <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Rozvrh</a>
          </div>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Zaregistrovať sa </a></li>
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Prihlásiť sa</a></li>
          </ul>
        </div>
      </nav>
      </div>  <!-- CONTAINER -->
<?php
}

function pata() {                // priraba paticku
 ?>
<div class="container">
        <footer class="footer" >
          <hr>
          <p class="lead" > Marián Jonis a Ľubomír Hrzič </p>
          <div  class="lead">Email : <a href="mailto:jonismajo@gmail.com" > jonismajo@gmail.com </a> , <a href="mailto:hrzic@azet.sk" > hrzic@azet.sk </a></div>
        </footer>
      </div>
      </div>  
    </body>
</html>    
<?php      
}

