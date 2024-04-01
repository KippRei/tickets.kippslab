<?php
    require "dbConnect.php";

    $fname = $_REQUEST["fname"];
    $lname = $_REQUEST["lname"];
    $email = $_REQUEST["email"];
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO mailinglist (fname, lname, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fname, $lname, $email);
    $stmt->execute();
    $res = $stmt->get_result();
    $stmt->close();
?>