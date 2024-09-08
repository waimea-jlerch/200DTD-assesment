<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

// get event id in URL
$eventID = $_GET['id'] ?? null;

// back button
echo '<a href="event-details.php?id=' . $eventID . '" role="button">
    <i data-feather="arrow-left"></i>
    Go Back
    </a>';

// Get the current time
$now = strtotime("now");
// see current time
consoleLog("now",$now);

//-----------------------------------------------------------------------------------------------
//connect to database
$db = connectToDB();

//setup a query to get event info
$query = 'SELECT name, close_date FROM events WHERE id=?';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$eventID]);
    $event = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting event details data from the database');
}

// if no event id is regcognize in URL then cannot continue
if (!$event) die('Invalid event ID');

//-----------------------------------------------------------------------------------------------

echo '<h1 class="centerize-title">Resgistrations for ' . $event['name'] . '!</h1>';

//-----------------------------------------------------------------------------------------------
//setup a query to get students registration info
$query = 'SELECT    students.forename,
                    students.surname, 
                    students.year,
                    students.nationality,
                    events.name

                FROM students
                JOIN register ON register.student = students.id
                JOIN events ON register.event = events.id

                WHERE register.event=?

        ORDER BY students.forename ASC';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$eventID]);
    $registrations = $stmt->fetchAll();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting student sign-ups data from the database');
}

//-----------------------------------------------------------------------------------------------

// format event close date from datetime to strtotime
$eventCloseDate = strtotime($event['close_date']);
// see what we get back
consoleLog("close_date",$eventCloseDate);

// formatting event close date
$closeDate = new DateTimeImmutable($event['close_date']);
$formattedcloseDate = $closeDate->format('\C\l\o\s\e\d \f\o\r \s\i\g\n\-\u\p \s\i\n\c\e D d M Y \a\t H:i A');

//see what we get back
consoleLog($registrations);

if (!$registrations) {
// no registrations for this event

    if($now <= $eventCloseDate){
        echo '<p class="sub-title">Be the first to sign-up!</p>';
        echo    '<a href="signUp-form.php?id=' . $eventID . '" role="button" class="main-button">Sign-Up</a>';
    }
    else{
        echo '<p>No sign-ups for ' . $event['name'] . '</p>';

        echo $formattedcloseDate;

    }

}
else {

    // WhosGoing table
    echo '<div class="list-table">';
    echo '<table>
            <tr>
                <th>Name</th>
                <th>Year Level</th>
                <th>Nationality</th>
            </tr>';

    foreach ($registrations as $registration) {
        echo '<tr>';
        echo    '<td>' . '<p>' . $registration['forename'] . " " . $registration['surname']  . '</p>'. '</td>'; 
        echo    '<td>' . $registration['year'] . '</td>';
        echo    '<td>' . $registration['nationality'];
        echo '</tr>'; 
}

echo '</table>';
echo '</div>';

        if($now <= $eventCloseDate){
            // event is open for sign-up
            echo    '<a href="signUp-form.php?id=' . $eventID . '" role="button" class="main-button">';
            echo        'Sign-up now!';
            echo    '</a>';
        }
        else{
            // event is closed for sign-up
            echo '<p class="sub-title">' . $formattedcloseDate . '</p>';
        }

}

include 'partials/bottom.php';
?>