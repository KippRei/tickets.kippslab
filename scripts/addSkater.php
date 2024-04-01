<?php
    require "loggedin.php";
    require "dbConnect.php";
    
    $fname = $_REQUEST["fname"];
    $lname = $_REQUEST["lname"];
    $email = $_REQUEST["email"];
    $sessionID = intval($_REQUEST["sessionid"]);

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $newSkater = "INSERT INTO skaters (fname, lname, email, SessionID) VALUES ('$fname', '$lname', '$email', $sessionID)";

    if ($conn->query($newSkater) === TRUE)
    {
        header("Location: /editskaters.php?id=$sessionID");
        exit;
    }
    else
    {
        echo "Error adding skater: " . $conn->error;
    }
?>