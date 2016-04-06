<?php
include('data.php');
hlavicka('Prihlásenie');
?>
 <div class="container">
    <section>
      <p>LOGIN</p><!-- TODO LOGIN-->
	  <form method="post" id="form1" class="form-horizontal" >
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
    <div class="col-sm-12">
	    <input type="submit" value="Prihlásiť">
      </div>
    </div>
	  </form>
    </section>
  </div>  <!-- CONTAINER -->
<?php
pata();
?>                                                      