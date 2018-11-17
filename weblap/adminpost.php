<?php
if(((isset($_POST['email']) && isset($_POST['password']))))
{
  $host="localhost";
  $user="plidrendszer";
  $pass="projektlab";
  $db="plidrendszer";
  $mysqli = new mysqli($host,$user,$pass,$db) or die ('Cannot connect to db');

  mysqli_set_charset($mysqli,"utf8");
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (mysqli_connect_errno())
  {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

  $sql = "SELECT `WorkerID`, `position`,`Name` FROM `workers` WHERE `email` LIKE '$email' AND `Password` LIKE '$password'";
  $result=mysqli_query($mysqli, $sql ) or die("no such admin exists in the system: ".mysqli_error($mysqli));

  if(mysqli_num_rows($result) > 0)
  {
    $resultrow=mysqli_fetch_row($result);
    $workerid=$resultrow[0];
    $position=$resultrow[1];
    $name=$resultrow[2];

    session_start();
    $_SESSION["workerid"]=$workerid;
    $_SESSION["position"]=$position;
    $_SESSION["name"]=$name;
    $_SESSION["email"]=$email;
    if($position==="dispatcher")
    {
      header('Location: admin.php');
    }
    else
    {
      header('Location: worker.php');
    }

  }
}
//----------------------------------------------------END OF SIGN IN----------------------------------------------------------
//----------------------------------------------------NET UPDATE FORM HANDLER---------------------------------------------
elseif(isset($_POST["netupdate"]))
{
  //------evaluating update data from net form
  if(isset($_POST['packid']) && (strlen($_POST['packid'])>0))
  {
    //get old data
    $packid=$_POST['packid'];
    $result = $conn->query("SELECT SELECT `Name`, `DownSpeed`, `UpSpeed`, `oneyear_price`, `twoyear_price` FROM `internetpacks` WHERE `NetID`$packid");
    $subrow = $result->fetch_assoc();
    //store old data
    $packname = $subrow['Name'];
    $downspeed = $subrow['DownSpeed'];
    $upspeed = $subrow['UpSpeed'];
    $oneyearprice= $subrow['oneyear_price'];
    $twoyearprice= $subrow['twoyear_price'];

    if(isset($_POST['packname']) && (strlen($_POST['packname'])>0))
    {
      $packname=$_POST['packname'];
    }
    if(isset($_POST['downspeed']) && (strlen($_POST['downspeed'])>0))
    {
      $downspeed=intval($_POST['downspeed']);
    }
    if(isset($_POST['upspeed']) && (strlen($_POST['upspeed'])>0))
    {
      $upspeed=intval($_POST['upspeed']);
    }
    if(isset($_POST['oneyearprice']) && (strlen($_POST['oneyearprice'])>0))
    {
      $oneyearprice=intval($_POST['oneyearprice']);
    }
    if(isset($_POST['twoyearprice']) && (strlen($_POST['twoyearprice'])>0))
    {
      $twoyearprice=intval($_POST['oneyearprice']);
    }
    //sql pack update
    include "php/connect.php";
    $sql =
    "UPDATE `internetpacks`
    SET
    `Name`='$packname',`DownSpeed`='$downspeed',
    `UpSpeed`='$upspeed',`oneyear_price`='$oneyearprice',
    `twoyear_price`='$twoyearprice'
    WHERE `NetID`='$packid'";
    $resultset = mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));
  //------end of evaluating update data
  //------return to worker.php or admin.php
    if(isset($_POST['custid']))
    {
      $workerid=$_POST['custid'];
      $position=$_POST['position'];
      $name=$_POST['name'];
      $email=$_POST['email'];
      session_start();
      $_SESSION["workerid"]=$workerid;
      $_SESSION["position"]=$position;
      $_SESSION["name"]=$name;
      $_SESSION["email"]=$email;
      if($position==="dispatcher")
      {
        header('Location: admin.php');
      }
      else
      {
        header('Location: worker.php');
      }
    }
  }
  //----------------end of pack update
  //---------------NO PACK ID GIVEN, BEGGINING NEW NET PACK input
  else
  {
    if(isset($_POST['packname']) && (strlen($_POST['packname'])>0))
    {
      if(isset($_POST['downspeed']) && (strlen($_POST['downspeed'])>0))
      {
        if(isset($_POST['upspeed']) && (strlen($_POST['upspeed'])>0))
        {
          if(isset($_POST['oneyearprice']) && (strlen($_POST['oneyearprice'])>0))
          {
            if(isset($_POST['twoyearprice']) && (strlen($_POST['twoyearprice'])>0))
            {
              $packname=$_POST['packname'];
              $upspeed=intval($_POST['upspeed']);
              $downspeed=intval($_POST['downspeed']);
              $oneyearprice=intval($_POST['oneyearprice']);
              $twoyearprice=intval($_POST['oneyearprice']);
              $sql="INSERT INTO `internetpacks`(`Name`, `DownSpeed`, `UpSpeed`, `oneyear_price`, `twoyear_price`)
              VALUES ('$packname',$downspeed,$upspeed,$oneyearprice,$twoyearprice)";
              mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));
            }
          }
        }
      }
    }
    //-------------END OF NEW PACK HANDLER----------------------------------------------------------------------------------
    //------return to worker.php or admin.php
    if(isset($_POST['custid']))
    {
      $workerid=$_POST['custid'];
      $position=$_POST['position'];
      $name=$_POST['name'];
      $email=$_POST['email'];
      session_start();
      $_SESSION["workerid"]=$workerid;
      $_SESSION["position"]=$position;
      $_SESSION["name"]=$name;
      $_SESSION["email"]=$email;
      if($position==="dispatcher")
      {
        header('Location: admin.php');
      }
      else
      {
        header('Location: worker.php');
      }
    }
  }
  //---------------END OF NEW NET PACK HANDLER---------------------------------------------------------------------------
}
//----------------------------------------------------END OF NET UPDATE FORM HANDLER---------------------------------------------
//----------------------------------------------------TV UPDATE FORM HANDLER---------------------------------------------
elseif(isset($_POST['tvupdate']))
{
  if(isset($_POST['packid']) && (strlen($_POST['packid'])>0))
  {
    //get old data
    $packid=$_POST['packid'];
    $result = $conn->query("SELECT `TVID`, `Name`, `ChannelNUM`, `HDChannelNUM`, `Radio_stations`, `HBO_Pack`, `Amazon_PRIME`, `NETFLIX`, `oneyear_price`, `twoyear_price` FROM `tvpacks` WHERE `TVID`=$packid");
    $subrow = $result->fetch_assoc();
    //store old data
    $packname = $subrow['Name'];
    $chnum = $subrow['ChannelNUM'];
    $hdnum = $subrow['HDChannelNUM'];
    $radio = $subrow['Radio_stations'];
    $hbo = $subrow['HBO_Pack'];
    $amazon = $subrow['Amazon_PRIME'];
    $netflix = $subrow['NETFLIX'];
    $oneyearprice= $subrow['oneyear_price'];
    $twoyearprice= $subrow['twoyear_price'];

    //evaluating post data and overwriting old data
    if(isset($_POST['packname']) && (strlen($_POST['packname'])>0))
    {
      $packname=$_POST['packname'];
    }
    if(isset($_POST['chnum']) && (strlen($_POST['chnum'])>0))
    {
      $chnum=intval($_POST['chnum']);
    }
    if(isset($_POST['hdnum']) && (strlen($_POST['hdnum'])>0))
    {
      $hdnum=intval($_POST['hdnum']);
    }
    if(isset($_POST['radio']) && (strlen($_POST['radio'])>0))
    {
      $radio=intval($_POST['radio']);
    }
    if(isset($_POST['hbo']) && (strlen($_POST['hbo'])>0))
    {
      $value=$_POST['hbo'];
      if($value==="igen")
      {
        $hbo=1;
      }
      else
      {
        $hbo=0;
      }
    }
    if(isset($_POST['amazon']) && (strlen($_POST['amazon'])>0))
    {
      $value=$_POST['amazon'];
      if($value==="igen")
      {
        $amazon=1;
      }
      else
      {
        $amazon=0;
      }
    }
    if(isset($_POST['netflix']) && (strlen($_POST['netflix'])>0))
    {
      $value=$_POST['netflix'];
      if($value==="igen")
      {
        $netflix=1;
      }
      else
      {
        $netflix=0;
      }
    }
    if(isset($_POST['oneyearprice']) && (strlen($_POST['oneyearprice'])>0))
    {
      $oneyearprice=intval($_POST['oneyearprice']);
    }
    if(isset($_POST['twoyearprice']) && (strlen($_POST['twoyearprice'])>0))
    {
      $twoyearprice=intval($_POST['oneyearprice']);
    }
    //sql pack update
    include "php/connect.php";
    $sql =
    "UPDATE `tvpacks`
    SET `Name`='$packname',`ChannelNUM`='$chnum',
    `HDChannelNUM`='$hdnum',`Radio_stations`='$radio',
    `HBO_Pack`='$hbo',`Amazon_PRIME`='$amazon',`NETFLIX`='$netflix',
    `oneyear_price`='$oneyearprice',`twoyear_price`='$twoyearprice'
    WHERE `TVID`='$packid'";
    $resultset = mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));
    //------return to worker.php or admin.php
    if(isset($_POST['custid']))
    {
      $workerid=$_POST['custid'];
      $position=$_POST['position'];
      $name=$_POST['name'];
      $email=$_POST['email'];
      session_start();
      $_SESSION["workerid"]=$workerid;
      $_SESSION["position"]=$position;
      $_SESSION["name"]=$name;
      $_SESSION["email"]=$email;
      if($position==="dispatcher")
      {
        header('Location: admin.php');
      }
      else
      {
        header('Location: worker.php');
      }
    }
  }
