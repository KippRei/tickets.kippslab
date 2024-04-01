<?php
    require "loggedin.php";
    require "dbConnect.php";
    
    $eventName = $_REQUEST["eventName"];
    $getDate = $_REQUEST["eventDate"];
    $eventStart = $_REQUEST["eventStart"];
    $eventEnd = $_REQUEST["eventEnd"];
    $price = floatval($_REQUEST["price"]);
    $maxCap = intval($_REQUEST["maxCap"]);
    $flyer = 'none';

    if (preg_match("`^[-0-9A-Z_\.]+$`i", $_FILES['flyer']['name'])) {
        $uploadDir = '/flyers/';
        $uploadFile = $uploadDir . $getDate . basename($_FILES['flyer']['name']);
        if (move_uploaded_file($_FILES['flyer']['tmp_name'], '..'. $uploadFile)) {
            $flyer = $uploadFile;
        }
    }

    $dateFormat = explode('-', $getDate); // TODO: maybe implode this to get properly formatted date without the next step of array item concat
    $eventDate = intval($dateFormat[0] . $dateFormat[1] . $dateFormat[2]);

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $newEvent = "INSERT INTO events (eventName, eventDate, eventStart, eventEnd, Price, MaxCapacity, flyer) VALUES('$eventName', '$eventDate','$eventStart', '$eventEnd', $price, $maxCap, '$flyer')";

    if ($conn->query($newEvent) === TRUE)
    {
        header("Location: /admin.php");
        exit;
    }
    else
    {
        echo "Error creating event $eventName: " . $conn->error;
    }
?>