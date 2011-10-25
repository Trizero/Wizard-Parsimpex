<?php
$action = (isset($_POST['action'])) ? $_POST['action']: 'riepilogo.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Destinazione</title>
  </head>
  <body>
    <h1>Destinazione</h1>
    <p>Scegli dove vuoi far arrivare la tua merce.</p>
    <label for="address_fld">Indirizzo</label>
    <input type="search" name="address" id="address_fld" x-webkit-speech speech /> <input type="button" id="verify_btn" value="verifica" /><br />
    <div id="map_canvas" style="width:500px; height:300px"></div>
    <form method="POST" action="<?= $action ?>">
      <input type="hidden" name="hidden_data" id="hidden_fld" />
    </form>
    <script type="text/javascript">
      var request_json = "<?= str_replace('"', '\"', $_POST['hidden_data']) ?>",
          startStop = 'destinazione';
    </script>
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src="js/jquery.js"></script>
    <script src="js/partenza-destinazione.js"></script>
  </body>
</html>