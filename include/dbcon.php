<?php 
 $host      = "localhost";
 $username  = "root";
 $passwrod  = "";
 $dbName    = "furniture-shop";

  $con = mysqli_connect($host,$username,$passwrod,$dbName);
  if (!function_exists('currency_format')) {
    function currency_format($number, $suffix = '') {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . "{$suffix}";
        }
    }
  }
