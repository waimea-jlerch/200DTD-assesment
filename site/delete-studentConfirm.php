<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

// Check for student id in URL
$studentID = $_GET['id'] ?? null;

// see student ID
consoleLog($studentID);

//----------------------------------------------------------------------------------------------
//connect to database
$db = connectToDB();

//setup a query to get student info
$query = 'SELECT forename, surname FROM students WHERE id=?';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$studentID]);
    $student = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting student data from the database');
}

// if no student id is regcognize in URL then can't continue
if (!$studentID) die('Invalid event ID');

//see what we got back
consoleLog($student);

//-----------------------------------------------------------------------------------------------

    echo "<h2 class='centerize-title'>Are you sure you want to delete " .  $student['forename'] . " " . $student['surname'] . "'s record?</h2>";

    //ask for confirmation
    echo '<div class="complete-box">';
    echo    '<a href = "delete-studentYes.php?id=' . $studentID . '" role="button" class="Edetails">YES</a>';
    echo     '<a href = "delete-studentNo.php" role="button" class="Edetails">NO</a>';
    echo '</div>';


include 'partials/bottom.php';
?>