<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

$eventID = $_GET['id'] ?? null;

echo '<a onclick="history.back()" role="button">
    <i data-feather="arrow-left"></i>
    Go Back
    </a>';

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

if (!$eventID) die('Invalid event ID');

//see what we got back
consoleLog($event);

$query = 'SELECT id, forename, surname FROM students ORDER BY forename ASC';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute();
    $students = $stmt->fetchAll();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting students data from the database');
}

//see what we got back
consoleLog($students);

echo '<h2 class="centerize-title">Signing-up to ' . $event['name'] . '</h2>';

?>
<form method="post" action="signUp-complete.php">

    <input type="hidden" name="eventID" value="<?= $eventID ?>">
    
    <label>Name</label>
        <select name="studentID" required>
        <?php

        foreach ($students as $student) {
            echo '<option value="' .$student['id'] . '">';
            echo    $student['forename'] . ' ' . $student['surname'];
            echo  '</option>';
        }
        
        ?>
        </select>

    <label>PIN</label>
        <input name="pin" 
            type="text" 
            placeholder="e.g. 123456 (6-digits) given by international staff"
            minlength="6" 
            maxlength="6" 
            pattern="[0-9]{6}"
            required>

    <input type="submit" value="SIGN UP">

<?php 
include 'partials/bottom.php'; 
?>
