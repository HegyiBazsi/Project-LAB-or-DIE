<html>
   <head>
     <!--Import Google Icon Font-->
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <!--Import materialize.css-->
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
     <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

     <!--Let browser know website is optimized for mobile-->
     <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
   <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
 	<link href="css/indexstyle.css" type="text/css" rel="stylesheet" media="screen,projection"/>
   </head>

   <body>
     <!--NAVBAR-->
         <nav class="navbar-fixed-top">
       		<div class="nav-wrapper">
       			<a href="#!" class="brand-logo center white-text">P-LID</a>
      <!--BUTTONS-->
          <ul class="right hide-on-med-and-down" style="margin-top:5px">
      			<a href="index.html" class="btn-floating white tooltipped btn-large" data-position="bottom" data-delay="50" data-tooltip="Kezdőlap"><i class="large material-icons teal-text">home</i></a>
      		</ul>
       <!--SIDE BAR-->
       			<nav class="teal" role="navigation">
       				<div class="nav-wrapper container">
       					<ul id="slide-out" class="side-nav">
       						<li><div class="divider"></div></li>
       						<li><a href="index.html" ><i class="material-icons">home</i>Főoldal</a></li>
       						<li><div class="divider"></div></li>
       						<li><a href="sign_in.html"><i class="material-icons">input</i>Bejelentkezés</a></li>
       						<li><div class="divider"></div></li>
       						<li><a href="reg.html"><i class="material-icons">person_add</i>Regisztáció</a></li>
       						<li><div class="divider"></div></li>
       						<li><a href="tv.html"><i class="material-icons">personal_video</i>Televízió</a></li>
       						<li><div class="divider"></div></li>
       						<li><a href="telefon.html"><i class="material-icons">call</i>Telefon</a></li>
       						<li><div class="divider"></div></li>
       						<li><a href="all_in_one.html"><i class="material-icons">looks_3</i>All-in-one</a></li>
       						<li><div class="divider"></div></li>
                   <li><a href="intro.html"><i class="material-icons">people</i>Bemutatkozás</a></li>
       						<li><div class="divider"></div></li>
       						<li><a href="help.html"><i class="material-icons">error</i>Hiba bejelentés</a></li>
       						<li><div class="divider"></div></li>
       					</ul>
       					<a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons white-text">menu</i></a>
       				</div>
       			</nav>
     <!--END OF SIDEBAR-->
       		</div>
     <!--END OF NAW WRAPPER-->
       	</nav>
<!--END OF NAVBAR-->



<!--CONTAINER-->
     <div class="container" style="margin-top: 100px">
<!--FORM-->
<form action=reg.php method="post">
       <div class="row">
         <h2 class="center">Regisztáció</h2>
         <br>
         <h5 class="center">Kérjük töltse ki az alábbi formanyomtatványt, a sikeres regisztráció érdekében.</h5>
         <br>
         <h6 class="left">A csillaggal jelölt mezőket kötelező kitölteni!</h6>
         <br><br><br>
           <div class="row">
             <div class="input-field col s3">
               <i class="material-icons prefix">account_circle</i>
               <input  type="text" name="lastname" class="validate">
               <label>Vezeték név *</label>
             </div>
             <div class="input-field col s3">
               <i class="material-icons prefix">account_circle</i>
               <input type="text" name="firstname" class="validate">
               <label>Keresztnév *</label>
             </div>
             <div class="input-field col s3">
               <i class="material-icons prefix">phone</i>
               <input type="tel" name="phonenumber" class="validate">
               <label>Telefonszám</label>
             </div>
             <div class="input-field col s3">
               <i class="material-icons prefix">email</i>
               <input type="email" name="email" class="validate">
               <label>E-mail cím *</label>
             </div>
           </div>
       </div>

<!--LOCATION-->
       <div class="row">
           <div class="row">
             <div class="input-field col s3">
               <i class="material-icons prefix">map</i>
               <input type="number" name="cityzip" class="validate">
               <label>Irányítószám</label>
             </div>
             <div class="input-field col s3">
               <i class="material-icons prefix">location_city</i>
               <input type="text" name="cityname" class="validate">
               <label>Város</label>
             </div>
             <div class="input-field col s3">
               <i class="material-icons prefix">place</i>
               <input type="text" name="street" class="validate">
               <label>Utca</label>
             </div>

              <div class="input-field col s3">
                <i class="material-icons prefix">place</i>
                <input type="text" name="address" class="validate">
                <label>Házszám</label>
              </div>
           </div>

<!--PASSWORD-->
           <div class="row">
             <div class="input-field col s3">
              <i class="material-icons prefix">lock</i>
              <input type="text" name="password" class="validate">
              <label>Jelszó *</label>
             </div>
