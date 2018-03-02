<?php

    // az adatbazis kapcsolat parameterei

    $host="localhost";
    $user="plidrendszer";
    $pass="projektlab";
    $db="plidrendszer";

    // adatbazis kapcsolat letrehozasa
    $mysqllink=mysqli_connect($host,$user,$pass) or die("Could not connect");

    // adatbazis kivalasztasa
    mysql_query("SET NAMES UTF8", $mysqllink);
    mysql_query("SET CHARACTER SET UTF8", $mysqllink);
    mysqli_select_db($mysqllink,$db) or die("Could not select database");


?>
