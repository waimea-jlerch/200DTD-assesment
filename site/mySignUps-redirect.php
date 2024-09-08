<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

// determind where to direct to, based on whether MySignUps session is true
if($_SESSION['mySignUps'] == true){
    header('location: mySignUps.php');
}
else{
    header('location: mySignUps-form.php');
}
?>