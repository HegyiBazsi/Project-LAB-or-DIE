<!DOCTYPE html>
  <html lang="hu">
    <?php
      session_start();
        $name=$_SESSION["name"];
        $email=$_SESSION["email"];
        $id=$_SESSION["id"];
        $internetname=$_SESSION["internetname"];
        $telname=$_SESSION["telname"];
        $tvname=$_SESSION["tvname"];
        $internetprice=$_SESSION["internetprice"];
        $telprice=$_SESSION["telprice"];
        $tvprice=$_SESSION["tvprice"];
        $summonthly=$_SESSION["summonthly"];

    ?>
    <head>
    <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

      <link rel="icon" href="./img/admin/admin2.png">
	  <link href="css/user.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>

    <body>
	<main>
	<nav class="navbar-fixed-top">
       	<div class="nav-wrapper">
       		<a href="#!" class="brand-logo center white-text">P-LID</a>
			<nav class="blue" role="navigation">
				<div class="nav-wrapper container">
				<!--SIDE BAR-->
					<ul id="slide-out" class="side-nav">
       					<li>
							<div class="user-view">
								<div class="background">
									<img src="img/admin/back.jpg">
								</div>
								<a><img class="circle" src="img/admin/admin.jpg"></a>
								<?php
                  echo '<a><span class="white-text">'.$name.'</span></a>';
  					      echo '<a><span class="white-text">'.$email.'</span></a>';
                ?>
							</div>
						</li>
						<!--USER SIDEBAR-->
						<li>
							<a class="subheader red-text ">Felhasználói adatok módosítása</a>
						</li>
						<li>
							<a href="#!" class = "waves-effect"><i class="material-icons">person_add</i>Hozzáadás</a>
						</li>
						<li>
							<div class="divider"></div>
						</li>
						<li>
							<a href="deleteaccount.php" class = "waves-effect"><i class="material-icons">delete</i>Fiók Törlése</a>
						</li>

						<!--OPERATIONS WITH SERVICES-->
						<li>
							<a class="subheader red-text">Egyéb funkciók</a>
						</li>
						<li>
							<div class="divider"></div>
						</li>
						<li>
							<a href="#!" class = "waves-effect"><i class="material-icons">edit</i>Módosítás</a>
						</li>
						<li>
							<div class="divider"></div>
						</li>
						<li>
							<a href="index.html" class = "waves-effect"><i class="material-icons">exit_to_app</i>Kilépés</a>
						</li>
						<li>
							<div class="divider"></div>
						</li>

       				</ul>
       				<a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons white-text">menu</i></a>
       			</div>     <!--END OF SIDEBAR-->
       		</nav>
       	</div>     <!--END OF NAW WRAPPER-->
    </nav>
  </br>

	<div class="container">

        <!-- TABS -->
        <div class="row">
			<div class="col s12">
				<ul class="tabs">
					<li class="tab col m3">
						<a href="#sub">Előfizetésem</a>

					</li>
					<li class="tab col m3">
						<a href="#price">Havi összeg</a>
					</li>
					<li class="tab col  m3">
						<a href="#subtime">Hűségidő</a>
					</li>
          <li class="tab col  m3">
						<a href="#updatesub">Előfizetés módosítás</a>
					</li>
				</ul>
			</div>

<!--Subscription tab-->
    <div class="col s12">
			<table id="sub" class="centered">
				<thead>
					<tr>
						<th>Internet csomag</th>
						<th>Telefon csomag</th>
            <th>Tv csomag</th>
					</tr>

				</thead>

				<tbody>
					<tr>
            <?php
              echo '<td>'.$internetname.'</td>';
              echo '<td>'.$telname.'</td>';
              echo '<td>'.$tvname.'</td>';
            ?>
					</tr>
          <tr>
            <form class="" action="post.php" method="post">
              <!--https://www.sitepoint.com/community/t/populate-dropdown-menu-from-mysql-database/6481/7-->
            </form>
          </tr>
				</tbody>
			</table>
		</div>

