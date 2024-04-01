<?php
    require "loggedin.php";
    require "dbConnect.php";
    date_default_timezone_set("America/Los_Angeles");
    $id = $_REQUEST["id"];
    $todaysDate = date("Ymd");

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($conn->query("UPDATE events SET IsDeleted=0 WHERE id=$id") === TRUE )
    {
        header("Location: /admin.php");
        exit;
    }
    else {
        echo "Error: " . $conn->error . "<br>".
             "Please contact support";
    }

?>