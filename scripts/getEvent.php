<?php
    require "dbConnect.php";

    $id = $_REQUEST['id'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("select * from events where id=$id");
    $row = $result->fetch_assoc();

    $dateToString = strval($row["eventDate"]);

    $dateToFormat = mktime(0, 0, 0, 
                            intval($dateToString[4] . $dateToString[5]),
                            intval($dateToString[6] . $dateToString[7]),
                            intval($dateToString[0] . $dateToString[1] . $dateToString[2] . $dateToString[3]));
    $date = date("D, F j, Y", $dateToFormat);
    
    echo    "<div id='waiverEventText'>".
            $row["eventName"].
            "<br/>" . "<span id='date'>" .$date . "</span>".
            "<br/><span id='time'>". $row["eventStart"];
            if ($row["eventEnd"] != null)
            {
                echo    " - " . $row["eventEnd"] . "</span>";
            }
            if ($row["Price"] > 0)
            {
                echo    "<br/><span id='price' class='moneyField'>$" . number_format($row["Price"], 2) . "</span></div>";
            }
            else
            {
                echo    "<br/><span id='price'>FREE</span></div>";
            }
?>