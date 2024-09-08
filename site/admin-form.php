<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 

// Back Button
echo '<a onclick="history.back()" role="button">
    <i data-feather="arrow-left"></i>
    Go Back
    </a>';

echo '<h2 class="centerize-title">Log into Admin Portal!</h2>';
?>

<form method="post" action="admin-complete.php">
    
    <label>Name</label>
        <input name="username" 
            type="text" 
            placeholder="Enter username here"
            required>

    <label>Password</label>
        <input name="password" 
            type="password" 
            placeholder="Enter password here"
            required>

    <input type="submit" value="LOGIN">

</form>

<?php 
include 'partials/bottom.php'; 
?>
