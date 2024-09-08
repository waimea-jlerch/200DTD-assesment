<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

// back button
echo '<a onclick="history.back()" role="button">
    <i data-feather="arrow-left"></i>
    Go Back
    </a>';

//-------------------------------------------------------------------------------
// connect to database
$db = connectToDB();

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
//-------------------------------------------------------------------------------

echo '<h2 class="centerize-title">View My Sign-ups!</h2>';

?>
<form method="post" action="mySignUps-complete.php">

    <input type="hidden" name="eventID" value="<?= $eventId ?>">
    
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

    <input type="submit" value="VERIFY">

</form>

<?php 
include 'partials/bottom.php'; 
?>
