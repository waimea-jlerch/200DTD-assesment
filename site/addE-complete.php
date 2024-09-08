<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 


consoleLog($_POST, 'POST');
consoleLog($_FILES, 'FILES');

if(empty($_POST) && empty($_FILES)) die ('There was a problem uploading the file (probably too large)');

//----------------------------------------------------------------------------
// Get other data from form via the $_POST super-global.

$name = $_POST['name'];
$description = $_POST['description'];
$eventDate = $_POST['event-date'];
$openDate = $_POST['open-date'];
$closeDate = $_POST['close-date'];
$endDate = $_POST['end-date'];

//----------------------------------------------------------------------------
// Connect to Database
$db = connectToDB();

if($_FILES['image']['error'] == 4){

    // Insert new event into DB
    $query = 'INSERT INTO events 
            (name, description, event_date, open_date, close_date, end_date)
            VALUES (?, ?, ?, ?, ?, ?)';

    try {
        $stmt = $db->prepare($query);
        $stmt->execute([$name, $description, $eventDate, $openDate, $closeDate, $endDate]);
        $newEventID = $db->lastInsertID();
    }
    catch (PDOException $e) {
        consoleLog($e->getMessage(), 'DB Upload Picture', ERROR);
        die('There was an error adding picture to the database');
    }

}
else{

    // Get image data and type of uploaded file from the $_FILES super-global
    [
        'data' => $imageData,
        'type' => $imageType
    ] = uploadedImageData($_FILES['image']);
    
    // Insert new event + image into DB
    $query = 'INSERT INTO events 
            (name, description, event_date, open_date, close_date, end_date, picture_type, picture_data) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

    try {
        $stmt = $db->prepare($query);
        $stmt->execute([$name, $description, $eventDate, $openDate, $closeDate, $endDate, $imageType, $imageData]);
        $newEventID = $db->lastInsertID();
    }
    catch (PDOException $e) {
        consoleLog($e->getMessage(), 'DB Upload Picture', ERROR);
        die('There was an error adding picture to the database');
    }
}

//----------------------------------------------------------------------------

// Back to see added event
header('Location: event-details.php?id=' . $newEventID);
?>