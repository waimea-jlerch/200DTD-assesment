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

echo '<h2>Signing-up to ' . $events['name'] . '</h2>'
?>

<form method="post" action="signUp-complete.php">

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

    <label>Code</lebel>
        <input name="code" 
            type="text" 
            placeholder="e.g. ABCDF0"
            minlength="3" 
            maxlength="6" 
            pattern="[A-Z]{3-6}"
            required>

    <label>Name</lebel>
    <input name="name" type="text" placeholder="e.g. Kitten Tennis" required>


    <label>Sales</lebel>
    <input name="sales" type="number" placeholder="e.g. 200000" required>

    <input type="submit" value="Add">

<?php 
include 'partials/bottom.php'; 
?>
