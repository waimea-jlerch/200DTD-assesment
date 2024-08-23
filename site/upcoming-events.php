<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

echo '<a href="index.php" role="button">
    <i data-feather="arrow-left"></i>
    Go Back
    </a>';

echo '<h1 class="centerize-title">Upcoming Events</h1>';

//connect to database
$db = connectToDB();

//setup a query to get all companies into
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
// consoleLog($events);


//Get the current time
$now = strtotime("now");

//see what we got back
// consoleLog("now",$now);

$eventCount = 0;

echo '<ul id="upcomingEvents">';

foreach ($events as $event) {

    // consoleLog($event['id'], $event['name']);
    // Convert post's modification time to int
    $eventOpenDate = strtotime($event['open_date']);
    // consoleLog("open_date",$eventOpenDate);

    $eventCloseDate = strtotime($event['close_date']);
    // consoleLog("close_date",$eventCloseDate);


    if($now <= $eventCloseDate){

        if($eventOpenDate <= $now or $adminPortal == true){

            $eventCount++;

            echo '<li class="page-list">';
            
            echo '<div class="upcomingEvent-list">';


                echo    '<a href="event-details.php?id=' . $event['id'] . '">';
                echo    '<p class="event-title">' . $event['name'] . '</p>';
                echo    '</a>';

                $eventDate = new DateTimeImmutable($event['event_date']);
                $formattedEventDate = $eventDate->format('\O\n D d M Y \a\t H:i A');

                echo '<div class="date">';
                echo '<p>' . $formattedEventDate . '</p>';
                if($adminPortal == true){
                    $openDate = new DateTimeImmutable($event['open_date']);
                    $formattedOpenDate = $openDate->format('\O\p\e\n \o\n D d M Y \a\t H:i A');
                    echo '<p>' . $formattedOpenDate . '</p>';
                }
                echo '</div>';
                
                echo        '<a href="signUp-form.php?id=' . $event['id'] . '" class="signUp-button">';
                echo            'Sign-Up';
                echo        '</a>';

                    if($adminPortal == true){

                        echo '<a href ="delete-eventConfirm.php?id=' . $event['id'] . '">
                                <i data-feather="trash-2"></i>
                                </a>';
                        }

            echo '</div>';
            echo '</li>';
        }
    }
}


echo '</ul>';

if($eventCount == 0){

    echo '<p class="sub-title">No upcoming events!</p>';

}


//ADD IS ONLY FOR ADMIN IN SESSION, SO

if($adminPortal == true){
echo '<div id="add-button">
        <a href ="addE-form.php">
            <i data-feather="plus"></i>
        </a>
      </div>';
}

include 'partials/bottom.php'; ?>