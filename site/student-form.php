<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

// back button
echo '<a href="student-list.php" role="button">
        <i data-feather="arrow-left"></i>
        Go Back
     </a>';
?>

<h2 class="centerize-title">Add A Student!</h2>

<form method="post" action="student-add.php">

    <label>Forename</label>
    <input name="forename" type="text" placeholder="e.g. John" required>

    <label>Surname</label>
    <input name="surname" type="text" placeholder="e.g. Smith">

    <label>Role</label>
    <select name="role">
    <option>International Student</option>
    <option>Migrant Student</option>
    <option>International Leader</option>
    <option>International Staff</option>
    </select>

    <label>Nationality</label>
    <input name="nationality" type="text" placeholder="e.g. Japanese" required>

    <label>Year Level</label>
    <select name="year">
    <option>9</option>
    <option>10</option>
    <option>11</option>
    <option>12</option>
    <option>13</option>
    </select>

    <label>Date of Birth</label>
    <input name="dob" type="date" required>

    <label>PIN</label>
    <input name="pin" placeholder="e.g. 123456" type="text" minlength="6" maxlength="6" pattern="[0-9]{6}" required>


    <input type="submit" value="Add">
</form>

<?php 
include 'partials/bottom.php'; 
?>
