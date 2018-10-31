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
//------------------------------R E G V E G E ---------------------------------------------------------------------------------
//-------------------------------user.php sql code-----------------------------------------------------------------------------
//-------------------------------login code------------------------------------------------------------------------------------
elseif (((isset($_POST['username']) && isset($_POST['password']))))
{
    /*header("Content-type: text/html; charset=utf-8");
    include "php/connect.php";
    $email = $_POST['username'];
    $password = $_POST['password'];
    $sql="SELECT * FROM `customers` WHERE `Email` LIKE '$email' AND `Password` LIKE '$password'";
    $resultset = mysqli_query($mysqllink, $sql );
    $row=mysqli_fetch_row($resultset);*/

    $host="localhost";
    $user="plidrendszer";
    $pass="projektlab";
    $db="plidrendszer";
    $mysqli = new mysqli($host,$user,$pass,$db) or die ('Cannot connect to db');

    mysqli_set_charset($mysqli,"utf8");
    //printf("%s \n",$_POST['username']) ;
    //printf("%s \n",$_POST['password']) ;

    $email = $_POST['username'];
    $password = $_POST['password'];

    if (mysqli_connect_errno())
    {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }

    //check if user has account//
    /*$sql="SELECT `ID`,`FirstName`, `LastName` FROM `customers` WHERE `Email` LIKE ? AND `Password` LIKE ?";
    $result= mysqli_query($mysqli,$sql) or die("User account retrival was not successfull: ".mysqli_error($mysqli));
    $result->bind_param('ss',$email,$password);
    $row=mysqli_fetch_row($result) or die("User account row cannot be received: ".mysqli_error($mysqli));*/

    $stmt = $mysqli->prepare("SELECT `ID`,`FirstName`, `LastName` FROM `customers` WHERE `Email` LIKE ? AND `Password` LIKE ?");
    $stmt->bind_param('ss',$email,$password);
    $stmt->execute() or (header('Location: failedlogin.html'));

    $stmt->bind_result($id,$fname,$lname);
    $stmt->fetch();
    $stmt->close();

    /*var_dump($id);
    var_dump($fname);
    var_dump($lname);*/
    if($id == NULL )
    {
        header('Location: failedlogin.html');
    }
    else
    {
         session_start();
         $name=$lname." ".$fname;
         //storing user data in session
         $_SESSION["name"] = $name;
         $_SESSION["email"] = $email;
         $_SESSION["password"] = $password;
         $_SESSION["id"]= $id;
         //get the row of the user from the linking "subscription_customers"
         //var_dump($id);
         //echo "fuck";
         include "php/connect.php";
         $sql="SELECT * FROM `subscription_customers` WHERE `CustomerID` = '$id'";
         $resultset = mysqli_query($mysqli, $sql ) or die("customer has no subscriptions: ".mysqli_error($mysqli));
         $subrow=mysqli_fetch_row($resultset);

         //check if user has subscription//
         if($subrow != NULL)
         {
           //echo "you";
           include "php/connect.php";
           $sql="SELECT * FROM `subscription_customers` WHERE `CustomerID` = '$id'";
           $resultset = mysqli_query($mysqllink, $sql ) or die("sub names no user no result: ".mysqli_error($mysqllink));
           $subrow=mysqli_fetch_row($resultset);
           if($subrow != NULL)
           {
               $internetid=$subrow[4];
               //var_dump($internetid);
               $tvid=$subrow[6];
               $telid=$subrow[5];
           }
           mysqli_close($mysqllink);
           include "php/connect.php";
           $sql="SELECT `Name` FROM `InternetPacks` WHERE `NetID` = $internetid";
           $resultset = mysqli_query($mysqllink, $sql ) or die("net name no result: ".mysqli_error($mysqllink));
           $internetrow=mysqli_fetch_row($resultset);
           if($internetrow != NULL)
           {
               $internetname =$internetrow[0];
           }
           mysqli_close($mysqllink);
           include "php/connect.php";
           $sql="SELECT `Name` FROM `TelPacks` WHERE `TelPackID` = $telid";
           $resultset = mysqli_query($mysqllink, $sql ) or die("tel name no result: ".mysqli_error($mysqllink));
           $telrow=mysqli_fetch_row($resultset);
           if($telrow != NULL)
           {
               $telname=$telrow[0];
           }
           mysqli_close($mysqllink);
           include "php/connect.php";
           $sql="SELECT `Name` FROM `TVPacks` WHERE `TVID` = $tvid";
           $resultset = mysqli_query($mysqllink, $sql ) or die("tv name no result: ".mysqli_error($mysqllink));
           $tvrow=mysqli_fetch_row($resultset);
           if($tvrow != NULL)
           {
               $tvname=$tvrow[0];
           }
           $_SESSION["internetname"]=$internetname;
           $_SESSION["telname"]=$telname;
           $_SESSION["tvname"]=$tvname;
           mysqli_close($mysqllink);
           //price tabs
           include "php/connect.php";
           $sql="SELECT * FROM `subscription_customers` WHERE `CustomerID` = $id";
           $resultset = mysqli_query($mysqllink, $sql ) or die("price tabs user sql no result: ".mysqli_error($mysqllink));
           $subrow=mysqli_fetch_row($resultset);
           if($subrow != NULL)
           {
               $internetid=$subrow[4];
               $tvid=$subrow[6];
               $telid=$subrow[5];
               $subtime=$subrow[3];
           }
           if($subtime=1)
           {
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
           $_SESSION["internetprice"]=$internetprice;
           $_SESSION["telprice"]=$telprice;
           $_SESSION["tvprice"]=$tvprice;
           $_SESSION["summonthly"]=$summonthly;

           // end of price tabs
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
               $_SESSION["datefrom"]=$datefrom;
               $_SESSION["dateto"]=$dateto;
               $_SESSION["szerzodott"]=$szerzodott;
           }
          }

          $mysqli->close();
        }
            header('Location: user.php');
         }
         else
         {
             $date=date('Y-m-d');
             $sql = "INSERT INTO `subscription_customers`(`CustomerID`, `DateFrom`, `Subtime`, `InternetPackID`, `TelPackID`, `TVPackID`) VALUES ('$id','$date',0,7,4,7);";
             $resultset = mysqli_query($mysqllink, $sql ) or die("new sub 0 subtime data transfer error: ".mysqli_error($mysqllink));
             mysqli_close($mysqllink);
            // header('Location: user.php');
         }
         //-----------------------end of login-----------------------------------------//
         //subscription tabs
         // end of user.php code
         //user sub update form handler
         /*if (isset($_POST['custid']))
         {
             include "php/connect.php";
             $internetupdate = $_POST['Internetupdate'];
             $telefonupdate = $_POST['Telefonupdate'];
             $tvupdate = $_POST['TVupdate'];
             $custid = $_POST['custid'];
             session_start();
             $sql = "UPDATE `subscription_customers` SET `InternetPackID`='$internetupdate' , `TelPackID`='$telefonupdate' , `TVPackID`='$tvupdate' WHERE `CustomerID`=$custid";
             $resultset = mysqli_query($mysqllink, $sql ) or die("update data transfer error: ".mysqli_error($mysqllink));
             mysqli_close($mysqllink);
             $sql="SELECT * FROM `subscription_customers` WHERE `CustomerID` = $custid";
             $resultset = mysqli_query($mysqllink, $sql );
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
             echo "No POST data!";
         }*/
         mysqli_close($mysqllink);
?>