<!--Price-->
      <div id="price" class="col s12">
			<table class="bordered centered">
				<thead>
				  <tr>
					  <th>Internet</th>
            <th>Telefon</th>
            <th>TV</th>
            <th>Összegzett havidíj</th>
				  </tr>
				</thead>

				<tbody>
				  <tr>
           <?php


                echo '<td>'.$internetprice.'</td>';
                echo '<td>'.$telprice.'</td>';
                echo '<td>'.$tvprice.'</td>';
                echo '<td>'.$summonthly.'</td>';
            ?>
				  </tr>
				</tbody>
			</table>
		  </div>

<!--Husegido datuma és hosszabitas-->
    <div id="subtime" class="col s12">
			<table class="striped centered">
				<thead>
				  <tr>
					  <th>Hűségidő kezdete</th>
					  <th>Hűségidő vége</th>
					  <th>Van-e még szerződése</th>
				  </tr>
				</thead>

				<tbody>
          <?php
             include "php/connect.php";
             $sql="SELECT * FROM `Subscription_Customers` WHERE `CustomerID` = $id";
             $resultset = mysqli_query($mysqllink, $sql ) or die("no result: ".mysqli_error($mysqllink));
             $subrow=mysqli_fetch_row($resultset);
             if($subrow != NULL)
             {
               $datefrom=$subrow[2];
               $subtime=$subrow[3];
               $dateto=date('Y-m-d', strtotime($datefrom. "+$subtime years"));
               $currdate=date('Y-m-d');
               if($currdate<$dateto)
               {
                 $szerzodott="még szerződött";
               }
               else {
                 $szerzodott="nincs szerződése";
               }
             }
             echo '<td>'.$datefrom.'</td>';
             echo '<td>'.$dateto.'</td>';
             echo '<td>'.$szerzodott.'</td>';

          ?>
          <tr>
            <td></td>
          </tr>
				</tbody>
			</table>
		  </div>

      <!--TEST 3 - TV-->
          <div id="updatesub" class="col s12">
      			<table class="striped centered">
      				<thead>
      				  <tr>
      					  <th>Name</th>
      					  <th>Item Name</th>
      					  <th>Item Price</th>
      				  </tr>

      				</thead>

      				<tbody>
      				  <tr>
      					<td>Alvin</td>
      					<td>Eclair</td>
      					<td>$0.87</td>
      				  </tr>
      				  <tr>
      					<td>Alan</td>
      					<td>Jellybean</td>
      					<td>$3.76</td>
      				  </tr>
      				  <tr>
      					<td>Jonathan</td>
      					<td>Lollipop</td>
      					<td>$7.00</td>
      				  </tr>
      				</tbody>
      			</table>
      		  </div>
  </div><!--ROW-->


      </div><!-- ./container -->
		</main>
      <!--FOOTER-->
        <footer class="page-footer blue">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Kapcsolat</h5>
              </div>
            </div>
            <i class="material-icons">room</i> Cím: 8200, Veszprém Egyetem utca 2.
            <br>
            <i class="material-icons">mail_outline</i> E-mail: info@plid.com
            <br>
            <i class="material-icons">call</i> Telefon: 06-10-123-4567
            <br>
            <i class="material-icons">alarm</i> Nyitvatartás: H-P 8-12 / 13-17
          </div>
          <br>
          <div class="footer-copyright">
            <div class="container">
              Made by <a class="black-text text-lighten-4">Projekt Lab or Die</a>
            </div>
          </div>
        </footer>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
		<script src="js/admin.js"></script>
    <!--MODAL SCRIPT-->
     <script type="text/javascript">
     $('.modal').modal
    (
        {
         dismissible: true, // Modal can be dismissed by clicking outside of the modal
         opacity: .5, // Opacity of modal background
         inDuration: 300, // Transition in duration
         outDuration: 200, // Transition out duration
         startingTop: '4%', // Starting top style attribute
         endingTop: '10%', // Ending top style attribute
		}
	);
	</script>
    </body>
  </html>