<!--DATE-->
             <div class="input-field col s3">
      				<i class="material-icons prefix">cake</i>
      				<input type="text" name="birthdate" class="datepicker">
      				<label>Születési dátum *</label>
      			 </div>
           </div>
       </div>




<!--MODAL-->
<!-- Modal Trigger -->
      <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Regisztáció</a>

<!-- Modal Structure -->
      <div id="modal1" class="modal">
        <div class="modal-content">
          <h4>P-LID</h4>
          <p>
            Köszönjük hogy regisztrált a P-LID oldalára! Kattintson a "Továbbra" a folytatáshoz.
           </p>
        </div>
        <div class="modal-footer">
          <a href="index.html" class="modal-action modal-close waves-effect waves-green btn-flat">Tovább</a>
        </div>
      </div>
    </div><!--END OF CONTAINER-->
</form>
<br><br><br>

<!--FOOTER-->
      <footer class="page-footer teal">
    		<div class="container">
    			<div class="row">
    				<div class="col s12 m3">
    					<h5 class="white-text">Kapcsolat</h5>
    					<i class="material-icons">room</i> Cím: 8200, Veszprém Egyetem utca 2.
    					<br>
    					<i class="material-icons">mail_outline</i> E-mail: info@plid.com
    					<br>
    					<i class="material-icons">call</i> Telefon: 06-10-123-4567
    					<br>
    					<i class="material-icons">alarm</i> Nyitvatartás: H-P 8-12 / 13-17
    				</div>
    			</div>
    		</div>
    		<br>
    		<div class="footer-copyright">
    			<div class="container">
    				Made by <a class="brown-text text-lighten-4">Projekt Lab or Die</a>
    			</div>
    		</div>
    	</footer>

<!--SCRIPTS-->
     <!--Import jQuery before materialize.js-->
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
     <script type="text/javascript" src="js/materialize.min.js"></script>
     <script src="js/init.js"></script>

<!---->
     <script type="text/javascript">
        $(document).ready(function()
        {
          Materialize.updateTextFields();
        });
     </script>

<!---->
     <script type="text/javascript">
        $(document).ready(function()
        {
          $('select').material_select();
        });
     </script>

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
/*
         ready: function(modal, trigger)
         { // Callback for Modal open. Modal and trigger parameters available.
          alert("Ready");
          console.log(modal, trigger);
         },
         complete: function()
         {
          alert('Closed');
         } // Callback for Modal close
*/
		}
	);
	</script>

<!--DATE SELECTOR-->
	<script type="text/javascript">
	 $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 75, // Creates a dropdown of 15 years to control year,
    today: 'Ma',
    clear: 'Törlés',
    close: 'Ok',
    // The title label to use for the month nav buttons
    labelMonthNext: 'Következő hónap',
    labelMonthPrev: 'Előző hónap',

    // The title label to use for the dropdown selectors
    labelMonthSelect: 'Válasszon hónapot',
    labelYearSelect: 'Válasszon évet',

    // Months and weekdays
    monthsFull: ['Január', 'Február', 'Március', 'Április', 'Május', 'Június', 'Július', 'Augusztus', 'Szeptember', 'Október', 'November', 'December'],
    monthsShort: ['Jan', 'Feb', 'Már', 'Ápr', 'Máj', 'Jún', 'Júl', 'Aug', 'Szep', 'Okt', 'Nov', 'Dec'],
    weekdaysFull: ['Vasárnap', 'Hétfő', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat'],
    weekdaysShort: ['Vas', 'Hé', 'Ke', 'Sze', 'Csüt', 'Pé', 'Sz'],

    // Materialize modified
    weekdaysLetter: ['H', 'K', 'Sze', 'CS', 'P', 'Szo', 'V'],
    // The format to show on the `input` element
    format: 'yyyy, mmmm, dd',
    closeOnSelect: false // Close upon selecting a date,
    });
    </script>
<!--PHP reg-->
    <?php
     			if(isset($_POST['firstname'])){
     				include "php/connect.php";
     				$FirstName = $_POST['firstname'];
            $LastName = $_POST['lastname'];
            $BirthDate = $_POST['birthdate'];
            $CityZip =  $_POST['cityzip'];
            $City = $_POST['cityname'];
     				$Street = $_POST['street'];
            $Address = $_POST['address'];
     				$Telnum = $_POST['phonenumber'];
     				$Email = $_POST['email'];
     				$passWord = $_POST['password'];

     				$sql = "INSERT INTO `Customers`(`FirstName`, `LastName`, `BirthDate`, `CityZip`, `City`, `Street`, `Address`, `Telnum`, `Email`, `Password`) VALUES (FirstName, LastName, BirthDate, CityZip, City, Street, Address, Telnum, Email, Password)";
     				$resultset = mysqli_query($mysqllink, $sql ) or die("data transfer error: ".mysqli_error($mysqllink));
     				mysqli_close($mysqllink);
     			}
    ?>
   </body>
 </html>
