<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

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
    die('There was an error getting events data from the database');
}

//see what we got back
consoleLog($events);

$query = 'SELECT * FROM students ORDER BY forename ASC';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute();
    $students = $stmt->fetchALL();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting students data from the database');
}

//see what we got back
consoleLog($students);

echo '<h2>Signing-up to ' . $events['name'] . '</h2>';

echo '<form method="post" action="signUp-complete.php?id=' . $event['id'] . '">'; 
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
            placeholder="e.g. 123456 (6-digits)"
            minlength="6" 
            maxlength="6" 
            pattern="[0-9]{1-6}"
            required>

    <input type="submit" value="SIGN UP">

<?php 
include 'partials/bottom.php'; 
?>
