<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php';

echo '<div id="back">';
echo '<button onclick="history.back()">Go Back</button>';
?>

<h2 class="centerize-title">Add Upcoming Event!</h2>

<form method="post" action="addE-complete.php" enctype="multipart/form-data">

    <label>Name</lebel>
    <input name="name" type="text" placeholder="e.g. Gym Night" required>

    <label>Description</lebel>
    <input name="description" type="text" placeholder="e.g. Sports!">

    <label>Open Date</lebel>
    <input name="open-date" type="datetime-local" placeholder="e.g. https://happy.io" required>

    <label>Close Date</lebel>
    <input name="close-date" type="datetime-local" placeholder="e.g. https://happy.io" required>

    <label>End Date</lebel>
    <input name="end-date" type="datetime-local" placeholder="e.g. https://happy.io" required>

    <label>Picture</lebel>
    <input name="image" type="file" accept="images/*">


    <input type="submit" value="Add">

<?php 
include 'partials/bottom.php'; 
?>
