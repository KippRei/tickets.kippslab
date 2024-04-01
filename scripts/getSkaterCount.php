<?php
    require "dbConnect.php";

    $id = $_REQUEST["id"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT COUNT(*) FROM skaters WHERE SessionID=? AND IsDeleted=0");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = intval($result->fetch_assoc()["COUNT(*)"]);
    $stmt->close();

    echo "<div id='waiverEventText'>Total Skaters: $count</div>";
?>