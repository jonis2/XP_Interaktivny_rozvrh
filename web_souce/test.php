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
            test("logout session isset",isset($_SESSION['login']),"1");
            test("logout session false",$_SESSION['login'],false);
            test("isert user",insert_user("test","tes@test.test","testh"),true);
            $_GET['email'] = "tes@test.test";
            $_GET['heslo'] = "testh";
            login();
            test("Login new user",$_SESSION['login'],true);
            test("Login new user name",$_SESSION['name'],"test");
            test("Login new user email",$_SESSION['email'],"tes@test.test");
            test("get item 0",get_item(0),"8:10");
            test("teachers",get_all_teachers()['test'],null);
            $_GET['add'] = "1";
            user_add_del_fav();
            get_my_favs();
            test("fav add",is_fav(1),true);
            $_GET['del'] = "1";
            user_add_del_fav();
            get_my_favs();
            test("fav del",is_fav(1),false);
            //test("get subjects",get_all_subjects()[0][0],"8:10");

            ?>
          </tbody>
        </table>
      </div>
    </section>
  </div>  <!-- CONTAINER -->
<?php
pata();
?>                                                      