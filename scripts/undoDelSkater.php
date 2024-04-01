<?php
    require "loggedin.php";
    require "dbConnect.php";

    $id = $_REQUEST["id"];
    $sessionID = $_REQUEST["sessionid"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($conn->query("UPDATE skaters SET IsDeleted=0 WHERE id=$id") === TRUE )
    {
        header("Location: /editskaters.php?id=$sessionID");
        exit;
    }
    else {
        echo "Error: " . $conn->error . "<br>".
             "Please contact support";
    }

?>