//----------------------if no pack id was set then add new tv pack---------------------------------------------------------
  else
  {
    if(isset($_POST['packname']) && (strlen($_POST['packname'])>0))
    {
      if(isset($_POST['chnum']) && (strlen($_POST['chnum'])>0))
      {
        if(isset($_POST['hdnum']) && (strlen($_POST['hdnum'])>0))
        {
          if(isset($_POST['radio']) && (strlen($_POST['radio'])>0))
          {
            if(isset($_POST['hbo']) && (strlen($_POST['hbo'])>0))
            {
              if(isset($_POST['amazon']) && (strlen($_POST['amazon'])>0))
              {
                if(isset($_POST['netflix']) && (strlen($_POST['netflix'])>0))
                {
                  if(isset($_POST['oneyearprice']) && (strlen($_POST['oneyearprice'])>0))
                  {
                    if(isset($_POST['twoyearprice']) && (strlen($_POST['twoyearprice'])>0))
                    {
                      $packname=$_POST['packname'];
                      $chnum=intval($_POST['chnum']);
                      $hdnum=intval($_POST['hdnum']);
                      $radio=intval($_POST['radio']);
                      //hbo data
                      $value=$_POST['hbo'];
                      if($value==="igen")
                      {
                        $hbo=1;
                      }
                      else
                      {
                        $hbo=0;
                      }
                      //amazon data
                      $value=$_POST['amazon'];
                      if($value==="igen")
                      {
                        $amazon=1;
                      }
                      else
                      {
                        $amazon=0;
                      }
                      //netflix data
                      $value=$_POST['netflix'];
                      if($value==="igen")
                      {
                        $netflix=1;
                      }
                      else
                      {
                        $netflix=0;
                      }
                      $oneyearprice=intval($_POST['oneyearprice']);
                      $twoyearprice=intval($_POST['oneyearprice']);
                      $sql="INSERT INTO `tvpacks`
                      (`Name`, `ChannelNUM`, `HDChannelNUM`,
                      `Radio_stations`, `HBO_Pack`,
                      `Amazon_PRIME`, `NETFLIX`,
                      `oneyear_price`, `twoyear_price`)
                      VALUES ('$packname',$chnum,$hdnum,$radio,$hbo,$amazon,$netflix,$oneyearprice,$twoyearprice)";
                      mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    //-------------END OF NEW PACK HANDLER----------------------------------------------------------------------------------
    //------return to worker.php or admin.php
    if(isset($_POST['custid']))
    {
      $workerid=$_POST['custid'];
      $position=$_POST['position'];
      $name=$_POST['name'];
      $email=$_POST['email'];
      session_start();
      $_SESSION["workerid"]=$workerid;
      $_SESSION["position"]=$position;
      $_SESSION["name"]=$name;
      $_SESSION["email"]=$email;
      if($position==="dispatcher")
      {
        header('Location: admin.php');
      }
      else
      {
        header('Location: worker.php');
      }
    }
  }
}
//----------------------------------------------------END OF TV UPDATE FORM HANDLER--------------------------------------
//----------------------------------------------------TEL UPDATE FORM HANDLER-------------------------------------------
elseif(isset($_POST["telupdate"]))
{

}
//----------------------------------------------------END OF TEL UPDATE FORM HANDLER---------------------------------------------
if(isset($_POST['userupdate']))
{
	include "php/connect.php";


	$userupdate=$_POST['userupdate'];
	//var_dump($userupdate);
	$custid = intval($_POST['custid']);
	//var_dump($custid);
  $site = $_POST['sourcesite'];


	$sql="SELECT `FirstName`,`LastName`,`Telnum`,`Email`,`Password` FROM `customers` WHERE `ID`=$custid";
	$previousdata = mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));
	$userinforow=mysqli_fetch_row($previousdata);
	$fname=$userinforow[0];
	$lname=$userinforow[1];
	$telnum=$userinforow[2];
	$email=$userinforow[3];
	$password=$userinforow[4];

	//---------------------updateuser form data extraction and update handler--------------------------------------
	if(isset($_POST['fnameupdate']) && (strlen($_POST['fnameupdate'])>0))
	{
		$fnameupdate=$_POST['fnameupdate'];

		print_r('fname:');
		var_dump($fnameupdate);
		echo '</br>';

		$sql = "UPDATE `customers` SET `FirstName`='$fnameupdate', `LastName`='$lname',`Telnum`='$telnum',`Email`='$email',`Password`='$password' WHERE `ID`=$custid";
		$resultset = mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));
	}

	if(isset($_POST['lnameupdate']) && (strlen($_POST['lnameupdate'])>0))
	{
		$lnameupdate=$_POST['lnameupdate'];

		print_r('lname:');
		var_dump($lnameupdate);
		echo '</br>';

		$sql = "UPDATE `customers` SET `FirstName`='$fname', `LastName`='$lnameupdate',`Telnum`='$telnum',`Email`='$email',`Password`='$password' WHERE `ID`=$custid";
		$resultset = mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));
	}

	if(isset($_POST['emailupdate']) && (strlen($_POST['emailupdate'])>0))
	{
		$emailupdate=$_POST['emailupdate'];

		print_r('email:');
		var_dump($emailupdate);
		echo '</br>';

		$sql = "UPDATE `customers` SET `FirstName`='$fname', `LastName`='$lname',`Telnum`='$telnum',`Email`='$emailupdate',`Password`='$password' WHERE `ID`=$custid";
		$resultset = mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));
	}

	if(isset($_POST['passwordupdate']) && isset($_POST['passwordupdatecheck'])
	   && (strlen($_POST['passwordupdate'])>0) && (strlen($_POST['passwordupdatecheck'])>0))
	{
		$passwordupdate=$_POST['passwordupdate'];
		$passwordupdatecheck=$_POST['passwordupdatecheck'];

		print_r('password:');
		var_dump($passwordupdate);
		echo '</br>';

		print_r('passwordcheck:');
		var_dump($passwordupdatecheck);
		echo '</br>';

		if($passwordupdate===$passwordupdatecheck)
		{
			$sql = "UPDATE `customers` SET `FirstName`='$fname', `LastName`='$lname',`Telnum`='$telnum',`Email`='$email',`Password`='$passwordupdate' WHERE `ID`=$custid";
			$resultset = mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));
		}
		else
		{
			echo "Nem egyezik a ket jelszo";
		}

	}

	if(isset($_POST['telnumupdate']) && (strlen($_POST['telnumupdate'])>0))
	{
		$telnumupdate=$_POST['telnumupdate'];

		print_r('telnum:');
		var_dump($telnumupdate);
		echo '</br>';

		$sql = "UPDATE `customers` SET `FirstName`='$fname', `LastName`='$lname',`Telnum`='$telnumupdate',`Email`='$email',`Password`='$password' WHERE `ID`=$custid";
		$resultset = mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));
	}
  //------return to worker.php or admin.php
  if(isset($_POST['custid']))
  {
    $workerid=$_POST['custid'];
    $position=$_POST['position'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    session_start();
    $_SESSION["workerid"]=$workerid;
    $_SESSION["position"]=$position;
    $_SESSION["name"]=$name;
    $_SESSION["email"]=$email;
    if($position==="dispatcher")
    {
      header('Location: admin.php');
    }
    else
    {
      header('Location: worker.php');
    }
  }
}
mysqli_close();
?>
