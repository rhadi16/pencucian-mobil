<?php

  $databaseHost = 'localhost';
  $databaseName = 'pencucian-mobil';
  $databaseUsername = 'root';
  $databasePassword = '';
   
  $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName, '3306'); 
  
  date_default_timezone_set('Asia/Makassar');

?>