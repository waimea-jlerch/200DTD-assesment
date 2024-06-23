<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 


echo '<h1 class="centerize-title">Who is going to ' . $events['name'] . ' </h1>';


//connect to database
$db = connectToDB();

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
    $stmt->execute();
    $employees = $stmt->fetchALL();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting student sign-ups data from the database');
}

//see what we got back
consoleLog($students);

echo '<table>
        <tr>
            <th>Name</th>
            <th>Year Lever</th>
            <th>Nationality</th>
        </tr>';

foreach ($students as $student) {
    echo '<tr>';
    echo    '<td>' . '<p>' . $student['forename'] . " " . $student['surname']  . '</p>'. '</td>'; 
    echo    '<td>' . $student['year'] . '</td>';
    echo    '<td>' . $student['nationality'];
    echo '</tr>'; 
}

echo '</table>';

include 'partials/bottom.php';

?>