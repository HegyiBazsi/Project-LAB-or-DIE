
<!DOCTYPE html>
<html lang="hu">
  <?php
    session_start();
    $workerid=$_SESSION["workerid"];
    $position=$_SESSION["position"];
    $name=$_SESSION["name"];
    $email=$_SESSION["email"];
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

    <nav class="navbar-fixed-top">
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo center white-text">P-LID</a>
      <nav class="red" role="navigation">
      <div class="nav-wrapper container">
        <!--SIDE BAR-->
        <ul id="slide-out" class="side-nav">
          <li>
            <div class="user-view">
            <div class="background">
              <img src="img/admin/back.jpg">
            </div>
            <a href="#!user"><img class="circle" src="img/admin/admin.jpg"></a>
            <?php
              echo '<a><span class="white-text">'.$name.'</span></a>';
              echo '<a><span class="white-text">'.$email.'</span></a>';
            ?>
            </div>
          </li>
          <!--OTHER-->
          <li>
            <div class="divider"></div>
          </li>
          <li>
            <a href="worker_login.html" class = "waves-effect"><i class="material-icons">exit_to_app</i>Kilépés</a>
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

    <div class="container">
    <!-- TABS 1 NET TV TEL -->
    <div class="row">
      <div class="col s12">
				<ul class="tabs z-depth">
          <li class="tab col m3">
            <a href="#net">Internet Csomagok</a>
          </li>
          <li class="tab col m3">
            <a href="#tv">Televízió csomagok</a>
          </li>
          <li class="tab col  m2">
            <a href="#tel">Telefon csomagok</a>
          </li>
          <li class="tab col m2">
            <a href="#customers">Ügyfelek</a>
          </li>
          <li class="tab col m2">
            <a href="#subs">Szerződések</a>
          </li>
        </ul>
      </div>
      <!-- END OF TAB NAMES ROW -->

    <!--INTERNET TAB CONTENT-->
    <div id="net" class="col s12">
      <table class="striped centered">
        <thead>
        <tr>
          <th>Csomagazonosító</th>
          <th>Csomagnév</th>
          <th>Letöltési sebesség</th>
          <th>Feltöltési sebesség</th>
          <th>Egyéves Ár</th>
          <th>Kétéves Ár</th>
        </tr>
        </thead>
        <tbody>
          <?php
            $host="localhost";
            $user="plidrendszer";
            $pass="projektlab";
            $db="plidrendszer";
            $conn = new mysqli($host,$user,$pass,$db)
            or die ('Cannot connect to db');
            mysqli_set_charset($conn,"utf8");
            $result = $conn->query("SELECT `NetID`,`Name`, `DownSpeed`, `UpSpeed`, `oneyear_price`, `twoyear_price` FROM `internetpacks` WHERE 1");
            while ($subrow = $result->fetch_assoc())
            {
              $packid = $subrow['NetID'];
              $packname = $subrow['Name'];
              $downspeed = $subrow['DownSpeed'];
              $upspeed = $subrow['UpSpeed'];
              $oneyearprice= $subrow['oneyear_price'];
              $twoyearprice= $subrow['twoyear_price'];
              echo '<tr>';
                echo '<td>'.$packid.'</td>';
                echo '<td>'.$packname.'</td>';
                echo '<td>'.$downspeed.'</td>';
                echo '<td>'.$upspeed.'</td>';
                echo '<td>'.$oneyearprice.'</td>';
                echo '<td>'.$twoyearprice.'</td>';
              echo '</tr>';
            }
          ?>
          <tr>
            <form class="" action="admin.php" method="post">
              <!-- PACK UPDATE FORM -->
                  <!--form first row -->
                  <div class="row">
                  <table>
                    <tbody>
                      <tr>
                        <td>
                          <p>*Csillaggal jelölt mező kitöltése kötelező,</p>
                        </td>
                        <td>
                          <p>új csomag felviteléhez az azonosítón kívül</p>
                        </td>
                        <td>
                          <p>minden adatot adjon meg</p>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="input-field col s12">
                            <input type="text" name="packid" size="30" />
                            <label>Módosítandó NET csomag azonosítója*</label>
                          <div>
                        </td>
                        <td>
                        </td>
                        <td>
                          <div class="input-field col s12">
                            <input type="text" name="packname" size="30" />
                            <label>új neve</label>
                          </div>
                        </td>
                      </tr>
                      <!--form second row -->
                      <tr>
                        <td>
                          <div class="input-field col s12">
                            <input type="text" name="downspeed" size="30" />
                            <label>új letöltési sebessége</label>
                          </div>
                        </td>
                        <td>
                        </td>
                        <td>
                          <div class="input-field col s12">
                            <input type="text" name="upspeed" size="30" />
                            <label>új feltöltési sebessége</label>
                          </div>
                        </td>
                      </tr>
                      <!--form third row -->
                      <tr>
                        <td>
                          <div class="input-field col s12">
                            <input type="text" name="oneyearprice" size="30" />
                            <label>új egy éves ára</label>
                          </div>
                        </td>
                        <td>
                        </td>
                        <td>
                          <div class="input-field col s12">
                            <input type="text" name="twoyearprice" size="30" />
                            <label>új két éves ára</label>
                          </div>
                        </td>
                      </tr>
                    </div>
                      <tr>
                        <td>
                        </td>
                        <td>
                          <div class="row">
                            <div class="col s1 offset-s1" >
                              <button class="btn btn-large blue" type="submit" value="Módosítás" class="waves-effect waves-light btn center">Módosítás</button>
                            </div>
                          </div>
                        </td>
                        <td>
                        </td>
                      </tr>
                      <?php
                        $netupdate="yes";
                        echo '<input type="hidden" name="custid" value="'.$workerid.'"></input>';
                        echo '<input type="hidden" name="position" value="'.$position.'"></input>';
                        echo '<input type="hidden" name="name" value="'.$name.'"></input>';
                        echo '<input type="hidden" name="email" value="'.$email.'"></input>';
                        echo '<input type="hidden" name="tvupdate" value="'.$netupdate.'"></input>';
                      ?>
                    </tbody>
                  </table>
            </form>
            <!-- END OF NET UPDATE FORM -->
          </tr>
        </tbody>
      </table>
    </div>
    <!-- END OF INTERNET TAB -->
    <!--TV-->
    <div id="tv" class="col s12">
    <table class="striped centered">
    <thead>
    <tr>
      <th>Csomag azonosító</th>
      <th>Csomagnév</th>
      <th>Csatornák száma</th>
      <th>HD csatornák száma</th>
      <th>Rádió adók száma</th>
      <th>HBO csomag</th>
      <th>Amazon csomag</th>
      <th>Netflix csomag</th>
      <th>Egyéves Ár</th>
      <th>Kétéves Ár</th>
    </tr>
    </thead>
    <!-- TV CSOMAGOK LISTÁZÁSA-->
    <tbody>
      <?php
        $host="localhost";
        $user="plidrendszer";
        $pass="projektlab";
        $db="plidrendszer";
        $conn = new mysqli($host,$user,$pass,$db)
        or die ('Cannot connect to db');
        mysqli_set_charset($conn,"utf8");
        $result = $conn->query("SELECT `TVID`, `Name`, `ChannelNUM`, `HDChannelNUM`, `Radio_stations`, `HBO_Pack`, `Amazon_PRIME`, `NETFLIX`, `oneyear_price`, `twoyear_price` FROM `tvpacks` WHERE 1");
        while ($subrow = $result->fetch_assoc())
        {
          $packid = $subrow['TVID'];
          $packname = $subrow['Name'];
          $chnum = $subrow['ChannelNUM'];
          $hdnum = $subrow['HDChannelNUM'];
          $radio = $subrow['Radio_stations'];
          $hbo = $subrow['HBO_Pack'];
          $amazon = $subrow['Amazon_PRIME'];
          $netflix = $subrow['NETFLIX'];
          $oneyearprice= $subrow['oneyear_price'];
          $twoyearprice= $subrow['twoyear_price'];
          echo '<tr>';
            echo '<td>'.$packid.'</td>';
            echo '<td>'.$packname.'</td>';
            echo '<td>'.$chnum.'</td>';
            echo '<td>'.$hdnum.'</td>';
            echo '<td>'.$radio.'</td>';
            if($hbo==0)
            {
              echo '<td>nem</td>';
            }
            else
            {
              echo '<td>igen</td>';
            }
            if($amazon==0)
            {
              echo '<td>nem</td>';
            }
            else
            {
              echo '<td>igen</td>';
            }
            if($netflix==0)
            {
              echo '<td>nem</td>';
            }
            else
            {
              echo '<td>igen</td>';
            }
            echo '<td>'.$oneyearprice.'</td>';
            echo '<td>'.$twoyearprice.'</td>';
          echo '</tr>';
        }
      ?>
      <!-- PACK UPDATE FORM -->
        <form action="adminpost.php" method="post">
          <!--form first row -->
          <div class="row">
          <table>
            <tbody>
              <tr>
                <td>
                  <p>*Csillaggal jelölt mező kitöltése kötelező,</p>
                </td>
                <td>
                  <p>új csomag felviteléhez az azonosítón kívül</p>
                </td>
                <td>
                  <p>minden adatot adjon meg</p>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="input-field col s12">
                    <input type="text" name="packid" size="30" />
                    <label>Módosítandó TV csomag azonosítója*</label>
                  <div>
                </td>
                <td>
                </td>
                <td>
                  <div class="input-field col s12">
                    <input type="text" name="packname" size="30" />
                    <label>új neve</label>
                  </div>
                </td>
              </tr>
              <!--form second row -->
              <tr>
                <td>
                  <div class="input-field col s12">
                    <input type="text" name="chnum" size="30" />
                    <label>új csatorna száma</label>
                  </div>
                </td>
                <td>
                </td>
                <td>
                  <div class="input-field col s12">
                    <input type="text" name="hdnum" size="30" />
                    <label>új HD csatorna száma </label>
                  </div>
                </td>
              </tr>
              <!--form third row -->
              <tr>
                <td>
                  <div class="input-field col s12">
                    <input type="text" name="radio" size="30" />
                    <label>új Rádió csatornáinak száma </label>
                  </div>
                </td>
                <td>
                </td>
                <td>
                  <div class="input-field col s12">
                    <input type="text" name="hbo" size="30"/>
                    <label>TV csomag HBO (igen/nem)</label>
                  </div>
                </td>
              </tr>
              <!--form fourth row -->
              <tr>
                <td>
                  <div class="input-field col s12">
                    <input type="text" name="amazon" size="30"/>
                    <label>TV csomag AMAZON (igen/nem)</label>
                  </div>
                </td>
                <td>
                </td>
                <td>
                  <div class="input-field col s12">
                    <input type="text" name="netflix" size="30"/>
                    <label>TV csomag Netflix (igen/nem)</label>
                  </div>
                </td>
              </tr>
              <!--form fifth row -->
              <tr>
                <td>
                  <div class="input-field col s12">
                    <input type="text" name="oneyearprice" size="30" />
                    <label>új egy éves ára</label>
                  </div>
                </td>
                <td>
                </td>
                <td>
                  <div class="input-field col s12">
                    <input type="text" name="twoyearprice" size="30" />
                    <label>új két éves ára</label>
                  </div>
                </td>
              </tr>
            </div>
              <tr>
                <td>
                </td>
                <td>
                  <div class="row">
                    <div class="col s1 offset-s1" >
                      <button class="btn btn-large blue" type="submit" value="Módosítás" class="waves-effect waves-light btn center">Módosítás</button>
                    </div>
                  </div>
                </td>
                <td>
                </td>
              </tr>
              <?php
                $tvupdate="yes";
                echo '<input type="hidden" name="custid" value="'.$workerid.'"></input>';
                echo '<input type="hidden" name="position" value="'.$position.'"></input>';
                echo '<input type="hidden" name="name" value="'.$name.'"></input>';
                echo '<input type="hidden" name="email" value="'.$email.'"></input>';
                echo '<input type="hidden" name="tvupdate" value="'.$tvupdate.'"></input>';
              ?>
            </tbody>
          </table>
        </form>
    </tbody>
    </table>
    </div>
    <!-- END PACK UPDATE FORM -->
    <!-- END OF TV TAB CONTENT -->
    <!--TEL-->
    <div id="tel" class="col s12">
    <table class="striped centered">
    <thead>
    <tr>
    <th>Csomagazonosító</th>
    <th>Csomagnév</th>
    <th>Hálózatonbelüli hívások ára</th>
    <th>Hálózatonkívüli hívások ára</th>
    </tr>
    </thead>

    <tbody>
      <?php
        $host="localhost";
        $user="plidrendszer";
        $pass="projektlab";
        $db="plidrendszer";
        $conn = new mysqli($host,$user,$pass,$db)
        or die ('Cannot connect to db');
        mysqli_set_charset($conn,"utf8");
        $result = $conn->query("SELECT `TelPackID`, `Name`, `InnerPrice`, `OuterPrice`, `MonthlyPrice` FROM `telpacks` WHERE 1");
        while ($subrow = $result->fetch_assoc())
        {
          $packid = $subrow['TelPackID'];
          $packname = $subrow['Name'];
          $innerprice = $subrow['InnerPrice'];
          $outerprice = $subrow['OuterPrice'];
          $montlyprice = $subrow['MonthlyPrice'];
          echo '<tr>';
            echo '<td>'.$packid.'</td>';
            echo '<td>'.$packname.'</td>';
            echo '<td>'.$innerprice.'</td>';
            echo '<td>'.$outerprice.'</td>';
            echo '<td>'.$montlyprice.'</td>';
          echo '</tr>';
        }
      ?>
    </tbody>
    </table>
    </div>
    <!--END OF TEL TAB CONTENT-->

    <div id="customers" class="col s12">
      <table class="highlight centered">
        <thead>
          <tr>
            <th>Vezetéknév</th>
            <th>Keresztnév</th>
            <th>Telefonszám</th>
            <th>E-mail cím</th>
            <th>Irányítószám</th>
            <th>Város</th>
            <th>Utca</th>
            <th>Házszám</th>
            <th>Jelszó</th>
            <th>Születési Dátum</th>
          </tr>
        </thead>

        <tbody>
          <tr>
          <!--M Y S Q L-->

          </tr>
        </tbody>
      </table>
      <form>
        <?php
          $userupdate="yes";
          echo '<input type="hidden" name="userupdate" value="'.$userupdate.'"></input>';
        ?>
      </form>
    </div>

      <div id="subs" class="col s12">
        <table class="highlight centered">
          <thead>
            <tr>
              <th>Adatok1</th>
              <th>Adatok2</th>
              <th>Adatok3</th>
            </tr>
          </thead>

          <tbody>
            <tr>
            <!--M Y S Q L-->
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    </div>

    <!--TEST 4 - ÜGYFÉL-->
    <!-- ./container -->

    <div style="height:500px"></div>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
    <script src="js/admin.js"></script>
  </body>
</html>
