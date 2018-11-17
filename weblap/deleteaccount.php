<!DOCTYPE html>
<html lang="hu">
	<?php
	if(isset($_GET['custid']))
	{
		$custid=intval($_GET['custid']);
		//var_dump($custid);
	}

	?>
	<head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	</head>

	<body background="./img/deleteaccount/deleteaccbackground.png">

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
          <p>Ha igen akkor  a tovább gombra nyomással ezt megerősítheti és vissza lép a főoldalra!</p>
        </div>
        <div class="modal-footer">
					<form action="post.php" method="post">
						<?php
						$deleteuser="yes";
						echo '<input type="hidden" name="custid" value="'.$custid.'"></input>';
						echo '<input type="hidden" name="deleteuser" value="'.$deleteuser.'"></input>';
						?>
	         	<button type="submit" class="btn btn-default" data-dismiss="modal" h>Tovább</button>
					</form>
					<form action="user.php" method="post">
						<?php
							//get data back to user.
							include "php/connect.php";
							$sql="SELECT * FROM `subscription_customers` WHERE `CustomerID` = $custid";
							$resultset = mysqli_query($mysqllink,$sql);
							$subrow=mysqli_fetch_row($resultset);
							if($subrow != NULL)
							{
								$sql="SELECT * FROM `customers` WHERE `ID` = $custid";
								$resultset = mysqli_query($mysqllink, $sql );
								$row=mysqli_fetch_row($resultset);
								if($row != NULL)
								{
									$name=$row[2]." ".$row[1];
									$telnum=$row[8];
									$email=$row[9];
									$password=$row[10];
									session_start();
									$_SESSION["name"] = $name;
									$_SESSION["email"] = $email;
									$_SESSION["password"] = $password;
									$_SESSION["id"] = $custid;
									$_SESSION["telnum"]=$telnum;
								}
							}
							//var_dump($custid);
						?>
	         	<button type="submit" class="btn btn-default" data-dismiss="modal" h>Vissza</button>
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
