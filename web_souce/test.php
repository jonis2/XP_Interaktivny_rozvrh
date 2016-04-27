<?php
include('data.php');
hlavicka('Testy');
?>
 <div class="container">
    <section>
      <div calss="container">
        <h2> Testy<h2>
        <table class="table">
          <thead>
            <tr>
              <th>Test name</th>
              <th>Result val</th>
              <th>Expected val</th>
            </tr>
          </thead>
          <tbody>
            <?php
            test("Test OK",1,1);
            test("Test !",1,2);
            test("Get user name",get_user("admin@ir.com","admin"),"admin");
            test("Get user name wrong passwd",get_user("admin@ir.com","adminn"),"no result");
            $_GET['email'] = "admin@ir.com";
            $_GET['heslo'] = "admin";
            login();
            test("Login ",isset($_SESSION['login']),"1");
            test("Login name",$_SESSION['name'],"admin");
            test("Login email",$_SESSION['email'],"admin@ir.com");
            logout();
            test("logout session",isset($_SESSION['login']),"1");
            test("logout session",$_SESSION['login'],false);
            ?>
          </tbody>
        </table>
      </div>
    </section>
  </div>  <!-- CONTAINER -->
<?php
pata();
?>                                                      