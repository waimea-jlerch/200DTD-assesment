<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 



consoleLog($_POST, 'POST Data');

// Get form data
$forename = $_POST['forename'];
$surname = $_POST['surname'];
$role = $_POST['role'];
$nationality = $_POST['nationality'];
$year = $_POST['year'];
$dob = $_POST['dob'];
$pin = $_POST['pin'];


//connect to database
$db = connectToDB();


    //setup a query to get all companies into
    $query = 'INSERT INTO students 
            (forename, surname, role, nationality, year, dob, pin)
            VALUES (?, ?, ?, ?, ?, ?, ?)';

    //Ateempt to run the query
    try{
        $stmt = $db->prepare($query);
        $stmt->execute([$forename, $surname, $role, $nationality, $year, $dob, $pin]);
    }
    catch (PDOException $e) {
        consoleLog($e->getMessage(), 'DB Sign-up Error', ERROR);
        die('There was an error adding data to the database');
    }


header('Location: student-list.php'); 

?>