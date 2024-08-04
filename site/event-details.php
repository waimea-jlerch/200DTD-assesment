<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

$id = $_GET['id'] ?? null;

//connect to database
$db = connectToDB();

//setup a query to get all companies into
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

//add image if null then display a gray box with ' no image ' ?

echo '<div class="content-box">';

    if(!$event['picture_type'] or !$event['picture_type']){
        
        echo '<div class="null-image">';
            echo '<p>' .  $event['name']  . '</p>';
        echo '</div>';

    }
    else{
    echo   '<img src="load-image.php?id=' . $id . '" class="detials-image">';
    }

    echo '<div class="event-detials">';

        $closeDate = new DateTimeImmutable($event['close_date']);
        $formattedcloseDate = $closeDate->format('\C\l\o\s\e\d \f\o\r \s\i\g\n\-\u\p \o\n d M Y \a\t H:i A');

        echo '<p class="descriptions">' . $event['description'] . '</p>';

        echo '<p class="close-date">' . $formattedcloseDate . '</p>';

        echo '<p>' . $event['open_date'] . '</p>';

        echo    '<a href="WhosGoing.php?id=' . $id . '">';
            echo        '<button>';
            echo            'See who else is going';
            echo        '</button>';
            echo    '</a>';

        echo    '<a href="signUp-form.php?id=' . $id . '">';
            echo        '<button>';
            echo            'Sign-Up';
            echo        '</button>';
            echo    '</a>';

        if($adminPortal == true){    
            echo    '<a href="editE-form.php?id=' . $id . '">';
                echo        '<button>';
                echo            'Edit Details';
                echo        '</button>';
                echo    '</a>';
        }

    echo '</div>';

echo '</div>';

?>

<?php include 'partials/bottom.php';