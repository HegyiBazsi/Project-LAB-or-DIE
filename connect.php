<?php

    // az adatbazis kapcsolat parameterei
    $host="localhost";
    $user="root";
    $pass="";
    $db="plidrendszer";

    // adatbazis kapcsolat letrehozasa
    $mysqllink=mysqli_connect($host,$user,$pass) or die("Could not connect");

    // adatbazis kivalasztasa
    mysqli_select_db($mysqllink,$db) or die("Could not select database");

?>
