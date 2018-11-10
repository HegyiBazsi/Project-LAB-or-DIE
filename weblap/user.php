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
	//var_dump($telname);
	//var_dump($tvname);
	//var_dump($tvprice);

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
						<div class="divider"></div>
					</li>
					<li>
						<a href="deleteaccount.php?custid=<?php echo $id ?>" class = "waves-effect"><i class="material-icons">delete</i>Fiók Törlése</a>
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
					</div>
				<!--END OF SIDEBAR-->
				</nav>
			</div>
			<!--END OF NAW WRAPPER-->
		</nav>
		</br>

		<div class="container">

		<!-- TABS -->
		<div class="row">
			<div class="col s12">
				<ul class="tabs z-depth">
					<li class="tab col m2">
						<a href="#sub">Előfizetésem</a>
					</li>
					<li class="tab col m2">
						<a href="#price">Havi összeg</a>
					</li>
					<li class="tab col m2">
						<a href="#subtime">Hűségidő</a>
					</li>
					<li class="tab col m2">
						<a href="#updatesub">Előfizetés módosítás</a>
					</li>
					<li class="tab col m3">
						<a href="#updateuser">Felhasználóiadatok módosítása</a>
					</li>
				</ul>
			</div>
			<!-- END OF TAB NAMES ROW -->

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
			<!--END OF SUB TABS -->

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
			<!-- END OF PRICE TAB -->

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
					</tbody>
				</table>
			</div>
			<!-- END OF SUBTIME -->

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
					<form action="userupdate.php" method="post">
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
												echo '<option value="'.$packid.'">'.$packname.' Ára egy évre: '.$oneyearprice.'</option>';
											}
											elseif($subtime = 2)
											{
												echo '<option value="'.$packid.'">'.$packname.' Ára két évre: '.$twoyearprice.'</option>';
											}
											else
											{
												echo '<option value="'.$packid.'">'.$packname.' Árak(1,2 évre): '.$oneyearprice.','.$twoyearprice.'</option>';
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
												echo '<option value="'.$packid.'">'.$packname.' Ára egy évre: '.$oneyearprice.'</option>';
											}
											elseif($subtime = 2)
											{
												echo '<option value="'.$packid.'">'.$packname.' Ára két évre: '.$twoyearprice.'</option>';
											}
											else
											{
												echo '<option value="'.$packid.'">'.$packname.' Árak(1,2 évre): '.$oneyearprice.','.$twoyearprice.'</option>';
											}
										}
										echo '</select>';
										$sourcesite="user";
										$packupdate="yes";
										echo '<input type="hidden" name="custid" value="'.$id.'"></input>';
										echo '<input type="hidden" name="sourcesite" value="'.$sourcesite.'"></input>';
										echo '<input type="hidden" name="packupdate" value="'.$packupdate.'"></input>';
									?>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="input-field col s12">
									<input type="text" name="Internetupdate" size="30" />
									<label>Internet csomag neve pontosan</label>
								</div>
							</td>
							<td>
								<div class="input-field col s12">
									<input type="text" name="Telefonupdate" size="30" />
									<label>Telefon csomag neve pontosan</label>
								</div>
							</td>
							<td>
								<div class="input-field col s12">
									<input type="text" name="TVupdate" size="30" />
									<label>Televízió csomag neve pontosan</label>
								</div>
							</td>
						</tr>
						<tr>
							<td>
							</td>
							<td>
								<button class="btn btn-large blue" type="submit" value="Módosítás" class="waves-effect waves-light btn center">Módosítás</button>
							</td>
							<td>
							</td>
						</tr>
					</form>
				</tbody>
			</table>
			</div>
			<!-- END OF SUB UPDATE -->
			<!-- USER UPDATE -->
			<div id="updateuser" class="col s12">
				<table class="bordered centered">
					<thead>
						<form action="userupdate.php" method="post">
							<tr>
								<td style="text-align: right;">
									<p>Lakcím módusulás esetén kérem keresse fel</p>
								</td>
								<td>
									<p>az ügyfélszolgálatunkat telefonon vagy személyesen.</p>
								</td>
								<td>
								</td>
							</tr>
							<tr>
								<td>
									<div class="input-field col s12">
										<input type="text" name="lnameupdate" size="30" />
										<label>Új Vezetéknév</label>
									</div>
								</td>
								<td>
								</td>
								<td>
									<div class="input-field col s12">
										<input type="text" name="fnameupdate" size="30" />
										<label>Új Keresztnév</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="input-field col s12">
										<input type="text" name="emailupdate" size="30" />
										<label>Új email cím</label>
									</div>
								</td>
								<td>
								</td>
								<td>
									<div class="input-field col s12">
										<input type="text" name="telnumupdate" size="30" />
										<label>Új telefonszám (+36xx... formában)</label>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="input-field col s12">
										<input type="text" name="passwordupdate" size="30" />
										<label>Új jelszó</label>
									</div>
								</td>
								<td>
								</td>
								<td>
									<div class="input-field col s12">
										<input type="text" name="passwordupdatecheck" size="30" />
										<label>Új jelszó megerősítése</label>
									</div>
								</td>

							</tr>
							<?php
								$sourcesite="user";
								$userupdate="userupdate";
								echo '<input type="hidden" name="custid" value="'.$id.'"></input>';
								echo '<input type="hidden" name="sourcesite" value="'.$sourcesite.'"></input>';
								echo '<input type="hidden" name="userupdate" value="'.$userupdate.'"></input>';
							?>
							<tr>
								<td>
								</td>
								<td style="text-align: center;">
									<button class="btn btn-large blue" type="submit" value="Módosítás" class="waves-effect waves-light btn center">Módosítás</button>
								</td>
								<td>
								</td>
							</tr>
						</form>
					</thead>
				</table>

			</div>
			<!-- END OF USER UPDATE -->
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
			$(document).ready(function()
				{
					$('select').material_select();
				}
			);
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
