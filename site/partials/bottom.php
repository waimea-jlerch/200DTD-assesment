</main>

<footer>
    &copy; <?= date('Y') ?> Waimea College

    <?php

    if($adminPortal){

        echo '<p>Hello Admin! <a href="admin-logOut.php">Log-out?</a></p>';

    }
    else{

        echo '<p>Are you an admin? <a href="admin-form.php">Log-in here!</a></p>';  

    }

    ?>

</footer>

</body>

</html>