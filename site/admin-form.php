<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

//connect to database
$db = connectToDB();

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

echo '<h2>Log into Admin Portal!</h2>';

?>
<form method="post" action="admin-complete.php">
    
    <label>Name</label>
        <input name="username" 
            type="text" 
            placeholder="Enter username here"
            required>

    <label>Password</label>
        <input name="password" 
            type="text" 
            placeholder="Enter password here"
            required>

    <input type="submit" value="LOGIN">

<?php 
include 'partials/bottom.php'; 
?>
