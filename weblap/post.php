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

        }
        else
        {
          header('Location: failedlogin.html');
        }

        mysqli_close($mysqllink);
      }
?>
