<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

echo '<div id="back">';
echo '<button onclick="history.back()">Go Back</button>';

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
consoleLog($events);

//Get the current time
$now = strtotime("now");

consoleLog("now",$now);


echo '<ul id="upcomingEvents">';

foreach ($events as $event) {

    // Convert post's modification time to int
    $eventOpenDate = strtotime($event['open_date']);
    consoleLog("open_date",$eventOpenDate);

    echo '<li class="page-list">';

    echo '<div id="upcomingEvent-list">';

        // if($event['open_date'])

        echo    '<a href="event-details.php?id=' . $event['id'] . '">';
        echo    $event['name'];
        echo    '</a>';
        
        echo    '<a href="signUp-form.php?id=' . $event['id'] . '">';
        echo        '<button>';
        echo            'Sign-Up';
        echo        '</button>';
        echo    '</a>';

        if($adminPortal == true){
            echo '<div id="trash-icon">
                    <a href ="delete-eventConfirm.php?id=' . $event['id'] . '">
                        🗑
                    </a>
                </div>';
            }

    echo '</div>';  

    echo '</li>';
}

echo '</ul>';



//ADD IS ONLY FOR ADMIN IN SESSION, SO

if($adminPortal == true){
echo '<div id="add-button">
        <a href ="addE-form.php">
            +
        </a>
      </div>';
}

?>


<?php include 'partials/bottom.php'; ?>