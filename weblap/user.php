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
        $datefrom=$_SESSION["datefrom"];
        $dateto=$_SESSION["dateto"];
        $szerzodott=$_SESSION["szerzodott"];

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
							<a class="subheader red-text ">Felhasználói adatok</a>
						</li>
						<li>
							<a href="#!" class = "waves-effect"><i class="material-icons">person_add</i>Hozzáadás</a>
						</li>
						<li>
							<div class="divider"></div>
						</li>
						<li>
							<a href="#!" class = "waves-effect"><i class="material-icons">edit</i>Hűségidő Módosítása</a>
						</li>
						<li>
							<div class="divider"></div>
						</li>
						<li>
							<a href="#!" class = "waves-effect"><i class="material-icons">delete</i>Fiók Törlése</a>
						</li>

						<!--OPERATIONS WITH SERVICES-->
						<li>
							<a class="subheader red-text">Műveletek csomagokkal</a>
						</li>
						<li>
							<div class="divider"></div>
						</li>
						<li>
							<a href="#!" class = "waves-effect"><i class="material-icons">playlist_add</i>Hosszabbítás</a>
						</li>
						<li>
							<div class="divider"></div>
						</li>
						<li>
							<a href="#!" class = "waves-effect"><i class="material-icons">edit</i>Módosítás</a>
						</li>

						<!--OTHER-->
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
			<table id="sub" class=" bordered centered">
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
			<table class="bordered centered">
				<thead>
				  <tr>
					  <th>Hűségidő kezdete</th>
					  <th>Hűségidő vége</th>
					  <th>Van-e még szerződése</th>
				  </tr>
				</thead>

				<tbody>
          <?php
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

      <!--Sub update-->
          <div id="updatesub" class="col s12">
      			<table class="bordered centered">
      				<thead>
      				  <tr>
      					  <th>Internet</th>
      					  <th>Telefon</th>
      					  <th>TV</th>
      				  </tr>

      				</thead>

      				<tbody>
                  <form action="post.php" method="post">
                  <tr>
                    <td>
                      <div class="input-field blue-text col s12">

                        <?php
                          echo '<select>';
                          $host="localhost";
                          $user="plidrendszer";
                          $pass="projektlab";
                          $db="plidrendszer";
                          $conn = new mysqli($host,$user,$pass,$db)
                          or die ('Cannot connect to db');
                          mysqli_set_charset($conn,"utf8");
                          $result = $conn->query("SELECT `NetID` , `Name`, `oneyear_price`, `twoyear_price` FROM `InternetPacks` WHERE `Name`  NOT LIKE '$internetname'");
                          echo '<option value="">Jelenlegi Internet csomagja: '.$internetname.' Ára: '.$internetprice.' </option>';
                          while ($subrow = $result->fetch_assoc())
                          {
                            unset($packid, $packname,$oneyearprice,$twoyearprice);
                            $packid= $subrow['NetID'];
                            $packname = $subrow['Name'];
                            $oneyearprice = $subrow['oneyear_price'];
                            $twoyearprice = $subrow['twoyear_price'];
                            if($subtime=1)
                            {
                              echo '<option value="'.$packid.'">'.$packname.'" Ára egy évre: "'.$oneyearprice.'</option>';
                            }
                            elseif($subtime = 2)
                            {
                              echo '<option value="'.$packid.'">'.$packname.'" Ára két évre: "'.$twoyearprice.'</option>';
                            }
                            else
                            {
                              echo '<option value="'.$packid.'">'.$packname.'" Árak(1,2 évre): "'.$oneyearprice.','.$twoyearprice.'</option>';
                            }

                          }
                          echo '</select>';
                        ?>

                      </div>
                  </td>
                  <td>
                    <div class="input-field col s12">

                      <?php
                        echo '<select>';
                        $host="localhost";
                        $user="plidrendszer";
                        $pass="projektlab";
                        $db="plidrendszer";
                        $conn = new mysqli($host,$user,$pass,$db)
                        or die ('Cannot connect to db');
                        mysqli_set_charset($conn,"utf8");
                        $result = $conn->query("SELECT `TelPackID`,`Name` FROM `TelPacks` WHERE `Name`  NOT LIKE '$telname'");
                        echo '<option value="">Jelenlegi Telefon csomagja: '.$telname.' Ára: '.$telprice.' </option>';
                        while ($subrow = $result->fetch_assoc())
                        {
                          unset($packid, $packname);
                          $packid= $subrow['TelPackID'];
                          $packname = $subrow['Name'];
                          echo '<option value="'.$packid.'">'.$packname.'</option>';

                        }
                        echo '</select>';
                      ?>
                    </div>
                  </td>
                  <td>
                    <div class="input-field col s12">

                      <?php
                        echo '<select>';
                        $host="localhost";
                        $user="plidrendszer";
                        $pass="projektlab";
                        $db="plidrendszer";
                        $conn = new mysqli($host,$user,$pass,$db)
                        or die ('Cannot connect to db');
                        mysqli_set_charset($conn,"utf8");
                        $result = $conn->query("SELECT `TVID`, `Name`, `oneyear_price`, `twoyear_price`  FROM `TVPacks` WHERE `Name`  NOT LIKE '$tvname'");
                        echo '<option value="">Jelenlegi TV csomagja: '.$tvname.' Ára: '.$tvprice.' </option>';
                        while ($subrow = $result->fetch_assoc())
                        {
                          unset($packid, $packname);
                          $packid= $subrow['TVID'];
                          $packname = $subrow['Name'];
                          $oneyearprice = $subrow['oneyear_price'];
                          $twoyearprice = $subrow['twoyear_price'];
                          if($subtime=1)
                          {
                            echo '<option value="'.$packid.'">'.$packname.'" Ára egy évre: "'.$oneyearprice.'</option>';
                          }
                          elseif($subtime = 2)
                          {
                            echo '<option value="'.$packid.'">'.$packname.'" Ára két évre: "'.$twoyearprice.'</option>';
                          }
                          else
                          {
                            echo '<option value="'.$packid.'">'.$packname.'" Árak(1,2 évre): "'.$oneyearprice.','.$twoyearprice.'</option>';
                          }


                        }
                        echo '</select>';
                        echo '<input type="hidden" name="custid" value="'.$id.'"></input>';
                      ?>
                    </div>
                  </td>

                </tr>
                <tr>
                  <td>
                    <div class="input-field col s12">
                      <input type="text" name="Internetupdate" size="30" />
                    </div>
                  </td>
                  <td>
                    <div class="input-field col s12">
                      <input type="text" name="Telefonupdate" size="30" />
                    </div>
                  </td>
                  <td>
                    <div class="input-field col s12">
                      <input type="text" name="TVupdate" size="30" />
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                  </td>
                  <td>

                    <button class="btn btn-large blue" type="submit" value="Regisztáció" class="waves-effect waves-light btn center">Módosítás</button>
                  </td>
                  <td>
                  </td>
                </tr>
              </form>
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
      <!-- SELECT SCRIPT -->
      <script>
         $(document).ready(function() {
            $('select').material_select();
        });
      </script>
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
