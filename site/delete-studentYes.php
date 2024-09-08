<?php
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing

// get student id from URL
$id = $_GET['id'] ?? null;

//connect to DB
$db = connectToDB();

//setup a query to get student info
$query = 'DELETE FROM students

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

// redirect back
header('location: student-list.php');
?>