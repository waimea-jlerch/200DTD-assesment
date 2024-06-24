<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 



$id = $_GET['id'] ?? null;

//connect to database
$db = connectToDB();

//setup a query to get all companies into
$query = 'SELECT * FROM events WHERE id=?';

//We use alias (as) in games.name and companies.name to prevent confusion as they both have .name php will not beable to tell apart and overwrite them.

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $event = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting games data from the database');
}

if (!$event) die('Invalid event ID');

echo '<h1 class="centerize-title">' .  $event['name']  . '</h1>';

//see what we got back
consoleLog($event);

echo '<p>' . $event['open_date'] . '</p>';
echo '<p>' . $event['close_date'] . '</p>';

echo '<p>' . $event['description'] . '</p>';

echo    '<a href="WhosGoing.php?id=' . $id . '">';
    echo        '<button>';
    echo            'See who else is going';
    echo        '</button>';
    echo    '</a>';

echo    '<a href="signUp-form.php?id=' . $id . '">';
    echo        '<button>';
    echo            'Sign-Up';
    echo        '</button>';
    echo    '</a>';

?>

<?php include 'partials/bottom.php';