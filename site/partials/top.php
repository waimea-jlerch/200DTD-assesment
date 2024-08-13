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
    <title>Waimea International Events Register</title>

    <script src="https://unpkg.com/feather-icons"></script>

<link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <header>

        <div id="international-events">
            <a href="index.php">
                <img src="images/Waimea.png" alt="Waimea College Logo">
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
                echo '<a href="closed-events.php" class="' . ($page=='closed-events.php' ? 'active' : '') . '">Closed Events</a>';
                } 
            ?>

        </nav>

    </header>

    <main>
