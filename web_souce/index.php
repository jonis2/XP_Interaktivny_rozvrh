<?php
include('data.php');
hlavicka('Rozvrh');
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
 </section>
 </div>  <!-- CONTAINER -->
<?php
pata();
?>                                                      