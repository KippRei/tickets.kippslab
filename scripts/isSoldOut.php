<?php
    require "dbConnect.php";
    date_default_timezone_set("America/Los_Angeles");
    $todaysDate = date("Ymd");

    $id = $_REQUEST["id"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM events WHERE eventDate >= ? AND IsDeleted=0 ORDER BY eventDate");
    $stmt->bind_param("s", $todaysDate);
    $stmt->execute();
    $result = $stmt->get_result();
    $currEvent = $result->fetch_assoc()["id"];
    $stmt->close();

    // This will disallow purchasing tickets for future events (only allows one event to be 'live' at a time)
    // if ($currEvent != $id)
    // {
    //     header("Location: /nosale.php");
    //     exit;
    // }

    $stmt = $conn->prepare("SELECT COUNT(*) FROM skaters WHERE SessionID=? AND IsDeleted=0");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = intval($result->fetch_assoc()["COUNT(*)"]);
    $stmt->close();

    $stmt = $conn->prepare("SELECT * FROM events WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $maxCap = intval($result->fetch_assoc()["MaxCapacity"]);
    $stmt->close();

    if ($maxCap != NULL)
    {
            {
                $remainingSpots = $maxCap - $count;
            }
            if ($remainingSpots <= 0 && $maxCap != NULL)
            {
                header("Location: /soldout.php");
                exit;
            }
    }
?>