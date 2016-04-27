<?php
include('data.php');
hlavicka('Prihlásenie');
?>
 <div class="container">
    <section>
     <?php if (isset($_SESSION['login']) && $_SESSION['login']== true){ ?>
     <p  class="lead"> Ste ptihlásený</p>
      <?php } else { ?>
      <h2>Prihlasovanie</h2>
	  <form id="form1" class="form-horizontal" >
    <div class="form-group">
	    <label class="control-label col-sm-2" for="email">E-mail: </label>
      <div class="col-sm-10">
      <input type="text" name="email" id="email">
      </div>
    </div>
    <div class="form-group">
	    <label class="control-label col-sm-2" for="heslo">Heslo: </label>
      <div class="col-sm-10">
      <input type="password" name="heslo" id="heslo">
      </div>
    </div>
    <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
	    <input type="submit" name="log" value="Prihlásiť">
      </div>
    </div>
	  </form>
     <?php }?>
    </section>
  </div>  <!-- CONTAINER -->
<?php
pata();
?>                                                      