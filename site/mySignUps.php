<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

echo '<div id="back">';
echo '<button onclick="history.back()">Go Back</button>';

$studentID = $_SESSION['mySignUps'];
consoleLog($_SESSION);

echo '<h1 class="centerize-title">My Sign-ups!</h1>';



//connect to database
$db = connectToDB();

consoleLog($_SESSION);

//setup a query to get all mysignups events for a student in session
$query = 'SELECT register.event,    
                 events.name,
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

if(!$registrations){
     echo 'You have no sign-ups yet!<br>';
     echo 'would you like to see the upcoming events?<br>';
     echo    '<a href = "upcoming-events.php"><button>Upcoming Events</button></a><br>';
}
else{
        echo '<ul id="upcomingEvents">';

        foreach ($registrations as $register) {
            echo '<li>';

            echo    '<a href="event-details.php?id=' . $register['event'] . '">';
            echo    $register['name'];
            echo    '</a>';
            
            echo    '<a href="cancel-form.php?id=' . $register['event'] . '">';
            echo        '<button>';
            echo            'Cancel';
            echo        '</button>';
            echo    '</a>';

            echo '</li>';
        }

        echo '</ul>';
    }

    echo '<p>Do you want to change user/log out? <a href="mySignUps-logOut.php">Click here!</a></p>';

include 'partials/bottom.php'; 
?>
