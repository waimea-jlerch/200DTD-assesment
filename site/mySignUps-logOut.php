<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

//stop admin portal by making it false
unset($_SESSION['mySignUps']);


header('location: mySignUps-form.php'); //if use this can't use console log
?>