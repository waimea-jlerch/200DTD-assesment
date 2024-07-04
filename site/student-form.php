<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 
?>

<h2>Add A Student!</h2>

<form method="post" action="student-add.php">

    <label>Forename</lebel>
    <input name="forename" type="text" placeholder="e.g. John" required>

    <label>Surname</lebel>
    <input name="surname" type="text" placeholder="e.g. Smith">

    <label>Role</lebel>
    <input name="role" type="text" placeholder="e.g. International Student" required>

    <label>Nationality</lebel>
    <input name="nationality" type="text" placeholder="e.g. Japanese" required>

    <label>Year Level</lebel>
    <input name="year" type="number" placeholder="e.g. 12" required>

    <label>Date of Birth</lebel>
    <input name="dob" type="date" placeholder="e.g. https://happy.io" required>

    <label>PIN</lebel>
    <input name="pin" placeholder="e.g. 123456" type="text" minlength="6" maxlength="6" pattern="[0-9]{6}" required>


    <input type="submit" value="Add">

<?php 
include 'partials/bottom.php'; 
?>
