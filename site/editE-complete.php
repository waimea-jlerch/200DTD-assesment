<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

$id = $_GET['id'] ?? null;
consoleLog($_POST, 'POST');
consoleLog($_FILES, 'FILES');
if (!$event) die('Invalid event ID');
//----------------------------------------------------------------------------
// Get image data and type of uploaded file from the $_FILES super-global

if(empty($_POST) && empty($_FILES)){

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

        $imageData = $event['picture_data']
        $imageType = $event['picture_type']
}
else{
    [
        'data' => $imageData,
        'type' => $imageType
    ] = uploadedImageData($_FILES['image']);
}

//----------------------------------------------------------------------------
// Get other data from form via the $_POST super-global.

$name = $_POST['name'];
$description = $_POST['description'];
$openDate = $_POST['open-date'];
$closeDate = $_POST['close-date'];
$endDate = $_POST['end-date'];

//----------------------------------------------------------------------------
// Insert the thing data and image into the database

$db = connectToDB();

$query = 'UPDATE events 
            (name, description, open_date, close_date, end_date, picture_type, picture_data) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
            
            WHERE id = ?';

try {
    $stmt = $db->prepare($query);
    $stmt->execute([$name, $description, $openDate, $closeDate, $endDate, $imageType, $imageData]);
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB Upload Picture', ERROR);
    die('There was an error adding picture to the database');
}

// //----------------------------------------------------------------------------
// // Back to see the new thing

header('Location: event-details.php?id=' . $newEventID);

?>