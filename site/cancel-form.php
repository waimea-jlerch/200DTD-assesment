<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

// Back Button
echo '<a href="mySignUps.php" role="button">
    <i data-feather="arrow-left"></i>
    Go Back
    </a>';

//----------------------------------------------------------------------------    
// Check for event id in URL
$eventID = $_GET['id'] ?? null;

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

// if no event id is regcognize in URL then cannot continue
if (!$eventID) die('Invalid event ID');

//see what we got back
consoleLog($event);

//---------------------------------------------------------------------------------
// set up a query to get students info
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

echo '<h2 class="centerize-title">Cancel your Sign-up to ' . $event['name'] . '</h2>';

?>

<form method="post" action="cancel-complete.php">

    <input type="hidden" name="eventID" value="<?= $eventID ?>">
    
    <label>Name</label>
        <select name="studentID">
        <?php
        // display list of student for user to select
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

    <input type="submit" value="CANCEL">

</form>

<?php 
include 'partials/bottom.php'; 
?>
