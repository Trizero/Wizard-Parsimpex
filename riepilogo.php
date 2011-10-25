<?php
$request_json = utf8_encode($_POST['hidden_data']);
$request = json_decode($request_json);

$partenza = $request->partenza->formatted_address;
$destinazione = $request->destinazione->formatted_address;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Riepilogo</title>
  </head>
  <body>
    <h1>Riepilogo</h1>
    <p>Questi sono i dati che hai inserito.</p>
    <form method="POST" action="partenza.php">
      <span><b>Partenza:</b> <?= $partenza ?>
      <input type="submit" value="Modifica" />
      <input type="hidden" name="hidden_data" class="hidden_fld" />
      <input type="hidden" name="action" value="riepilogo.php" />
    </form>
    <form method="POST" action="destinazione.php">
      <b>Destinazione:</b> <?= $destinazione ?>
      <input type="submit" value="Modifica" />
      <input type="hidden" name="hidden_data" class="hidden_fld" />
      <input type="hidden" name="action" value="riepilogo.php" />
    </form>
    <script src="js/jquery.js"></script>
    <script type="text/javascript">
      (function(){
        $(function(){
          var request_json = "<?= str_replace('"', '\"', $_POST['hidden_data']) ?>";
          $('.hidden_fld').val(request_json);
        });
      })(this);
    </script>
  </body>
</html>