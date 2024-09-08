<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

// see form input values
consoleLog($_POST, 'POST');
consoleLog($_FILES, 'FILES');

//Catch-----------------------------------------------------------------------
if(empty($_POST) && empty($_FILES)) die ('There was a problem uploading the file (probably too large)');
//----------------------------------------------------------------------------

// Get other data from form via the $_POST super-global.

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$eventDate = $_POST['event-date'];
$openDate = $_POST['open-date'];
$closeDate = $_POST['close-date'];
$endDate = $_POST['end-date'];

// check for image input by its error code
consoleLog($_FILES['image']['error']);

//----------------------------------------------------------------------------
// connect to DB
$db = connectToDB();

if($_FILES['image']['error'] == 4){
// no image input (error code = 4)
    
    //set up a query to update event details/information
    $query = 'UPDATE events 
    SET name=?, description=?, event_date=?, open_date=?, close_date=?, end_date=? 
    
    WHERE id = ?';

    //Ateempt to run the query
    try {
        $stmt = $db->prepare($query);
        $stmt->execute([$name, $description, $eventDate, $openDate, $closeDate, $endDate, $id]);
        //when updating or deleting we need no fetch
    }
    catch (PDOException $e) {
        consoleLog($e->getMessage(), 'DB Upload Picture', ERROR);
        die('There was an error updating event data to the database 1');
    }

}
else{

    //---------------------------------------------------------------------------------------------------------------
    // Get image data and type of uploaded file from the $_FILES super-global
    [
        'data' => $imageData,
        'type' => $imageType
    ] = uploadedImageData($_FILES['image']);
    //-----------------------------------------------------------------------------------------------------------------
    
    //set up a query to update event details/information
    $query = 'UPDATE events 
    SET name=?, description=?, event_date=?, open_date=?, close_date=?, end_date=?, picture_type=?, picture_data=?
    
    WHERE id = ?';

    //Ateempt to run the query
    try {
        $stmt = $db->prepare($query);
        $stmt->execute([$name, $description, $eventDate, $openDate, $closeDate, $endDate, $imageType, $imageData, $id]);
        //when updating or deleting we need no fetch
    }
    catch (PDOException $e) {
        consoleLog($e->getMessage(), 'DB Upload Picture', ERROR);
        die('There was an error updating event data to the database 2');
    }

}

//----------------------------------------------------------------------------
// Redirect back to see the updated event details
header('Location: event-details.php?id=' . $id);
?>
