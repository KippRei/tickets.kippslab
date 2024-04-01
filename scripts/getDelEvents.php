<?php
    require "loggedin.php";
    require "dbConnect.php";
    date_default_timezone_set("America/Los_Angeles");
    $todaysDate = date("Ymd");

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("select * from events where eventDate >= $todaysDate and IsDeleted=1 order by eventDate");

    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $date = $row["eventDate"][4] . $row["eventDate"][5] .
                    "/" .
                    $row["eventDate"][6] . $row["eventDate"][7] .
                    "/" .
                    $row["eventDate"][0] . $row["eventDate"][1] . $row["eventDate"][2] . $row["eventDate"][3];
            
            echo    "<option value=$row[id]>".
                    $row["eventName"].
                    " :: ".
                    $date.
                    " :: ".
                    $row["eventStart"].
                    " - ".
                    $row["eventEnd"].
                    " :: $".
                    number_format($row["Price"], 2).
                    "</option>";
        }
    }
    else
    {
        echo    "<option value='NULL'>No Deleted Events Found</option>";
    }
?>