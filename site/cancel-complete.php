<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

// Get form data
consoleLog($_POST, 'POST Data');
$studentID = $_POST['studentID'];
$eventID = $_POST['eventID'];
$pin = $_POST['pin'];

// back button
echo '<a href="mySignUps.php" role="button">
    <i data-feather="arrow-left"></i>
    Go Back
    </a>';

//------------------------------------------------------------------------
// connect to database
$db = connectToDB();

//set up a query to get event info
$query = 'SELECT name FROM events WHERE id=?';

// Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$eventID]);
    $event = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB eventID Error', ERROR);
    die('There was an error getting student pin to the database');
}

//-----------------------------------------------------------------------
// setup a query to get student's PIN info
$query = 'SELECT pin FROM students WHERE id=?';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$studentID]);
    $student = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB incorrect pin Error', ERROR);
    die('There was an error getting student pin to the database');
}

//-----------------------------------------------------------------------------
// set up a query to check for repetitive sign-ups
$query = 'SELECT student FROM register WHERE student=?';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$studentID]);
    $register = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB register data Error', ERROR);
    die('There was an error getting register data from the database');
}
//-------------------------------------------------------------------------

if ($student['pin'] == $pin ) {

    echo '<h2 class="centerize-title">Your signed-up to ' . $event['name'] . ' had been cancelled!</h2>';

        //setup a query to cancel signed-up info
        $query = 'DELETE FROM register

        WHERE event = ? AND student = ?';

        //Ateempt to run the query
        try{
        $stmt = $db->prepare($query);
        $stmt->execute([$eventID, $studentID]); 
        //when updating or deleting we need no fetch
        }
        catch (PDOException $e) {
        consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
        die('There was an error deleting data from the database');
        }

    echo '<div class="complete-box">';

    echo   '<p>Nice! You have successfully cancelled your signed-up to 
            <a href= "event-details.php?id=' . $eventID . '">' . $event['name'] . '</a>
            
            <br>
            
            Note: To signed up to events go to 
            <a href= "upcoming-events.php">Upcoming Events!</a>
            
            <br>

            Would to like to return to: </p>';

            echo    '<div>';
            echo    '<a href = "upcoming-events.php" role="button" class="Edetails">Upcoming Events</a>';
            echo    '<a href = "mySignUps.php" role="button" class="Edetails">My Sign-ups</a>';
            echo    '</div>';

    echo    '</div>';
}
else {

    echo '<h2 class="centerize-title">Incorrect PIN!</h2>';

    echo '<div class="complete-box">';
        echo '<p>Try again to cancel your sign-up to ' . $event['name'] . '.</p>';

        echo '<a href = "cancel-form.php?id=' . $eventID . '" role="button" class="Edetails">Try again</a>';

        echo '<br>';

        echo 'Or would you like to return to:';
            echo    '<div>';
            echo    '<a href = "upcoming-events.php" role="button" class="Edetails">Upcoming Events</a>';
            echo    '<a href = "mySignUps.php" role="button" class="Edetails">My Sign-ups</a>';
            echo    '</div>';
    
    echo    '</div>';
}

include 'partials/bottom.php'; ?>