<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

// Check for event id in URL
$eventID = $_GET['id'] ?? null;

// see event ID
consoleLog($eventID);

//----------------------------------------------------------------------------------------------------------------
//connect to database
$db = connectToDB();

//setup a query to get event info
$query = 'SELECT name FROM events WHERE id=?';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$eventID]);
    $event = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting events data from the database');
}

// if no event id is regcognize in URL then can't continue
if (!$eventID) die('Invalid event ID');

//see what we got back
consoleLog($event);
//---------------------------------------------------------------------------------------------------------------

    echo '<h2 class="centerize-title">Are you sure you want to delete ' .  $event['name'] . '?</h2>';

    //ask for confirmation
    echo '<div class="complete-box">';
        echo    '<a href = "delete-eventYes.php?id=' . $eventID . '" role="button" class="Edetails">YES</a>';
        echo     '<a href = "delete-eventNo.php" role="button" class="Edetails">NO</a>';
    echo '</div>';

include 'partials/bottom.php';
?>