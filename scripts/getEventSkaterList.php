<?php
    require "loggedin.php";
    require "dbConnect.php";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("select * from skaters where SessionID = $id order by $sortType");
    // Creates postfix for skater id.
    // Complete id is constructed by taking primary key from db (auto-incremented when row is created)
    // followed by "-" 2-digit month then 2-digit day of event
    // followed by "-" first digit of start time then first digit of end time
    $eventTime = $conn->query("select * from events where id = $id");
    $timeArr = $eventTime->fetch_assoc();

    $endTime = 0;
    if ($timeArr["eventEnd"][0])
    {
        $endTime = $timeArr["eventEnd"][0];
    }

    $idPostfix = "-" .
                 $timeArr["eventDate"][4] . $timeArr["eventDate"][5] . $timeArr["eventDate"][6] . $timeArr["eventDate"][7] .
                 "-" .
                 $timeArr["eventStart"][0] . $endTime;
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
            if (!$row["IsDeleted"])
            {
                echo "<tr><td>" . $row["id"] . $idPostfix .
                    "</td><td>" . $row["lname"] . ", " . $row["fname"].
                    "</td><td>" . $row["email"].
                    "</td><td>" . $row["referral"].
                    "</td></tr>";
            }
            else
            {
                continue;
            }
    }
    else
    {
        echo    "<br/>No Skaters Signed Up At This Time";
    }
?>