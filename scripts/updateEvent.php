<?php
    require "loggedin.php";
    require "dbConnect.php";
    date_default_timezone_set("America/Los_Angeles");
    $todaysDate = date("Ymd");
    
    $eventName = $_REQUEST["eventName"];
    $getDate = $_REQUEST["eventDate"];
    $eventStart = $_REQUEST["eventStart"];
    $eventEnd = $_REQUEST["eventEnd"];
    $id = intval($_REQUEST["id"]);
    $maxCap = intval($_REQUEST["maxCap"]);
    $price = floatval($_REQUEST["price"]);
    $flyer = $_REQUEST["currentFlyerName"];

    if (preg_match("`^[-0-9A-Z_\.]+$`i", $_FILES['flyer']['name'])) {
        $uploadDir = '/flyers/';
        $uploadFile = $uploadDir . $getDate . basename($_FILES['flyer']['name']);
        if (move_uploaded_file($_FILES['flyer']['tmp_name'], '..'. $uploadFile)) {
            $flyer = $uploadFile;
        }
    }

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $dateFormat = explode('-', $getDate); // TODO: maybe implode this to get properly formatted date without the next step of array item concat
    $eventDate = $dateFormat[0] . $dateFormat[1] . $dateFormat[2];

    if ($conn->query("UPDATE events SET eventName='$eventName', eventDate='$eventDate', eventStart='$eventStart', eventEnd='$eventEnd', MaxCapacity=$maxCap, Price=$price, flyer='$flyer' WHERE id=$id") === TRUE )
    {
        header("Location: /admin.php");
        exit;
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error . "<br>".
             "Please contact support";
    }

?>