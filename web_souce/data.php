<?php
 session_start();
 error_reporting(-1);
 $times = array("8:10","9:00","9:50","10:40","11:30","12:20","13:10","14:00","14:50","15:40","16:30","17:20","18:10","19:00");
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function connect_db() {
	$conn = new mysqli('localhost', 'jonishrzic', '123456','rozvrh');
  if (! $conn) {
    return false;
  } else {
    return  $conn;
  }
}
function get_user($email,$pass){
	if ($con = connect_db()) {
		$query = 'SELECT * FROM users WHERE email="'.$email.'" AND passwd="'.$pass.'"'; 
		$result = $con->query($query); 
    if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
        $_SESSION['login'] = true;
	      $_SESSION['name'] = $row['name'];
	      $_SESSION['email'] = $row['email'];
        return  $row['name'];
			}
    } else {
      return "no result";
    }
	  	$con->close();
  } else {
    return "conection error"; 
  }
}
function insert_user($name,$email,$pwd){
  if ($con = connect_db()) {
		$query = 'INSERT INTO users SET name="'.$name.'",email="'.$email.'",passwd="'.$pwd.'"' ;
		$result = $con->query($query); 
		if ($result) {
      $con->close();
      return true;
		} else {
      $con->close();
      return false;
    }
    } else {
      $con->close();
      return false;
    } 
}
function hlavicka($nazov) {      // priraba hlavicku
administration();
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
          <ul class="nav navbar-nav">
            <li><a href="test.php">Testy</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php if (isset($_SESSION['login']) && $_SESSION['login']== true){ ?>
            <li ><a href="index.php?out=true" > <span class="glyphicon glyphicon-log-in"></span>Odhlásiť sa (<?php echo $_SESSION['name']?>)</a> </li>
            <?php } else {  ?>
            <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Zaregistrovať sa </a></li>
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Prihlásiť sa</a></li>
            <?php }?> 
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
function test($name,$res,$exp){
  if ($res == $exp) {
    $info = 'success';
  } else {
    $info = 'danger';
  }
  echo '<tr class="'.$info.'">';
  echo  '<td class="lead">'.$name.'</td>';
  echo  '<td>'.$res.'</td>';
  echo  '<td>'.$exp.'</td>';
  echo '</tr>';
}
function cal_row($time){
  $po ="...";
  $ut ="...";
  $st ="...";
  $sk ="...";
  $pi ="...";
  echo '<tr class="text-center">';
  echo  '<td class="info lead text-center">'.$time.'</td>';
  echo  '<td class="text-center">'.$po.'</td>';
  echo  '<td class="text-center">'.$ut.'</td>';
  echo  '<td class="text-center">'.$st.'</td>';
  echo  '<td class="text-center">'.$sk.'</td>';
  echo  '<td class="text-center">'.$pi.'</td>';
  echo '</tr>';
}
function make_table(){
   // cal_row($times[1]);
    for ($i = 8;$i < 19;$i++) {
     cal_row(strval($i));
     }
}
function login(){
  if (isset($_GET['email']) && isset($_GET['heslo'])){ 
       get_user($_GET['email'],$_GET['heslo']);
  }
}
function logout(){
if (isset($_SESSION['login'])){
      $_SESSION['login'] = false;
      $_SESSION['name'] = "";
      $_SESSION['email'] = "";
  }
}
function loregister(){
}
function administration(){
  if (isset($_GET['log'])){
    login();
  }
  if (isset($_GET['out'])){
    logout();
  }
  if (isset($_GET['reg'])){
    register();
  }

}

