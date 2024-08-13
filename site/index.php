<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

?>

    <div class="index-image">
        <img src="images/index1.jpg">
    </div>

    <div class = "index-buttons">
        <a href = "upcoming-events.php" class="main-button">Upcoming Events</a>
        <a href = "mySignUps-redirect.php" class="main-button">My Sign-ups</a>
    </div>

    <!-- <div class = "index-buttons">
        <button class="main-button">    
            <a href = "upcoming-events.php">Upcoming Events</a>
        </button>

        <button class="main-button">
            <a href = "mySignUps-form.php">My Sign-ups</a>
        </button>
    </div> -->

<?php
    include 'partials/bottom.php';
?>
