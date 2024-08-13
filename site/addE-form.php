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
    <input name="description" type="text" placeholder="e.g. Sports!">

    <label>Event Date<br>(When does it start?)</lebel>
    <input name="event-date" type="datetime-local" required>

    <label>Open Date<br>(When will the event be open for signed up?)</lebel>
    <input name="open-date" type="datetime-local" required>

    <label>Close Date<br>(When will the event be close for signed-up?)</lebel>
    <input name="close-date" type="datetime-local" required>

    <label>End Date<br>(When will the event be deleted from the database?)</lebel>
    <input name="end-date" type="datetime-local" required>

    <label>Picture</lebel>
    <input name="image" type="file" accept="images/*">


    <input type="submit" value="Add">

<?php 
include 'partials/bottom.php'; 
?>
