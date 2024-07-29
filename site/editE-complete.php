<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

consoleLog($_POST, 'POST');
consoleLog($_FILES, 'FILES');


//Catch-----------------------------------------------------------------------
if(empty($_POST) && empty($_FILES)) die ('There was a problem uploading the file (probably too large)');
//----------------------------------------------------------------------------

// Get other data from form via the $_POST super-global.

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$openDate = $_POST['open-date'];
$closeDate = $_POST['close-date'];
$endDate = $_POST['end-date'];



consoleLog($_FILES['image']['error']);
//----------------------------------------------------------------------------

$db = connectToDB();

if($_FILES['image']['error'] == 4){

    $query = 'UPDATE events 
    SET name=?, description=?, open_date=?, close_date=?, end_date=? 
    
    WHERE id = ?';

    try {
        $stmt = $db->prepare($query);
        $stmt->execute([$name, $description, $openDate, $closeDate, $endDate, $id]);
    }
    catch (PDOException $e) {
        consoleLog($e->getMessage(), 'DB Upload Picture', ERROR);
        die('There was an error updating event data to the database 1');
    }

}
else{

    // Get image data and type of uploaded file from the $_FILES super-global
    [
        'data' => $imageData,
        'type' => $imageType
    ] = uploadedImageData($_FILES['image']);
    
    $query = 'UPDATE events 
    SET name=?, description=?, open_date=?, close_date=?, end_date=?, picture_type=?, picture_data=?
    
    WHERE id = ?';

    try {
        $stmt = $db->prepare($query);
        $stmt->execute([$name, $description, $openDate, $closeDate, $endDate, $imageType, $imageData, $id]);
    }
    catch (PDOException $e) {
        consoleLog($e->getMessage(), 'DB Upload Picture', ERROR);
        die('There was an error updating event data to the database 2');
    }

}

//----------------------------------------------------------------------------
// // Back to see the new thing

header('Location: event-details.php?id=' . $id);
?>
