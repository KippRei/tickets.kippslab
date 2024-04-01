<?php
    session_start();
    if (isset($_SESSION['loggedintoCageRollerHockey']))
    {
        $_SESSION['loggedintoCageRollerHockey'] = false;
        header("Location: /login.php");
        exit;
    }
?>