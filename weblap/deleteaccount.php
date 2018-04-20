<!DOCTYPE html>
<html lang="hu">
	<?php
	  session_start();
		$id=$_SESSION["id"];

	?>
	<head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	</head>

	<body>

  <div class="container">


  <!-- Modal -->
  <div class="modal show" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Felhasználói fiók törlésének megerősítése</h4>
        </div>
        <div class="modal-body">
          <p>Biztosan törölni kívánja fiókját?</p>
          <p>Ha igen akkor az értettem négyzet kipipálása után a tovább gombra nyomással ezt megerősítheti és vissza lép a főoldalra, a négyzet kipilása nélkül vissza léphet az oldalára!</p>
        </div>
        <div class="modal-footer">
					<form action="post.php" method="get">
						Értettem<input type="checkbox" value="ertettem">
	         	<button type="submit" class="btn btn-default" data-dismiss="modal" h>Tovább</button>
					</form>
        </div>
      </div>

    </div>
  </div>

</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


</body>
</html>
