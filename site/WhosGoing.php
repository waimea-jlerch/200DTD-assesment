<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 


$id = $_GET['id'] ?? null;

//connect to database
$db = connectToDB();

//setup a query to get all companies into
$query = 'SELECT name FROM events WHERE id=?';

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

echo '<h1 class="centerize-title">Who is going to ' . $event['name'] . ' </h1>';

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


//see what we got back
consoleLog($registrations);

if (!$registrations) {
    echo '<h2>No sign-ups yet! be the first to sign-up! </h2>';
    echo    '<a href="signUp-form.php?id=' . $id . '">';
    echo        '<button>';
    echo            'Sign-Up';
    echo        '</button>';
    echo    '</a>';

}
else {

echo '<table>
        <tr>
            <th>Name</th>
            <th>Year Lever</th>
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
}

include 'partials/bottom.php';

?>