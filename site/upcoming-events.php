<?php 
require 'lib/utils.php'; //require means if you can't find the file required, then give up no point in continueing
include 'partials/top.php'; 
?>

<h1 class="centerize-title">Upcoming Events</h1>

<?php

//connect to database
$db = connectToDB();

//setup a query to get all companies into
$query = 'SELECT * FROM companies ORDER BY name ASC';

//Ateempt to run the query
try{
    $stmt = $db->prepare($query);
    $stmt->execute();
    $companies = $stmt->fetchALL();
}
catch (PDOException $e) {
    consoleLog($e->getMessage(), 'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}

//see what we got back
consoleLog($companies);

echo '<ul id="company-list">';

foreach ($companies as $company) {
    echo '<li>';

    echo    '<a href="company.php?code=' . $company['code'] . '">';
    echo    $company['name'];
    echo    '</a>';
    
    echo    '<a href="' . $company['website'] . '">';
    echo    '🔗';
    echo    '</a>';

    echo '</li>';
}

echo '</ul>';

echo '<div id="add-button">
        <a href ="form-company.php">
            Add
        </a>
      </div>';

?>


<?php include 'partials/bottom.php'; ?>