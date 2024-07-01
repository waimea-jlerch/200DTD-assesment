<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 
?>

<h2>Add Upcoming Event!</h2>

<form method="post" action="addE-complete.php">

    <label>Name</lebel>
    <input name="name" type="text" placeholder="e.g. Gym Night" required>

    <label>Description</lebel>
    <input name="description" type="text" placeholder="e.g. Sports!" required>

    <label>Website</lebel>
    <input name="website" type="text" placeholder="e.g. https://happy.io" required>

    <input type="submit" value="Add">

<?php 
include 'partials/bottom.php'; 
?>
