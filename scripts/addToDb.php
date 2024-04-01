<?php
    require "dbConnect.php";

    $fnameArr = json_decode($_REQUEST["fnameArr"]);
    $lnameArr = json_decode($_REQUEST["lnameArr"]);
    $emailArr = json_decode($_REQUEST["emailArr"]);
    $id = $_REQUEST["id"];
    $ticketQuant = $_REQUEST["ticketQuant"];
    $referral = $_REQUEST["referral"];
    $referredBy = "-"; // To hold actual name of referrer, if referral code is valid


    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    
    $refCodes = $conn->query("SELECT * FROM referralcodes");

    if ($refCodes->num_rows > 0) {
        while ($row = $refCodes->fetch_assoc()) {
            if (strtolower($referral) === strtolower($row["refCode"])) {
                $referredBy = $row["refName"];
            }
        }
    }

    $sessionStmt = $conn->prepare("SELECT * FROM events WHERE id=?");
    $sessionStmt->bind_param("i", $id);
    $sessionStmt->execute();
    $sessionRes = $sessionStmt->get_result();
    $sessionStmt->close();

    $timeArr = $sessionRes->fetch_assoc();
    $date = strval($timeArr["eventDate"]);

    $endTime = 0;
    if ($timeArr["eventEnd"][0])
    {
        $endTime = $timeArr["eventEnd"][0];
    }

    $idPostfix = "-" .
                 $date[4] . $date[5] . $date[6] . $date[7] .
                 "-" .
                 $timeArr["eventStart"][0] . $endTime;

    $resultArr= array();
    $stmt = $conn->prepare("INSERT INTO skaters (fname, lname, email, SessionID, referral) VALUES (?, ?, ?, ?, ?)");
    
    for ($i = 0; $i < $ticketQuant; $i++)
    {
        $fname = $fnameArr[$i];
        $lname = $lnameArr[$i];
        $email = $emailArr[$i];
        $stmt->bind_param("sssis", $fname, $lname, $email, $id, $referredBy);
        $stmt->execute();
        $resultArr[] = $stmt->insert_id . $idPostfix;
    }
    $stmt->close();

    if ($resultArr)
    {
        echo (json_encode($resultArr));
    }
    else {
        echo "We're sorry, there was an error adding you to the skater list for this event.".
             "<br/>Please contact <a href='mailto: support@skatingtix.com>support</a><br/>" . $result;
    }
?>