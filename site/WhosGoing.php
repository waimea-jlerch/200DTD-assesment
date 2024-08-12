<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

echo '<div id="back">';
echo '<button onclick="history.back()">Go Back</button>';

$id = $_GET['id'] ?? null;

//Get the current time
$now = strtotime("now");
consoleLog("now",$now);

//connect to database
$db = connectToDB();

//setup a query to get all companies into
$query = 'SELECT name, close_date FROM events WHERE id=?';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $event = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting event details data from the database');
}

if (!$event) die('Invalid event ID');

echo '<h1 class="centerize-title">Resgistrations for ' . $event['name'] . '!</h1>';

//setup a query to get all companies into
$query = 'SELECT    students.forename,
                    students.surname, 
                    students.year,
                    students.nationality,
                    events.name

                FROM students
                JOIN register ON register.student = students.id
                JOIN events ON register.event = events.id

                WHERE register.event=?

        ORDER BY students.forename ASC';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $registrations = $stmt->fetchAll();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting student sign-ups data from the database');
}


$eventCloseDate = strtotime($event['close_date']);
consoleLog("close_date",$eventCloseDate);

$closeDate = new DateTimeImmutable($event['close_date']);
$formattedcloseDate = $closeDate->format('\C\l\o\s\e\d \f\o\r \s\i\g\n\-\u\p \s\i\n\c\e D d M Y \a\t H:i A');

//see what we got back
consoleLog($registrations);

if (!$registrations) {

    if($now <= $eventCloseDate){
        echo '<p>Be the first to sign-up!</p>';
        echo    '<a href="signUp-form.php?id=' . $id . '">';
            echo        '<button>';
            echo            'Sign-Up';
            echo        '</button>';
            echo    '</a>';
    }
    else{
        echo '<p>No sign-ups for ' . $event['name'] . '</p>';

        echo $formattedcloseDate;

    }

}
else {

echo '<table>
        <tr>
            <th>Name</th>
            <th>Year Level</th>
            <th>Nationality</th>
        </tr>';

foreach ($registrations as $registration) {
    echo '<tr>';
    echo    '<td>' . '<p>' . $registration['forename'] . " " . $registration['surname']  . '</p>'. '</td>'; 
    echo    '<td>' . $registration['year'] . '</td>';
    echo    '<td>' . $registration['nationality'];
    echo '</tr>'; 
}

echo '</table>';

        if($now <= $eventCloseDate){
            echo    '<a href="signUp-form.php?id=' . $id . '">';
            echo        'Sign-up now!';
            echo    '</a>';
        }
        else{
            echo $formattedcloseDate;
        }

}

include 'partials/bottom.php';

?>