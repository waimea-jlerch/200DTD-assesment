<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

// get event id from URL
$eventID = $_GET['id'] ?? null;
// see event id
consoleLog($eventID);

//------------------------------------------------------------------------
//connect to database
$db = connectToDB();

//setup a query to get event name
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
//------------------------------------------------------------------------


    echo "<h2 class='centerize-title'>Are you sure you want to edit " .  $event['name'] . "'s details?</h2>";

    echo "<h3>Warning!</h3> <p>Proceeding with editing " . $event['name'] .  "'s event details will require you to select the picture again! (unless picture is not needed)</p>";

    //ask for confirmation
    echo '<div>';
    echo    '<a href = "editE-form.php?id=' . $eventID . '"><button>YES</button></a>';
    echo     '<a href = "event-details.php?id=' . $eventID . '"><button>NO</button></a>';
    echo '</div>';


include 'partials/bottom.php';
?>