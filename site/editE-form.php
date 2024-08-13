<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

$eventID = $_GET['id'] ?? null;

echo '<a href="event-details.php?id=' . $eventID . '" role="button">
    <i data-feather="arrow-left"></i>
    Go Back
    </a>';

//connect to database
$db = connectToDB();

//setup a query to get event details info
$query = 'SELECT * FROM events WHERE id=?';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$eventID]);
    $event = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB event details Error', ERROR);
    die('There was an error getting event details to the database');
}

?>

<h2 class="centerize-title">Edit <?= $event['name'] ?>'s event details!</h2>

<form method="post" action="editE-complete.php" enctype="multipart/form-data">

    <input name="id" type="hidden" value="<?= $eventID ?>">

    <label>Name</lebel>
    <input name="name" type="text" value="<?= $event['name'] ?>" required>

    <label>Description</lebel>
    <input name="description" type="text" value="<?= $event['description'] ?>">

    <label>Open Date</lebel>
    <input name="open-date" type="datetime-local" value="<?= $event['open_date'] ?>" required>

    <label>Close Date</lebel>
    <input name="close-date" type="datetime-local" value="<?= $event['close_date'] ?>" required>

    <label>End Date</lebel>
    <input name="end-date" type="datetime-local" value="<?= $event['end_date'] ?>" required>

    <p>Preview of existing image:</p>

    <?php
    if(!$event['picture_type'] or !$event['picture_type']){
        
        echo '<p>No existing image</p>';

    }
    else{
    echo   '<img src="load-image.php?id=' . $eventID . '" class="detials-image">';
    }
    ?>

    <label>Picture</lebel>
    <input name="image" type="file" accept="images/*">


    <input type="submit" value="Update">
</form>

<?php 
include 'partials/bottom.php'; 
?>
