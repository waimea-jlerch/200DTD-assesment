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

//-------------------------------------------------------------------------------
// connect to database
$db = connectToDB();

// set up a query to get student PIN info
$query = 'SELECT pin FROM students

          WHERE pin = ?';

// Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$pin]);
    $studentPinCheck = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting students data from the database');
}

// see what we get back
consoleLog($pin);
consoleLog($studentPinCheck);
//------------------------------------------------------------------------------

if(!$studentPinCheck){

    //setup a query to add a new student
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
        die('There was an error adding student data to the database');
    }

    // redirect back
    header('Location: student-list.php'); 
}
else{
// PIN that was input in form has already existing

    echo '<a href="student-list.php" role="button">
    <i data-feather="arrow-left"></i>
    Go Back
    </a>';

    echo '<h2 class="centerize-title">This PIN already exists!</h2>';

    echo '<div class="complete-box">';
        
        echo '<p>Try giving ' . $forename . ' ' . $surname . ' another pin.</p>';

        echo '<a href = "student-form.php" role="button" class="Edetails">Try again</a>';

        echo '<br>';

        echo 'Or would you like to return to:';
            echo    '<div>';
            echo    '<a href = "student-list.php" role="button" class="Edetails">Student List</a>';
            echo    '<a href = "upcoming-events.php" role="button" class="Edetails">Upcoming Events</a>';
            echo    '</div>';
    
    echo    '</div>';

    include 'partials/bottom.php';

}
?>