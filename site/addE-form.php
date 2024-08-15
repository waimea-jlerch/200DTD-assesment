<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php';

echo '<a href="upcoming-events.php" role="button">
        <i data-feather="arrow-left"></i>
        Go Back
     </a>';
?>

<h2 class="centerize-title">Add Upcoming Event!</h2>

<form method="post" action="addE-complete.php" enctype="multipart/form-data">

    <label>Name</lebel>
    <input name="name" type="text" placeholder="e.g. Gym Night" required>

    <label>Description</lebel>
    <textarea name="description" placeholder="e.g. Sports!"></textarea>

    <label>Event Date</lebel>
    <input name="event-date" type="datetime-local" required>

    <label>Open Date</lebel>
    <input name="open-date" type="datetime-local" required>

    <label>Close Date</lebel>
    <input name="close-date" type="datetime-local" required>

    <label>End Date</lebel>
    <input name="end-date" type="datetime-local" required>

    <label>Picture</lebel>
    <input name="image" type="file" accept="images/*">


    <input type="submit" value="Add">

</form>

<?php 
include 'partials/bottom.php'; 
?>
