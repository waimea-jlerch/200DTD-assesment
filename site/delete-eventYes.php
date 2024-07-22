<?php
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing


$id = $_GET['id'] ?? null;

$db = connectToDB();
//setup a query to get all companies into
$query = 'DELETE FROM events

          WHERE id = ?';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$id]); 
    //when updating or deleting we need no fetch
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error deleting data from the database');
}


header('location: upcoming-events.php'); //if use this can't use console log
?>