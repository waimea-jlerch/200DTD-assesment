<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

echo '<a href="upcoming-events.php" role="button">
    <i data-feather="arrow-left"></i>
    Go Back
    </a>';
?>

<h1 class="centerize-title">International & Migrant Students</h1>

<?php

//connect to database
$db = connectToDB();

//setup a query to get all companies into
$query = 'SELECT * FROM students ORDER BY forename ASC';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute();
    $students = $stmt->fetchALL();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}

//see what we got back
consoleLog($students);

echo '<ul id="student-list">';

echo '<div class="list-table">';
echo '<table>
        <tr>
            <th>Name</th>
            <th>Year Lever</th>
            <th>Nationality</th>
            <th>Role</th>
            <th>Date of Birth</th>
            <th>PIN</th>
            <th> </th>
        </tr>';

foreach ($students as $student) {
    echo '<tr>';
    echo    '<td>' . '<p>' . $student['forename'] . " " . $student['surname']  . '</p>'. '</td>'; 
    echo    '<td>' . $student['year'] . '</td>';
    echo    '<td>' . $student['nationality'];
    echo    '<td>' . $student['role'];
    echo    '<td>' . $student['dob'];
    echo    '<td>' . $student['pin'];
    echo    '<td>' . '<a href ="delete-studentConfirm.php?id=' . $student['id'] . '">
                        <i data-feather="user-minus"></i>
                    </a>';
    echo '</tr>';
}

echo '</table>';
echo '</div>';

echo '</ul>';

echo '<div id="add-button">
        <a href ="student-form.php">
            <i data-feather="plus"></i>
        </a>
      </div>';

include 'partials/bottom.php'; ?>