<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

$id = $_GET['id'] ?? null;

//connect to database
$db = connectToDB();

//setup a query to get event details info
$query = 'SELECT * FROM events WHERE id=?';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute([$id]);
    $event = $stmt->fetch();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB event details Error', ERROR);
    die('There was an error getting event details to the database');
}

?>

<h2>Edit <?= $event['name'] ?>'s event details!</h2>

<form method="post" action="addE-complete.php" enctype="multipart/form-data">

    <label>Name</lebel>
    <input name="name" type="text" value="<?= $event['name'] ?>" required>

    <label>Description</lebel>
    <input name="description" type="text" value="<?= $event['description'] ?>">

    <label>Open Date</lebel>
    <input name="open-date" type="datetime-local" value="<?= $event['open_date'] ?>" required>

    <label>Close Date</lebel>
    <input name="close-date" type="datetime-local" value="<?= $event['close_date'] ?>" required>

    <label>End Date</lebel>
    <input name="end-date" type="datetime-local" value="<?= $event['end_date'] ?>" required>

    <label>Picture</lebel>
    <input name="image" type="file" accept="images/*">


    <input type="submit" value="Add">

<?php 
include 'partials/bottom.php'; 
?>
