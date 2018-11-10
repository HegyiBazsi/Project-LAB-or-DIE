<?php

    // az adatbazis kapcsolat parameterei

    $host="localhost";
    $user="plidrendszer";
    $pass="projektlab";
    $db="plidrendszer";

    // adatbazis kapcsolat letrehozasa
    $mysqllink=mysqli_connect($host,$user,$pass) or die("Could not connect");

    // adatbazis kivalasztasa
    mysqli_select_db($mysqllink,$db) or die("Could not select database");
    mysqli_query($mysqllink,"SET NAMES UTF8");
    mysqli_query($mysqllink,"SET CHARACTER SET UTF8");


?>
