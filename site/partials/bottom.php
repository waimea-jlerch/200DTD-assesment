</main>

<footer>

    <?php
    // Show Log-in or Log-out option depending on if admin session is active
    if($adminPortal){

        echo '<p>Hello Admin! <a href="admin-logOut.php">Log-out?</a></p>';

    }
    else{

        echo '<p>Are you an admin? <a href="admin-form.php">Log-in here!</a></p>';  

    }

    ?>

    <div class="credit">
        &copy; <?= date('Y') ?> Waimea College
    </div>

</footer>

<script>
    feather.replace();
</script>

</body>

</html>