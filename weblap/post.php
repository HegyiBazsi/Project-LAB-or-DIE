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
?>
