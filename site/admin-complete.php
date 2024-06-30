<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

consoleLog($_POST, 'POST Data');

$query = 'SELECT * FROM admin_portal';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute();
    $adminPass = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting admin pass data from the database');
}

//see what we got back
consoleLog($adminPass);