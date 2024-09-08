<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php';

// Back Button
echo '<a onclick="history.back()" role="button">
    <i data-feather="arrow-left"></i>
    Go Back
    </a>';

echo '<h1 class="centerize-title">Closed Events</h1>';

//connect to database
$db = connectToDB();

//setup a query to get all events info
$query = 'SELECT * FROM events ORDER BY name ASC';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute();
    $events = $stmt->fetchALL();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}

//see what we got back
consoleLog($events);

// Check how many events are being display
$eventCount = 0;

//Get the current time
$now = strtotime("now");
//see current time
consoleLog("now",$now);
//--------------------------------------------------------------------------

echo '<ul id="upcomingEvents">';

foreach ($events as $event) {

    consoleLog($event['id'], $event['name']);

    // Convert post's modification time to int

    //get events open date from DB
    $eventOpenDate = strtotime($event['open_date']);
    consoleLog("open_date",$eventOpenDate);

    //get events close date from DB
    $eventCloseDate = strtotime($event['close_date']);
    consoleLog("close_date",$eventCloseDate);

    //get events end date from DB    
    $eventEndDate = strtotime($event['end_date']);
    consoleLog("end_date",$eventEndDate);

    //Show events that had already been closed
    if($eventCloseDate <= $now && $now <= $eventEndDate){

        // add to event display checker variable
        $eventCount++;

        echo '<li class="page-list">';

        echo '<div class="upcomingEvent-list">';


            echo    '<a href="event-details.php?id=' . $event['id'] . '">';
            echo    '<p class="event-title">' . $event['name'] . '</p>';
            echo    '</a>';

            // formatting event date
            $eventDate = new DateTimeImmutable($event['event_date']);
            $formattedEventDate = $eventDate->format('\O\n D d M Y \a\t H:i A');

            echo '<div class="date">';
            echo '<p class="close-date">' . $formattedEventDate . '</p>';

            // formatting close date
            $closeDate = new DateTimeImmutable($event['close_date']);
            $formattedCloseDate = $closeDate->format('\C\l\o\s\e\d \o\n D d M Y \a\t H:i A');

            echo '<p class="close-date">' . $formattedCloseDate . '</p>';
            echo '</div>';

            echo '<p> </p>';

            //delete button
            echo '<a href ="delete-eventConfirm.php?id=' . $event['id'] . '">
                        <i data-feather="trash-2"></i>
                    </a>';

        echo '</div>';
        echo '</li>';
    }
}

echo '</ul>';

if($eventCount == 0){
//no closed event display

    echo '<p class="sub-title">No closed events!</p>';
    
}

include 'partials/bottom.php'; ?>