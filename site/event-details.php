<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

echo '<a href="upcoming-events.php" role="button">
    <i data-feather="arrow-left"></i>
    Go Back
    </a>';

$id = $_GET['id'] ?? null;

//connect to database
$db = connectToDB();

//setup a query to get all events into
$query = 'SELECT * FROM events WHERE id=?';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $event = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting event detials data from the database');
}

if (!$event) die('Invalid event ID');

echo '<h1 class="centerize-title">' .  $event['name']  . '</h1>';

//see what we got back
consoleLog($event);

//Get the current time
$now = strtotime("now");
consoleLog("now",$now);

echo '<div class="content-box">';

    //If image is null thengray box will be displayed instead
    if(!$event['picture_type'] or !$event['picture_type']){
        
        echo '<div class="null-image">';
            echo '<p>' .  $event['name']  . '</p>';
        echo '</div>';

    }
    else{ echo   '<img src="load-image.php?id=' . $id . '" class="detials-image">'; }

        echo '<div class="event-detials">';

        $closeDate = new DateTimeImmutable($event['close_date']);
        $formattedCloseDate = $closeDate->format('\C\l\o\s\e\d \f\o\r \s\i\g\n\-\u\p \o\n D d M Y \a\t H:i A');

        $eventDate = new DateTimeImmutable($event['event_date']);
        $formattedEventDate = $eventDate->format('\O\n D d M Y \a\t H:i A');

        //format closed date into strtotime
        $eventCloseDate = strtotime($event['close_date']);
        consoleLog("close_date",$eventCloseDate);

        echo '<p class="descriptions">' . $event['description'] . '</p>';

        echo '<p class="date">' . $formattedEventDate . '</p>';

        echo '<p class="date">' . $formattedCloseDate . '</p>';

        echo '<p>' . $event['open_date'] . '</p>';

        echo '<div class="E-button">';
            echo    '<a href="WhosGoing.php?id=' . $id . '" role="Edetails-button">';
            echo            'See who else is going';
            echo    '</a>';

        if($now <= $eventCloseDate){
                echo    '<a href="signUp-form.php?id=' . $id . '" role="Edetails-button">';
                echo            'Sign-Up';
                echo    '</a>';
        }

        if($adminPortal == true){    
                echo    '<a href="editE-form.php?id=' . $id . '" role="Edetails-button">';
                echo            'Edit Details';
                echo    '</a>';

            echo '<a href ="delete-eventConfirm.php?id=' . $event['id'] . '" role="Edetails-button">';
            echo            'Delete';
            echo '</a>';

        }
        echo '</div>';

    echo '</div>';

echo '</div>';

?>

<?php include 'partials/bottom.php';