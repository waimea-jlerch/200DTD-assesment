<?php require_once '_config.php'; ?>

<?php


session_name('IntEventsBooking');
session_start();

$adminPortal = isset($_SESSION['admin']);

$page = basename($_SERVER['SCRIPT_NAME']);

consoleLog($_SESSION)

// echo $page
// print_r($page)
// record contained data, and container contained records
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>International Events Register</title>

    <!-- <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.jade.min.css"
/> -->
<link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <header>

        <div id="international-events">
            <a href="index.php">
                <img src="images/Waimea.png">
                    <div id="main-title">    
                    <h1><?= SITE_NAME?></h1>
                    <p>&nbsp;International Events</p>
                    </div>
            </a>
        </div>
        
        <nav>
            <a href="upcoming-events.php"   class="<?= $page=='upcoming-events.php' ? 'active' : '' ?>">Upcoming Events</a>
            <a href="mySignUps-redirect.php" class="<?= $page=='mySignUps-form.php' ? 'active' : '' ?>">My Sign-ups</a>

            <?php if($adminPortal == true){
                echo '<a href="student-list.php" class="' . ($page=='student-list.php' ? 'active' : '') . '">Student List</a>';
                } 
            ?>

        </nav>

    </header>

    <main>
