<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 


unset($_SESSION['admin']);

consoleLog($_SESSION);


header('location: index.php'); //if use this can't use console log
?>