<?php
 session_start();
 error_reporting(-1);
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
function user_add_del_fav(){
 if (isset($_GET['add'])){
  if ($con = connect_db()) {
    $query = 'INSERT INTO favourite SET sub_id="'.$_GET['add'].'",user_id="'.$_SESSION['id'].'"';
		$res = $con->query($query);
  }
 }
 if (isset($_GET['del'])){
 if ($con = connect_db()) {
    $query = 'DELETE FROM favourite WHERE sub_id="'.$_GET['del'].'" AND user_id="'.$_SESSION['id'].'"';
		$res = $con->query($query);
   }
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
        $_SESSION['id'] = $row['id'];
        get_my_favs();
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
function get_all_subjects(){
         if ($con = connect_db()) {
		$query = 'SELECT * FROM subjecst'; 
		$result = $con->query($query); 
    if ($result->num_rows > 0) {
     $res = [];
			while ($row = $result->fetch_assoc()) {
        array_push ( $res,$row);  
			}
      return $res;
    } else {
      return [];
    }
	  	$con->close();
  } else {
    return []; 
  }
}
function get_my_favs(){
  if ($con = connect_db()) {
		$query = 'SELECT * FROM favourite WHERE user_id="'.$_SESSION['id'].'"'; 
		$result = $con->query($query); 
    $_SESSION['fav'] = [];
    if ($result->num_rows > 0) {
     //$_SESSION['fav'] = [];
			while ($row = $result->fetch_assoc()) {
        array_push ($_SESSION['fav'],$row);
			}
      return $res;
    } else {
      return [];
    }
	  	$con->close();
  } else {
    return []; 
  }
}
function get_all_teachers(){
  if ($con = connect_db()) {
		$query = 'SELECT * FROM teachers'; 
		$result = $con->query($query); 
    if ($result->num_rows > 0) {
     $res = [];
			while ($row = $result->fetch_assoc()) {
        	$query = 'SELECT * FROM users WHERE id="'.$row['user_id'].'"'; 
		      $ress = $con->query($query);
           if ($ress->num_rows > 0) {
			       while ($roww = $ress->fetch_assoc()) {
                $res[$row['id']] = $roww; 
             }
           } 
			}
      return $res;
    } else {
      return [];
    }
	  	$con->close();
  } else {
    return []; 
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
            <?php if (isset($_SESSION['login']) && $_SESSION['login']== true){  ?>
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
function cal_row($time,$subs){
  $days['1'] ="";
  $days['2'] ="";
  $days['3'] = "";
  $days['4'] ="";
  $days['5']="";
  $t = intval(str_replace(':',"",$time));
  foreach($subs  as $sub){
     $start = intval(str_replace(':',"",$sub['start']));
     $end = intval(str_replace(':',"",$sub['end']));
     if (isset($_SESSION['login']) && $_SESSION['login']== true){
      if ($start <= $t  && $end > $t && is_fav($sub['id'])  ){
            if($days[$sub['day']] == ""){
              $days[$sub['day']] .= $sub['name'];
            } else {
              $days[$sub['day']] .= ", " . $sub['name'];
            }
      }
     } else{
     
      if ($start <= $t  && $end > $t){
            if($days[$sub['day']] == ""){
              $days[$sub['day']] .= $sub['name'];
            } else {
              $days[$sub['day']] .= ", " . $sub['name'];
            }
      }
    }
    
  }
  echo '<tr class="text-center">';
  echo  '<td class="info lead text-center">'.$time.'</td>';
 /* for($i = 1; i < 6; $i+= 1){
     echo  '<td class="text-center danger">'.$days[$i].'</td>';
  }         */
  if ($days['1'] == ""){
    echo  '<td class="text-center success"></td>';
  }else {
    echo  '<td class="text-center danger">'.$days['1'].'</td>';
  }
  if ($days['2'] == ""){
    echo  '<td class="text-center success"></td>';
  }else {
    echo  '<td class="text-center danger">'.$days['2'].'</td>';
  }
  if ($days['3'] == ""){
    echo  '<td class="text-center success"></td>';
  }else {
    echo  '<td class="text-center danger">'.$days['3'].'</td>';
  }
  if ($days['4'] == ""){
    echo  '<td class="text-center success"></td>';
  }else {
    echo  '<td class="text-center danger">'.$days['4'].'</td>';
  }
  if ($days['5'] == ""){
    echo  '<td class="text-center success"></td>';
  }else {
    echo  '<td class="text-center danger">'.$days['5'].'</td>';
  } 
  echo '</tr>';
}
function make_table(){
   $subs = get_all_subjects();
   $times = ["8:10","9:00","9:50","10:40","11:30","12:20","13:10","14:00","14:50","15:40","16:30","17:20","18:10","19:00"];
    foreach ($times as $i) {
     cal_row($i,$subs);
    }
}
function is_fav($sid){
  foreach ($_SESSION['fav'] as $f) {
     if ($f['sub_id'] == $sid){
      return true;
     }
  }
  return false;
}
function make_sub_list(){
  $days['1'] = "Pondelok";
  $days['2'] = "Utorok";
  $days['3'] = "Streda";
  $days['4'] = "Štvrtok";
  $days['5'] = "Piatok";
  $teachs = get_all_teachers();
  $subs = get_all_subjects();
  ?>
  <table class="table table-hover">
          <thead>
            <tr>
              <th class="text-center">Názov predmetu</th>
              <th class="text-center">Začiatok</th>
              <th class="text-center">Koniec</th>
              <th class="text-center">Deň</th>
              <th class="text-center">Učiteľ</th>
              <?php if (isset($_SESSION['login']) && $_SESSION['login']== true){ ?><th class="text-center">Moj rozvrh</th>   <?php
              } ?>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($subs as $sub) {
               echo "<tr>";
               echo '<td class="text-center">'.$sub['name'].'</td>';
               echo '<td class="text-center">'.$sub['start'].'</td>';
               echo '<td class="text-center">'.$sub['end'].'</td>';
               echo '<td class="text-center">'.$days[$sub['day']].'</td>';
               echo '<td class="text-center">'.$teachs[$sub['teacher_id']]['name'].'</td>';
               if (isset($_SESSION['login']) && $_SESSION['login']== true){
                 if (is_fav($sub['id'])){
                   echo '<td class="text-center"><a href="index.php?del='.$sub['id'].'"><span class="glyphicon glyphicon-star" style="color:yellow"></span></a></td>';
                 } else {
                   echo '<td class="text-center"><a href="index.php?add='.$sub['id'].'"><span class="glyphicon glyphicon-star-empty" style="color:yellow"></span></a></td>';
                 }
               }
               echo "</tr>";
                  
               }
            ?>
          </tbody>
  </table>
  <?php
  
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
      $_SESSION['fav'] = null;
  }
}
function register(){
   $name = test_input($_GET['name']);
   $email = test_input($_GET['email']);
   $pwd = test_input($_GET['heslo']);
   $rpwd = test_input($_GET['rheslo']);
   $_SESSION['register'] = false;
   if ($name == $_GET['name'] && $email == $_GET['email'] && $pwd == $_GET['heslo'] && $rpwd == $_GET['rheslo'] && $pwd == $rpwd){
      if (insert_user($name,$email,$pwd)) {
        $_SESSION['register'] = true;
      }
   }
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
function get_item( $ti){
 $times = ["8:10","9:00","9:50","10:40","11:30","12:20","13:10","14:00","14:50","15:40","16:30","17:20","18:10","19:00"];
 return  $times[$ti];
}

