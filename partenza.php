<!DOCTYPE html>
<html>
  <head>
    <title>Benvenuto</title>
  </head>
  <body>
    <h1>Partenza</h1>
    <p>Scegli da dove vuoi far partire la tua merce.</p>
    <label for="address_fld">Indirizzo</label>
    <input type="search" name="address" id="address_fld" x-webkit-speech speech /> <input type="button" id="verify_btn" value="verifica" /><br />
    <div id="map_canvas" style="width:500px; height:300px"></div>
    <form method="POST" action="partenza.php">
      <input type="hidden" name="hidden_data" id="hidden_fld" />
    </form>
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src="js/jquery.js"></script>
    <script src="js/partenza.js"></script>
  </body>
</html>