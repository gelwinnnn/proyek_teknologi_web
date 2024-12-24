<?php
    if (isset($_POST['username'])) {
        $username = $_POST['username'];

        session_start();
        $_SESSION['username'] = $username;

        echo "Username saved successfully.";
    } else {
        echo "Error: Username not provided.";
    }
?>
