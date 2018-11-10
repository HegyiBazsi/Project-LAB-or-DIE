<?php
//-----------------------------------user sub update form handler--------------------------------------------------------------
if(isset($_POST['packupdate']))
{
	$packupdate=$_POST['packupdate'];
	var_dump($packupdate);
	include "php/connect.php";
  //------------------get data from post----------------------------------------------------------------------------------
  $internetupdate = $_POST['Internetupdate'];
	$telefonupdate = $_POST['Telefonupdate'];
	$tvupdate = $_POST['TVupdate'];
	$custid = $_POST['custid'];
  $site = $_POST['sourcesite'];
  var_dump($internetupdate);
	echo '</br>';
  var_dump($telefonupdate);
	echo '</br>';
  var_dump($tvupdate);
	echo '</br>';
  var_dump($custid);
	echo '</br>';
  var_dump($site);
	echo '</br>';
	echo '</br>';
  //---------------------------------------package ids---------------------------------------------------------------------

  //------newNETid query-----------------------
  $sql="SELECT `NetID` FROM `internetpacks` WHERE `Name` LIKE '$internetupdate'";
	$resultset = mysqli_query($mysqllink,$sql);
	$subrow=mysqli_fetch_row($resultset);
	if($subrow != NULL)
	{
    $newinternetid = intval($subrow[0]);
  }

  //------newTVid query-----------------------
  $sql="SELECT `TVID` FROM `tvpacks` WHERE `Name` LIKE '$tvupdate'";
	$resultset = mysqli_query($mysqllink,$sql);
	$subrow=mysqli_fetch_row($resultset);
	if($subrow != NULL)
	{
    $newtvid = intval($subrow[0]);
  }

  //------newTELid query-----------------------
  $sql="SELECT `TelPackID` FROM `telpacks` WHERE `Name` LIKE '$telefonupdate'";
	$resultset = mysqli_query($mysqllink,$sql);
	$subrow=mysqli_fetch_row($resultset);
	if($subrow != NULL)
	{
    $newtelefonid = intval($subrow[0]);
  }
	/*
	print_r('net:');
  var_dump($newinternetid);
	echo '</br>';
	print_r('tv:');
  var_dump($newtvid);
	echo '</br>';
	echo('tel:');
  var_dump($newtelefonid);
	echo '</br>';
	*/

  //------update subscription_customers row-----------------------
	$sql = "UPDATE `subscription_customers` SET `InternetPackID`='$newinternetid' , `TelPackID`='$newtelefonid' , `TVPackID`='$newtvid' WHERE `CustomerID`=$custid";
	$resultset = mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));

  //------get customer data back to return to user.php or admin.php----------------------------------------
	if($site=="user")
	{
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
				$email=$row[9];
				$password=$row[10];
				session_start();
				$_SESSION["name"] = $name;
				$_SESSION["email"] = $email;
				$_SESSION["password"] = $password;
				$_SESSION["id"] = $custid;
				header('Location: user.php');
			}
		}
	}
	else
	{
		header('Location: admin.php');
	}
}
if(isset($_POST['userupdate']))
{
	include "php/connect.php";


	$userupdate=$_POST['userupdate'];
	//var_dump($userupdate);
	$custid = intval($_POST['custid']);
	//var_dump($custid);
  $site = $_POST['sourcesite'];


	$sql="SELECT `FirstName`,`LastName`,`Telnum`,`Email`,`Password` FROM `customers` WHERE `ID`=$custid";
	$resultset = mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));
	$userinforow=mysqli_fetch_row($resultset);
	$fname=$userinforow[0];
	$lname=$userinforow[1];
	$telnum=$userinforow[2];
	$email=$userinforow[3];
	$password=$userinforow[4];

	//---------------------updateuser form data extraction and update handler--------------------------------------
	if(isset($_POST['fnameupdate']))
	{
		$fnameupdate=$_POST['fnameupdate'];
		var_dump($fnameupdate);
		$sql = "UPDATE `customers` SET `FirstName`='$fnameupdate', `LastName`='$lname',`Telnum`='$telnum',`Email`='$email',`Password`='$password' WHERE `ID`=$custid";
		$resultset = mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));
	}

	if(isset($_POST['lnameupdate']))
	{
		$lnameupdate=$_POST['lnameupdate'];
		var_dump($lnameupdate);
		$sql = "UPDATE `customers` SET `FirstName`='$fname', `LastName`='$lnameupdate',`Telnum`='$telnum',`Email`='$email',`Password`='$password' WHERE `ID`=$custid";
		$resultset = mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));
	}

	if(isset($_POST['emailupdate']))
	{
		$emailupdate=$_POST['emailupdate'];
		var_dump($emailupdate);
		$sql = "UPDATE `customers` SET `FirstName`='$fname', `LastName`='$lname',`Telnum`='$telnum',`Email`='$emailupdate',`Password`='$password' WHERE `ID`=$custid";
		$resultset = mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));
	}

	if(isset($_POST['passwordupdate']) && isset($_POST['passwordupdatecheck']))
	{
		$passwordupdate=$_POST['passwordupdate'];
		$passwordupdatecheck=$_POST['passwordupdatecheck'];
		var_dump($passwordupdate);
		if($passwordupdate===$passwordupdatecheck)
		{
			$sql = "UPDATE `customers` SET `FirstName`='$fname', `LastName`='$lname',`Telnum`='$telnum',`Email`='$email',`Password`='$passwordupdate' WHERE `ID`=$custid";
			$resultset = mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));
		}

	}

	if(isset($_POST['telnumupdate']))
	{
		$telnumupdate=$_POST['telnumupdate'];
		var_dump($telnumupdate);
		$sql = "UPDATE `customers` SET `FirstName`='$fname', `LastName`='$lname',`Telnum`='$telnumupdate',`Email`='$email',`Password`='$password' WHERE `ID`=$custid";
		$resultset = mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));
	}

	//------get customer data back to return to user.php or admin.php----------------------------------------
	if($site=="user")
	{
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
				$email=$row[9];
				$password=$row[10];
				session_start();
				$_SESSION["name"] = $name;
				$_SESSION["email"] = $email;
				$_SESSION["password"] = $password;
				$_SESSION["id"] = $custid;
				header('Location: user.php');
			}
		}
	}
	else
	{
		header('Location: admin.php');
	}
}
?>
