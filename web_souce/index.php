<?php
include('data.php');
hlavicka('Rozvrh');
?>
<script>
function Klik() {
  if (document.getElementById('polozka').value != "")
	  window.alert('Nastala zmena vo formulári: ' + document.getElementById('polozka').value);
}
</script>
 <div class="container">
    <section>
      <p>ROZVRH VYHLADANIE</p><!-- TODO VYHLADAVANIE A ROZVRH -->
	  <label for="polozka">Hľadať: </label><input type="text" name="polozka" id="polozka" onkeyup="Klik()">
    </section>
  </div>  <!-- CONTAINER -->
<?php
pata();
?>                                                      