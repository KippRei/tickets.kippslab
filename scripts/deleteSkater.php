<?php
    require "loggedin.php";
    require "dbConnect.php";

    $id = $_REQUEST["id"];
    $sessionid = $_REQUEST["sessionID"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($conn->query("UPDATE skaters SET IsDeleted=1 WHERE id=$id") === TRUE )
    {
        header("Location: /editskaters.php?id=$sessionid");
        exit;
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error . "<br>".
             "Please contact support";
    }
?>