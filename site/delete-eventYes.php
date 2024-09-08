<?php
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing

// Check for event id in URL
$eventID = $_GET['id'] ?? null;

// see event ID
consoleLog($eventID);

// if no event id is regcognize in URL then display error
if (!$eventID) die('Invalid event ID');

//--------------------------------------------------------------------------------------
// connect to DB
$db = connectToDB();

//setup a query to delete all register info in an event
$query = 'DELETE FROM register

          WHERE event = ?';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$eventID]); 
    //when updating or deleting we need no fetch
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error deleting registering data from the database');
}

//----------------------------------------------------------------------------------------
//setup a query to delete an event from DB
$query = 'DELETE FROM events

          WHERE id = ?';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$eventID]); 
    //when updating or deleting we need no fetch
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error deleting event data from the database');
}
//-------------------------------------------------------------------------------------------

//redirect back
header('location: upcoming-events.php');
?>