<?php
$db = mysqli_connect('localhost', 'root', '', 'clothing_store');
if(mysqli_connect_error()){
  echo 'Database connection failed with following errors: '. mysqli_connect_error();
  die();
} else{
    // echo 'Database connected ';
}
?>