<?php
    session_start();
    if (!(isset($_SESSION['loggedintoCageRollerHockey']) && $_SESSION['loggedintoCageRollerHockey'] == true))
    {
        header("Location: /login.php");
        exit;
    }
?>