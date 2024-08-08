<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

echo '<div id="back">';
echo '<button onclick="history.back()">Go Back</button>';
?>

<h2 class="centerize-title">Add A Student!</h2>

<form method="post" action="student-add.php">

    <label>Forename</lebel>
    <input name="forename" type="text" placeholder="e.g. John" required>

    <label>Surname</lebel>
    <input name="surname" type="text" placeholder="e.g. Smith">

    <label>Role</lebel>
    <select name="role" required>
    <option>International Student</option>
    <option>Migrant Student</option>
    <option>International Leader</option>
    <option>International Staff</option>
    </select>

    <label>Nationality</lebel>
    <input name="nationality" type="text" placeholder="e.g. Japanese" required>

    <label>Year Level</lebel>
    <select name="year" required>
    <option>9</option>
    <option>10</option>
    <option>11</option>
    <option>12</option>
    <option>13</option>
    </select>

    <label>Date of Birth</lebel>
    <input name="dob" type="date" required>

    <label>PIN</lebel>
    <input name="pin" placeholder="e.g. 123456" type="text" minlength="6" maxlength="6" pattern="[0-9]{6}" required>


    <input type="submit" value="Add">

<?php 
include 'partials/bottom.php'; 
?>
