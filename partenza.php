<?php
$action = (isset($_POST['action'])) ? $_POST['action']: 'destinazione.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Partenza</title>
  </head>
  <body>
    <h1>Partenza</h1>
    <p>Scegli da dove vuoi far partire la tua merce.</p>
    <label for="address_fld">Indirizzo</label>
    <input type="search" name="address" id="address_fld" x-webkit-speech speech /> <input type="button" id="verify_btn" value="verifica" /><br />
    <div id="map_canvas" style="width:500px; height:300px"></div>
    <form method="POST" action="<?= $action ?>">
      <input type="hidden" name="hidden_data" id="hidden_fld" />
    </form>
    <script type="text/javascript">
      var request_json = "<?= str_replace('"', '\"', $_POST['hidden_data']) ?>",
          startStop = 'partenza';
    </script>
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script src="js/jquery.js"></script>
    <script src="js/partenza-destinazione.js"></script>
  </body>
</html>