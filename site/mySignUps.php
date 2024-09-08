<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

// back button
echo '<a href="index.php" role="button">
    <i data-feather="arrow-left"></i>
    Go Back
    </a>';

// get student id via session value
$studentID = $_SESSION['mySignUps'];
consoleLog($_SESSION);

//----------------------------------------------------------------------------------
//connect to database
$db = connectToDB();

//setup a query to get all mysignups events for the student in session
$query = 'SELECT register.event,    
                 events.name,
                 events.close_date,
                 events.end_date,
                 register.student

        FROM register
        JOIN events ON register.event = events.id

        WHERE register.student= ?

        ORDER BY events.name ASC';

///Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$studentID]);
    $registrations = $stmt->fetchALL();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting games data from the database');
}
//see what we got back
consoleLog($registrations);

//-----------------------------------------------------------------------------------

// Get the current time
$now = strtotime("now");
// see current time
consoleLog("now",$now);

// Check how many events are being display
$eventCount = 0;

echo '<h1 class="centerize-title">My Sign-ups!</h1>';

    echo '<ul id="upcomingEvents">';

    foreach ($registrations as $register) {

        //format closed date into strtotime
        $eventCloseDate = strtotime($register['close_date']);
        consoleLog("close_date",$eventCloseDate);

        //format end date into strtotime
        $eventEndDate = strtotime($register['end_date']);
        consoleLog("end_date",$eventEndDate);

        if($now < $eventEndDate){
        // display event that have not reach end date

            // add to event display checker variable
            $eventCount++;

            if($eventCloseDate <= $now){
                echo '<li class="closed">';
            }
            elseif($now <= $eventCloseDate){
                echo '<li class="page-list">';
            }

            echo '<div class="mySignUps-list">';

            // formatting event close date
            $closeDate = new DateTimeImmutable($register['close_date']);
            $formattedcloseDate = $closeDate->format('\C\l\o\s\e\d \f\o\r \s\i\g\n\-\u\p\!');
            
            echo    '<a href="event-details.php?id=' . $register['event'] . '">';
            echo    $register['name'];
            echo    '</a>';
            
            if($eventCloseDate <= $now){
            // closed event (cannot cancel anymore)
                echo    ' ' . $formattedcloseDate;
            }
            
            if($now <= $eventCloseDate){
            // event that is not yet closed (able to cancel)
                echo    '<a href="cancel-form.php?id=' . $register['event'] . '" class="signUp-button">';
                echo            'Cancel';
                echo    '</a>';
            }

            echo '</div>';
            echo '</li>';
        }
    }

    echo '</ul>';

    if($eventCount == 0){
    //no event to display 

        echo    '<p class="sub-title">You have no sign-ups yet!</p>';
        echo    '<p class="sub-title">Would you like to see the upcoming events?</p>';
        echo    '<a href = "upcoming-events.php" role="button" class="main-button">Upcoming Events</a>';
    
    }

    // log-out/change user button
    echo '<p id="msp-log">Do you want to change user/log out? <a href="mySignUps-logOut.php">Click here!</a></p>';

include 'partials/bottom.php'; 
?>
