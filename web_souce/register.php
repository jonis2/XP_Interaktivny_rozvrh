<?php
include('data.php');
hlavicka('Registrácia');
?>
  <div class="container">
    <section>
      <h2>Registracia</h2>
	  <form method="post" id="form1" class="form-horizontal" >
    <div class="form-group">
	    <label class="control-label col-sm-2" for="email">E-mail: </label>
      <div class="col-sm-10">
      <input type="email" name="email" id="email">
      </div>
    </div>
    <div class="form-group">
	    <label class="control-label col-sm-2" for="name">Meno: </label>
      <div class="col-sm-10">
      <input type="text" name="name" id="name">
      </div>
    </div>
    <div class="form-group">
	    <label class="control-label col-sm-2" for="heslo">Heslo: </label>
      <div class="col-sm-10">
      <input type="password" name="heslo" id="heslo">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="rheslo">Heslo - znovu: </label>
        <div class="col-sm-10">
        <input type="password" name="rheslo" id="rheslo">
        </div>
      </div>
    <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
	    <input type="submit" name="reg" value="Rigistrovať">
      </div>
    </div>
	  </form>
    </section>
    </div>  <!-- CONTAINER -->
<?php
pata();
?>                                                      