<?php
    require "loggedin.php";
    require "dbConnect.php";
    
    $id = $_REQUEST["id"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT * FROM skaters WHERE SessionID=$id and IsDeleted=1 order by lname, fname");

    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
        echo    "<option value=$row[id]>".
                $row["lname"].
                ", ".
                $row["fname"].
                " - ".
                $row["email"].
                "</option>";
        }
    }
    else
    {
        echo    "<option value='NULL'>No Deleted Skaters Found</option>";
    }
?>