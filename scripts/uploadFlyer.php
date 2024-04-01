<?php
    require "loggedin.php";
    require "dbConnect.php";
    
    $flyer = $_POST['file'];
    echo $flyer['name'];

?>