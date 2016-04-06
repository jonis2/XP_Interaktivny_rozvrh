<?php
include('data.php');
hlavicka('Registrácia');
?>
  <div class="container">
    <section>
      <p>Registracia</p><!-- TODO REgistracia -->
	  <form method="post" id="form1">
		<label for="meno">Meno a priezvisko: </label><input type="text" name="meno" id="meno">
	    <label for="email">E-mail: </label><input type="text" name="email" id="email">
	    <label for="heslo">Heslo: </label><input type="password" name="heslo" id="heslo">
	    <input type="submit" value="Prihlásiť">
	  </form>
    </section>
    </div>  <!-- CONTAINER -->
<?php
pata();
?>                                                      