<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

echo '<h1 class="centerize-title">Adding Company to Database...</h1>';

consoleLog($_POST, 'POST Data');

// Get form data
$student = $_POST['id'];
$event = $_POST['event'];


echo '<p>id: ' . $student;
echo '<p>event: ' . $event;


//connect to database
$db = connectToDB();

//setup a query to get all companies into
$query = 'INSERT INTO register 
          (student, event)
          VALUES (?, ?)';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$student, $event]);
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB Sign-up Error', ERROR);
    die('There was an error adding data to the database');
}

echo '<p>Success!!!</p>';

?>


<?php include 'partials/bottom.php'; ?>