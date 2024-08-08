<?php
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing


$eventID = $_GET['id'] ?? null;

consoleLog($eventID);

if (!$eventID) die('Invalid event ID');

$db = connectToDB();
//setup a query to get all events info
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
    die('There was an error deleting data from the database');
}

header('location: upcoming-events.php'); //if use this can't use console log
?>