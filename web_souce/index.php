<?php
include('data.php');
hlavicka('Rozvrh');
if (isset($_SESSION['login']) && $_SESSION['login']== true){
  user_add_del_fav();
  get_my_favs();
}
?>
 <div class="container">
 <section>
 <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th class="text-center">Čas</th>
              <th class="text-center">Pondelok</th>
              <th class="text-center">Utorok</th>
              <th class="text-center">Streda</th>
              <th class="text-center">Štvrtok</th>
              <th class="text-center">Piatok</th>
            </tr>
          </thead>
          <tbody>
            <?php
            make_table();
            ?>
          </tbody>
  </table>
  <h3>Zoznam predmetov </h3>
   <?php make_sub_list(); ?>
 </section>
 </div>  <!-- CONTAINER -->
<?php
pata();
?>                                                      