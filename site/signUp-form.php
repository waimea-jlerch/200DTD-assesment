<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

$id = $_GET['id'] ?? null;

//connect to database
$db = connectToDB();

//setup a query to get event info
$query = 'SELECT name FROM events WHERE id=?';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $event = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting events data from the database');
}

if (!$event) die('Invalid event ID');

//see what we got back
consoleLog($event);

$query = 'SELECT * FROM students ORDER BY forename ASC';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute();
    $students = $stmt->fetchAll();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting students data from the database');
}

//see what we got back
consoleLog($students);

echo '<h2>Signing-up to ' . $event['name'] . '</h2>';

echo '<form method="post" action="signUp-complete.php?id=' . $id . '">'; 
?>

    <label>Name</lebel>
        <select name="sname" required>
        <?php

        foreach ($students as $student) {
            echo '<option value="' .$student['id'] . '">';
            echo    $student['forename'] . ' ' . $student['surname'];
            echo  '</option>';
        }
        
        ?>
        </select>

    <label>PIN</lebel>
        <input name="pin" 
            type="text" 
            placeholder="e.g. 123456 (6-digits) given by international staff"
            minlength="6" 
            maxlength="6" 
            pattern="[0-9]{1-6}"
            required
            
        <?php 
        
        // if($student['pin'] != input) 
        
        ?>    >

    <input type="submit" value="SIGN UP">

<?php 
include 'partials/bottom.php'; 
?>
