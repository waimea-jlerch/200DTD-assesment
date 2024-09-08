<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

consoleLog($_POST, 'POST Data');

// Get form data
$studentID = $_POST['studentID'];
$eventID = $_POST['eventID'];
$pin = $_POST['pin'];

// back button
echo '<a href="event-details.php?id=' . $eventID . '" role="button">
    <i data-feather="arrow-left"></i>
    Go Back
    </a>';

//--------------------------------------------------------------------------------
// connect to database
$db = connectToDB();

// set up a query to get event name
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

//--------------------------------------------------------------------------------
//setup a query to get student's PIN info
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

//checking for repetitive sign-ups
$query = 'SELECT student FROM register WHERE student=? AND event=?';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$studentID, $eventID]);
    $register = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB register data Error', ERROR);
    die('There was an error getting register data from the database');
}

// see what we get back
consoleLog($register);

//-------------------------------------------------------------------------


if ($register == NULL && $student['pin'] == $pin){
// all input is correct

        echo '<h2 class="centerize-title">Sign-up to ' . $event['name'] . ' complete!</h2>';


        //setup a query to get all companies into
        $query = 'INSERT INTO register 
                (student, event)
                VALUES (?, ?)';

        //Ateempt to run the query
        try{
            $stmt = $db->prepare($query);
            $stmt->execute([$studentID, $eventID]);
        }
        catch (PDOException $e) {
            consoleLog($e->getMessage(), 'DB Sign-up Error', ERROR);
            die('There was an error adding data to the database');
        }

        echo '<div class="complete-box">';

        echo   '<p>Nice! You have successfully signed-up to 
                <a href= "event-details.php?id=' . $eventID . '">' . $event['name'] . '</a>
                
                <br>
                
                Note: To cancel signed up events go to 
                <a href= "mySignUps-redirect.php">my sign-ups!</a>
                
                <br>

                Would to like to return to: </p>';

                echo    '<div>';
                echo    '<a href = "upcoming-events.php" role="button" class="Edetails">Upcoming Events</a>';
                echo    '<a href = "mySignUps-redirect.php" role="button" class="Edetails">My Sign-ups</a>';
                echo    '</div>';

        echo    '</div>';

}
elseif($student['pin'] != $pin){
// pin is wrong

    echo '<h2 class="centerize-title">Incorrect PIN!</h2>';
    
    echo '<div class="complete-box">';

    echo '<p>Try again to sign-up to 
         <a href= "event-details.php?id=' . $eventID . '">' . $event['name'] . '</a>.</p>';
    echo '<a href = "signUp-form.php?id=' . $eventID . '"  role="button" class="Edetails">Try again</a>';

    echo '<br>';

    echo 'Or would you like to return to:';
        echo    '<div>';
        echo    '<a href = "upcoming-events.php" role="button" class="Edetails">Upcoming Events</a>';
        echo    '<a href = "mySignUps-redirect.php" role="button" class="Edetails">My Sign-ups</a>';
        echo    '</div>';

        echo    '</div>';
}
else{
// repetitive sign-up

    echo '<h2 class="centerize-title">Sign-up for ' . $event['name'] . ' completed!</h2>';

    echo '<div class="complete-box">';
    
    echo 'Looks like you have already signed-up to 
          <a href= "event-details.php?id=' . $eventID . '">' . $event['name'] . '</a>!<br>';

    echo 'would you like to return to:';        
        echo    '<div>';
        echo    '<a href = "upcoming-events.php"  role="button" class="Edetails">Upcoming Events</a>';
        echo    '<a href = "mySignUps-redirect.php"  role="button" class="Edetails">My Sign-ups</a>';
        echo    '</div>';

        echo    '</div>';
}    

include 'partials/bottom.php'; ?>