<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

//connect to database
$db = connectToDB();

//setup a query to get all companies into
$query = 'SELECT * FROM events ORDER BY name ASC';

//We use alias (as) in games.name and companies.name to prevent confusion as they both have .name php will not beable to tell apart and overwrite them.

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute();
    $events = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting games data from the database');
}

echo '<h1 class="centerize-title">' .  $events['name']  . '</h1>';

//see what we got back
consoleLog($events);

echo '<p>' . $events['open_date'] . '</p>';
echo '<p>' . $events['close_date'] . '</p>';

echo '<p>' . $events['description'] . '</p>';

// echo '<table>
//         <tr>
//             <th>Game Title</th>
//             <th>Company</th>
//             <th>Unit Sold</th>
//         </tr>';

// foreach ($games as $game) {
//     echo '<tr>';
//     echo    '<td>' . $game['gname'] . '</td>'; 
//     echo    '<td>' . $game['cname'] . '</td>';
//     echo    '<td>' . number_format($game['sales']) . '</td>';
//     echo '</tr>'; 
// }

// echo '</table>';

// echo '<div id="add-button">
//         <a href ="form-game.php">
//             Add
//         </a>
//       </div>';

?>

<?php include 'partials/bottom.php';