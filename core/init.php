<?php
$db = mysqli_connect('localhost', 'root', '',  'clothing_store');
if(mysqli_connect_error()){
  echo 'Database connection failed with following errors: '. mysqli_connect_error();
  die();
} 

require_once 'D:/Xammp2/htdocs/PHP-Shop-Good-Copy/Shop-App/config.php';
require_once BASEURL.'/Shop-App/helpers/helpers.php';
?>