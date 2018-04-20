<?php
      header("Content-type: text/html; charset=utf-8");
      if(isset($_POST['lastname']))
      {
        include "php/connect.php";
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $bdate = $_POST['birthdate'];
        $zip =  $_POST['cityzip'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $address = $_POST['address'];
        $tnum = $_POST['phonenumber'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "INSERT INTO `Customers`(`FirstName`, `LastName`, `BirthDate`, `CityZip`, `City`, `Street`, `Address`, `Telnum`, `Email`, `Password`) VALUES ('$fname','$lname','$bdate','$zip','$city','$street','$address','$tnum','$email','$password');";
        $resultset = mysqli_query($mysqllink, $sql ) or die("data transfer error: ".mysqli_error($mysqllink));
        mysqli_close($mysqllink);

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



        header('Location: index.html');
      }
      //user.php sql code
      elseif (isset($_POST['username']) && isset($_POST['password']))
      {
        header("Content-type: text/html; charset=utf-8");
        include "php/connect.php";
        $email = $_POST['username'];
        $password = $_POST['password'];
        $sql="SELECT * FROM `Customers` WHERE `Email` LIKE '$email' AND `Password` LIKE '$password'";
        $resultset = mysqli_query($mysqllink, $sql );
        $row=mysqli_fetch_row($resultset);
        if($row != NULL)
        {
          $id=$row[0];
          $name=$row[2]." ".$row[1];

          session_start();

          $_SESSION["name"] = $name;
          $_SESSION["email"] = $email;
          $_SESSION["password"] = $password;
          $_SESSION["id"]= $id;
          $sql="SELECT * FROM `Subscription_Customers` WHERE `CustomerID` = $id";
          $resultset = mysqli_query($mysqllink, $sql );
          $subrow=mysqli_fetch_row($resultset);

          if($subrow != NULL)
          {
            header('Location: user.php');
          }
          else
          {
            $date=date('Y-m-d');

            $sql = "INSERT INTO `Subscription_Customers`(`CustomerID`, `DateFrom`, `Subtime`, `InternetPackID`, `TelPackID`, `TVPackID`) VALUES ('$id','$date',0,'',4,'');";
            $resultset = mysqli_query($mysqllink, $sql ) or die("data transfer error: ".mysqli_error($mysqllink));
            mysqli_close($mysqllink);
            header('Location: user.php');
          }

          //subscription tabs
          include "php/connect.php";
          $sql="SELECT * FROM `Subscription_Customers` WHERE `CustomerID` = $id";
          $resultset = mysqli_query($mysqllink, $sql ) or die("no result: ".mysqli_error($mysqllink));
          $subrow=mysqli_fetch_row($resultset);
          if($subrow != NULL)
          {
            $internetid=$subrow[4];
            $tvid=$subrow[6];
            $telid=$subrow[5];
          }

          mysqli_close($mysqllink);
          include "php/connect.php";

          $sql="SELECT `Name` FROM `InternetPacks` WHERE `NetID` = $internetid";
          $resultset = mysqli_query($mysqllink, $sql ) or die("no result: ".mysqli_error($mysqllink));
          $internetrow=mysqli_fetch_row($resultset);
          if($internetrow != NULL)
          {

            $internetname =$internetnam.$internetrow[0];
          }
          else
          {
            $internetname="nincs";
          }

          mysqli_close($mysqllink);
          include "php/connect.php";

          $sql="SELECT `TelPackName` FROM `TelPacks` WHERE `TelPackID` = $telid";
          $resultset = mysqli_query($mysqllink, $sql ) or die("no result: ".mysqli_error($mysqllink));
          $telrow=mysqli_fetch_row($resultset);
          if($telrow != NULL)
          {
            $telname=$telrow[0];
          }
          else
          {
            $telname="nincs";
          }

          mysqli_close($mysqllink);
          include "php/connect.php";

          $sql="SELECT `Name` FROM `TVPacks` WHERE `TVID` = $tvid";
          $resultset = mysqli_query($mysqllink, $sql ) or die("no result: ".mysqli_error($mysqllink));
          $tvrow=mysqli_fetch_row($resultset);
          if($tvrow != NULL)
          {
            $tvname=$tvrow[0];
          }
          else
          {
            $tvname="nincs";
          }
          $_SESSION["internetname"]=$internetname;
          $_SESSION["telname"]=$telname;
          $_SESSION["tvname"]=$tvname;
          mysqli_close($mysqllink);

          //price tabs
          include "php/connect.php";
          $sql="SELECT * FROM `Subscription_Customers` WHERE `CustomerID` = $id";
          $resultset = mysqli_query($mysqllink, $sql ) or die("no result: ".mysqli_error($mysqllink));
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
            $resultset = mysqli_query($mysqllink, $sql ) or die("no result: ".mysqli_error($mysqllink));
            $internetrow=mysqli_fetch_row($resultset);
            if($internetrow != NULL)
            {
              $internetprice=$internetrow[0];
            }
            else
            {
              $internetprice=0;
            }

            $sql="SELECT `MonthlyPrice` FROM `TelPacks` WHERE `TelPackID` = $telid";
            $resultset = mysqli_query($mysqllink, $sql ) or die("no result: ".mysqli_error($mysqllink));
            $telrow=mysqli_fetch_row($resultset);
            if($telrow != NULL)
            {
              $telprice=$telrow[0];
            }
            else
            {
              $telprice=0;
            }

            $sql="SELECT `oneyear_price` FROM `TVPacks` WHERE `TVID` = $tvid";
            $resultset = mysqli_query($mysqllink, $sql ) or die("no result: ".mysqli_error($mysqllink));
            $tvrow=mysqli_fetch_row($resultset);
            if($tvrow != NULL)
            {
              $tvprice=$tvrow[0];
            }
            else
            {
              $tvprice=0;
            }

            mysqli_close($mysqllink);

            $summonthly=$internetprice+$telprice+$tvprice;
          }
          elseif ($subtime=2)
          {
            $sql="SELECT `twoyear_price` FROM `InternetPacks` WHERE `NetID` = $internetid";
            $resultset = mysqli_query($mysqllink, $sql ) or die("no result: ".mysqli_error($mysqllink));
            $internetrow=mysqli_fetch_row($resultset);
            if($internetrow != NULL)
            {
              $internetprice=$internetrow[0];
            }
            else
            {
              $internetprice=0;
            }

            $sql="SELECT `MonthlyPrice` FROM `TelPacks` WHERE `TelPackID` = $telid";
            $resultset = mysqli_query($mysqllink, $sql ) or die("no result: ".mysqli_error($mysqllink));
            $telrow=mysqli_fetch_row($resultset);
            if($telrow != NULL)
            {
              $telprice=$telrow[0];
            }
            else
            {
              $telprice=0;
            }

            $sql="SELECT `twoyear_price` FROM `TVPacks` WHERE `TVID` = $tvid";
            $resultset = mysqli_query($mysqllink, $sql ) or die("no result: ".mysqli_error($mysqllink));
            $tvrow=mysqli_fetch_row($resultset);
            if($tvrow != NULL)
            {
              $tvprice=$tvrow[0];
            }
            else
            {
              $tvprice=0;
            }

            mysqli_close($mysqllink);

            $summonthly=$internetprice+$telprice+$tvprice;
          }
          else
          {
            $sql="SELECT `MonthlyPrice` FROM `TelPacks` WHERE `TelPackID` LIKE '$telid'";
            $resultset = mysqli_query($mysqllink, $sql ) or die("no result: ".mysqli_error($mysqllink));
            $telrow=mysqli_fetch_row($resultset);
            if($telrow != NULL)
            {
              $telprice=$telrow[4];
            }
            else
            {
              $telprice=0;
            }

            $internetprice=0;
            $tvprice=0;

            $summonthly=$internetprice+$telprice+$tvprice;
          }

          $_SESSION["internetprice"]=$internetprice;
          $_SESSION["telprice"]=$telprice;
          $_SESSION["tvprice"]=$tvprice;
          $_SESSION["summonthly"]=$summonthly;

        }
        else
        {
          header('Location: failedlogin.html');
        }

        if(isset($_GET['ertettem'])
        {
          session_start();
          $id=$_SESSION["id"];
          $sql="DELETE FROM `Customers` WHERE `ID` = $id ";
          $resultset = mysqli_query($mysqllink, $sql ) or die("data transfer error: ".mysqli_error($mysqllink));
          mysqli_close($mysqllink);

          $sql="DELETE * FROM `Subscription_Customers` WHERE `CustomerID` = $id";
          $resultset = mysqli_query($mysqllink, $sql ) or die("data transfer error: ".mysqli_error($mysqllink));
          mysqli_close($mysqllink);
          header('Location: index.html');
        }
        else
        {
          session_start();

          $_SESSION["name"] = $name;
          $_SESSION["email"] = $email;
          $_SESSION["password"] = $password;
          $_SESSION["id"]= $id;
          $sql="SELECT * FROM `Subscription_Customers` WHERE `CustomerID` = $id";
          $resultset = mysqli_query($mysqllink, $sql );
          $subrow=mysqli_fetch_row($resultset);

          if($subrow != NULL)
          {
            header('Location: user.php');
          }
        }
        mysqli_close($mysqllink);
      }

?>
