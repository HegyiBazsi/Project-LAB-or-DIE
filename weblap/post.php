<?php
  header("Content-type: text/html; charset=utf-8");
  if(isset($_POST['lastname']))
  {
      $fname = $_POST['firstname'];
      $lname = $_POST['lastname'];
      $bdate = $_POST['datepicker'];
      $zip =  $_POST['cityzip'];
      $city = $_POST['city'];
      $street = $_POST['street'];
      $address = $_POST['address'];
      $tnum = $_POST['phonenumber'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $host="localhost";
      $user="plidrendszer";
      $pass="projektlab";
      $db="plidrendszer";
      $mysqli = new mysqli($host,$user,$pass,$db) or die ('Cannot connect to db');

      mysqli_set_charset($mysqli,"utf8");

  	if (mysqli_connect_errno())
  	{
  		printf("Connect failed: %s\n", mysqli_connect_error());
  		exit();
  	}
      $stmt = $mysqli->prepare("INSERT INTO `customers`(`FirstName`, `LastName`, `BirthDate`, `CityZip`, `City`, `Street`, `Address`, `Telnum`, `Email`, `Password`) VALUES (?,?,?,?,?,?,?,?,?,?)");
      $stmt->bind_param("sssississs",$fname,$lname,$bdate,$zip,$city,$street,$address,$tnum,$email,$password);

  	if(!$stmt->execute())
  	{
  		print_r($stmt->error);
  		return false;
  	}

      $stmt->close();

      $mysqli->close();


      unset($_POST['']);
      unset($_POST['firstname']);
      unset($_POST['lastname']);
      unset($_POST['birthdate']);
      unset( $_POST['cityzip']);
      unset( $_POST['city']);
      unset($_POST['street']);
      unset( $_POST['address']);
      unset($_POST['phonenumber']);
      unset($_POST['email']);
      unset( $_POST['password']);
      header('Location: registrationsuccess.html');
  }
  //------------------------------end of registration ---------------------------------------------------------------------------------
  //-------------------------------user.php sql code-----------------------------------------------------------------------------
  //-------------------------------login code------------------------------------------------------------------------------------
  elseif (((isset($_POST['username']) && isset($_POST['password']))))
  {
  	$host="localhost";
    $user="plidrendszer";
    $pass="projektlab";
    $db="plidrendszer";
    $mysqli = new mysqli($host,$user,$pass,$db) or die ('Cannot connect to db');

    mysqli_set_charset($mysqli,"utf8");
    $email = $_POST['username'];
    $password = $_POST['password'];

    if (mysqli_connect_errno())
    {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }

  	$sql = "SELECT `ID`,`FirstName`, `LastName` FROM `customers` WHERE `Email` LIKE '$email' AND `Password` LIKE '$password'";
    $result=mysqli_query($mysqli, $sql ) or die("no such customer exists in the system: ".mysqli_error($mysqli));

  	if(mysqli_num_rows($result) > 0)
  	{
  		$userinforow=mysqli_fetch_row($result);
      $id=$userinforow[0];
      $fname=$userinforow[1];
      $lname=$userinforow[2];
      //var_dump($id);
      //var_dump($fname);
      //var_dump($lname);
  		//echo "user is registered";
      $name=$lname." ".$fname;
      mysqli_close($mysqli);
  //----------------------storing user data in session--------------------------------------------------------------------------------------
      session_start();
      $_SESSION["name"] = $name;
      $_SESSION["email"] = $email;
      $_SESSION["password"] = $password;
      $_SESSION["id"]= $id;
  		include "php/connect.php";
      $sql="SELECT `InternetPackID`,`TelPackID`,`TVPackID`,`Subtime` FROM `subscription_customers` WHERE `CustomerID` = '$id'";
      $resultset = mysqli_query($mysqllink, $sql ) or die("customer has no subscriptions: ".mysqli_error($mysqli));
      $subrow=mysqli_fetch_row($resultset);
  //---------------------check if user has subcription, if not register with basic package---------------------------------------------------
  		if($subrow != NULL)
  		{
  			//get package ids and subtime from the table

  			$internetid=intval($subrow[0]);
        $telid=intval($subrow[1]);
        $tvid=intval($subrow[2]);
  			$subtime=intval($subrow[3]);

        /*print_r('net:');
        var_dump($internetid);
      	echo '</br>';
      	print_r('tv:');
        var_dump($tvid);
      	echo '</br>';
      	echo('tel:');
        var_dump($telid);
      	echo '</br>';*/
        //-----------------------------------------package names------------------------------------------------------------------------------------
  			mysqli_close($mysqllink);
  			include "php/connect.php";
  			$sql="SELECT `Name` FROM `InternetPacks` WHERE `NetID` = $internetid";
  			$resultset = mysqli_query($mysqllink, $sql ) or die("net name no result: ".mysqli_error($mysqllink));
  			$internetrow=mysqli_fetch_row($resultset);
  			if($internetrow != NULL)
  			{
  				$internetname =$internetrow[0];
          //var_dump($internetname);
  			}
  			mysqli_close($mysqllink);
  			include "php/connect.php";
  			$sql="SELECT `Name` FROM `TelPacks` WHERE `TelPackID` = $telid";
  			$resultset = mysqli_query($mysqllink, $sql ) or die("tel name no result: ".mysqli_error($mysqllink));
  			$telrow=mysqli_fetch_row($resultset);
  			if($telrow != NULL)
  			{
                 $telname=$telrow[0];
                 //var_dump($telname);
  			}
  			mysqli_close($mysqllink);
  			include "php/connect.php";
  			$sql="SELECT `Name` FROM `TVPacks` WHERE `TVID` = $tvid";
  			$resultset = mysqli_query($mysqllink, $sql ) or die("tv name no result: ".mysqli_error($mysqllink));
        echo("fuck");
  			$tvrow=mysqli_fetch_row($resultset);
  			if($tvrow != NULL)
  			{
  			   $tvname=$tvrow[0];
           var_dump($tvname);
  			}
  			mysqli_close($mysqllink);
  //-----------------------------------------end of package names----------------------------------------------------------------------------------
  //-----------------------------get price data according to sub time to display-------------------------------------------------------------------
  			if($subtime=1)
  			{
          include "php/connect.php";
          $sql="SELECT `oneyear_price` FROM `InternetPacks` WHERE `NetID` = $internetid";
  				$resultset = mysqli_query($mysqllink, $sql ) or die("1 year sub net no result: ".mysqli_error($mysqllink));
  				$internetrow=mysqli_fetch_row($resultset);
  				if($internetrow != NULL)
  				{
  				   $internetprice=$internetrow[0];
  				}
  				$sql="SELECT `MonthlyPrice` FROM `TelPacks` WHERE `TelPackID` = $telid";
  				$resultset = mysqli_query($mysqllink, $sql ) or die("1 year sub tel no result: ".mysqli_error($mysqllink));
  				$telrow=mysqli_fetch_row($resultset);
  				if($telrow != NULL)
  				{
  					$telprice=$telrow[0];
  				}
  				$sql="SELECT `oneyear_price` FROM `TVPacks` WHERE `TVID` = $tvid";
  				$resultset = mysqli_query($mysqllink, $sql ) or die("1 year sub tv no result: ".mysqli_error($mysqllink));
  				$tvrow=mysqli_fetch_row($resultset);
  				if($tvrow != NULL)
  				{
  				   $tvprice=$tvrow[0];
  				}
  				mysqli_close($mysqllink);
  				$summonthly=$internetprice+$telprice+$tvprice;
  			}
  			elseif ($subtime=2)
  			{
  				$sql="SELECT `twoyear_price` FROM `InternetPacks` WHERE `NetID` = $internetid";
  				$resultset = mysqli_query($mysqllink, $sql ) or die("2 year sub net no result: ".mysqli_error($mysqllink));
  				$internetrow=mysqli_fetch_row($resultset);
  				if($internetrow != NULL)
  				{
  					$internetprice=$internetrow[0];
  				}
  				$sql="SELECT `MonthlyPrice` FROM `TelPacks` WHERE `TelPackID` = $telid";
  				$resultset = mysqli_query($mysqllink, $sql ) or die("2 year sub tel no result: ".mysqli_error($mysqllink));
  				$telrow=mysqli_fetch_row($resultset);
  				if($telrow != NULL)
  				{
  					$telprice=$telrow[0];
  				}
  				$sql="SELECT `twoyear_price` FROM `TVPacks` WHERE `TVID` = $tvid";
  				$resultset = mysqli_query($mysqllink, $sql ) or die("2 year sub tv no result: ".mysqli_error($mysqllink));
  				$tvrow=mysqli_fetch_row($resultset);
  				if($tvrow != NULL)
  				{
  					$tvprice=$tvrow[0];
  				}
  				mysqli_close($mysqllink);
  				$summonthly=$internetprice+$telprice+$tvprice;
  			}
  			else
  			{
  				$sql="SELECT `MonthlyPrice` FROM `TelPacks` WHERE `TelPackID` LIKE '$telid'";
  				$resultset = mysqli_query($mysqllink, $sql ) or die("0 subtime no result: ".mysqli_error($mysqllink));
  				$telrow=mysqli_fetch_row($resultset);
  				if($telrow != NULL)
  				{
  					$telprice=$telrow[4];
  				}
  				$internetprice=0;
  				$tvprice=0;
  				$summonthly=$internetprice+$telprice+$tvprice;
  			}

  //--------------------------------subscription time data query------------------------------------------------------------------------------------
  			include "php/connect.php";
  			$sql="SELECT * FROM `subscription_customers` WHERE `CustomerID` = $id";
  			$resultset = mysqli_query($mysqllink, $sql ) or die("subtime sql no result: ".mysqli_error($mysqllink));
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
  				else
  				{
  					$szerzodott="nincs szerződése";
  				}
  			}

        //get telnum from user table---------------------------------------------------------------------------
        include "php/connect.php";
  			$sql="SELECT `Telnum` FROM `customers` WHERE `ID` = $id";
  			$resultset = mysqli_query($mysqllink, $sql ) or die("subtime sql no result: ".mysqli_error($mysqllink));
  			$subrow=mysqli_fetch_row($resultset);
  			if($subrow != NULL)
  			{
          $telnum=$subrow[0];
        }
  			//all gathered data to session
  			$_SESSION["internetname"]=$internetname;
  			$_SESSION["telname"]=$telname;
  			$_SESSION["tvname"]=$tvname;
  			$_SESSION["datefrom"]=$datefrom;
  			$_SESSION["dateto"]=$dateto;
  			$_SESSION["szerzodott"]=$szerzodott;
        $_SESSION["internetprice"]=$internetprice;
        $_SESSION["telprice"]=$telprice;
        $_SESSION["tvprice"]=$tvprice;
        $_SESSION["summonthly"]=$summonthly;
        $_SESSION["telnum"]=$telnum;
        //var_dump($internetname);
        //var_dump($telname);
        //var_dump($tvname);

        header('Location: user.php');
  		}
  		else
  		{
  			$date=date('Y-m-d');
        $sql = "INSERT INTO `subscription_customers`(`CustomerID`, `DateFrom`, `Subtime`, `InternetPackID`, `TelPackID`, `TVPackID`) VALUES ('$id','$date',0,7,4,7);";
        $resultset = mysqli_query($mysqllink, $sql ) or die("new sub 0 subtime data transfer error: ".mysqli_error($mysqllink));
        mysqli_close($mysqllink);
        header('Location: user.php');
  		}


  	}
  	else
  	{
  		header('Location: failedlogin.html');
  	}

  }
  elseif(isset($_POST["deleteuser"]))
  {
    include "php/connect.php";
    $custid=$_POST["custid"];
    $sql="SELECT `FirstName`, `LastName`, `BirthDate`, `CityZip`, `City`, `Street`, `Address`, `Telnum`, `Email`, `Password` FROM `customers` WHERE `ID`='$custid'";
    $resultset = mysqli_query($mysqllink, $sql ) or die("new sub 0 subtime data transfer error: ".mysqli_error($mysqllink));
    $subrow=mysqli_fetch_row($resultset);
    if($subrow != NULL)
    {
      $fname=$subrow[0];
      $lname=$subrow[1];
      $birthdate=$subrow[2];
      $zip=intval($subrow[3]);
      $city=$subrow[4];
      $street=$subrow[5];
      $address=intval($subrow[6]);
      $telnum=$subrow[7];
      $email=$subrow[8];
      $password=$subrow[9];
    }
    //copy customer to previous customers table-----------------------------------------------------------------------------
    $sql="INSERT INTO `deletedcustomers`(`ID`,`FirstName`, `LastName`, `BirthDate`, `CityZip`, `City`, `Street`, `Address`, `Telnum`, `Email`, `Password`)
          VALUES ('$custid','$fname','$lname',$birthdate,$zip,'$city','$street',$address,'$telnum','$email','$password')";
    $resultset = mysqli_query($mysqllink, $sql ) or die("new sub 0 subtime data transfer error: ".mysqli_error($mysqllink));
    //remove from customers-------------------------------------------------------------------------------------------------
    $sql = "DELETE FROM `customers` WHERE `ID`='$custid'";
    $resultset = mysqli_query($mysqllink, $sql ) or die("new sub 0 subtime data transfer error: ".mysqli_error($mysqllink));
    echo "Sikeresen törölve lett a fiókja.";
    sleep(5);
    header('Location: index.html');
  }
  //--------------------------------end of user.php code-------------------------------------------------------------------------
  //----------------------------user account deletion handler-----------------------------------------------------
  //-----------------------end of login------------------------------------------------------------------------------------------
  else
  {
  	echo "No POST data!";
  }
  mysqli_close($mysqllink);
?>
