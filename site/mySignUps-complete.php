<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

consoleLog($_POST, 'POST Data');

// Get form data
$studentID = $_POST['studentID'];
$pin = $_POST['pin'];


//connect to database
$db = connectToDB();

//setup a query to get student's PIN info
$query = 'SELECT pin FROM students WHERE id=?';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$studentID]);
    $student = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB incorrect pin Error', ERROR);
    die('There was an error getting student pin to the database');
}

//checking for repetitive sign-ups
$query = 'SELECT student FROM register WHERE student=?';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$studentID]);
    $register = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB register data Error', ERROR);
    die('There was an error getting register data from the database');
}


//-------------------------------------------------------------------------

if ($student['pin'] == $pin ) {


    session_start();


        $_SESSION['mySignUps'] = $studentID;

        header('location: mySignUps.php');
}
else {

    echo '<h2 class="centerize-title">Incorrect PIN!</h2>';
    
    echo '<p>Try again to verify.</p>';

    echo '<a href = "mySignUps-form.php"><button>Try again</button></a>';

    echo '<br>';

    echo 'Or would you like to return to:';
        echo    '<div>';
        echo    '<a href = "upcoming-events.php"><button>Upcoming Events</button></a>';
        echo    '<a href = "mySign-ups.php"><button>My Sign-ups</button></a>';
        echo    '</div>';
} 

?>


<?php include 'partials/bottom.php'; ?>