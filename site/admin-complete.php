<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 


consoleLog($_POST, 'POST Data');


$username = $_POST['username'];
$password = $_POST['password'];


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

//-------------------------------------------------------------------------

if ($adminPass['username'] == $username && $adminPass['password'] == $password) {


        $_SESSION['admin'] = true;

        header('location: upcoming-events.php');
}
else {

    echo '<h2 class="centerize-title">Incorrect username or password!</h2>';

    echo '<div class="complete-box">';
    
    echo '<p>Check your username and password again to log-in!</p>';

    echo '<a href = "admin-form.php" role="button" class="Edetails">Try again</a>';

    echo '<br>';

    echo 'Or would you like to return to:';
        echo    '<div>';
        echo    '<a href = "upcoming-events.php" role="button" class="Edetails">Upcoming Events</a>';
        echo    '<a href = "mySignUps-redirect.php" role="button" class="Edetails">My Sign-ups</a>';
        echo    '</div>';

    echo    '</div>';
} 

?>


<?php include 'partials/bottom.php'; ?>