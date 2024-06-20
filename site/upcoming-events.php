<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 
?>

<h1 class="centerize-title">Upcoming Events</h1>

<?php

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

echo '<ul id="upcomingEvents">';

foreach ($events as $event) {
    echo '<li>';

    echo    '<a href="event-details.php?code=' . $event['id'] . '">';
    echo    $event['name'];
    echo    '</a>';
    
    echo    '<a href="signUp-form.php">';
    echo        '<button>';
    echo            'Sign-Up';
    echo        '</button>';
    echo    '</a>';

    echo '</li>';
}

echo '</ul>';

//ADD IS ONLY FOR ADMIN IN SESSION...???


echo '<div id="add-button">
        <a href ="form-company.php">
            Add
        </a>
      </div>';

?>


<?php include 'partials/bottom.php'; ?>