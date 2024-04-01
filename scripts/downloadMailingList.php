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

    // Download Mailing List
    //$result = $conn->query("SELECT * FROM mailinglist");
    // END Download Mailing List
    
    // Download Full Skater List
    if ($id === "full") {
        $result = $conn->query("SELECT * FROM skaters"); // get full skater list
        $stmt = $conn->prepare("INSERT IGNORE INTO fullmailinglist (fname, lname, email) VALUES (?, ?, ?)");
    
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $fname = $row['fname'];
                $lname = $row['lname'];
                $email = $row['email'];
                $stmt->bind_param('sss', $fname, $lname, $email);
                $stmt->execute();
            }
        }
        $stmt->close();
        $result = $conn->query("SELECT * FROM fullmailinglist"); // get full mailing list (everyone who has attended an event)
    }
    // END Download Full Skater List
    // Download Weekly Skater List
    else {
        $result = $conn->query("SELECT * FROM skaters where SessionId=$id"); // get full skater list
        $stmt = $conn->prepare("INSERT INTO weeklymailinglist (fname, lname, email) VALUES (?, ?, ?)");
    
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $fname = $row['fname'];
                $lname = $row['lname'];
                $email = $row['email'];
                $stmt->bind_param("sss", $fname, $lname, $email);
                $stmt->execute();
            }
        }
        $stmt->close();
        $result = $conn->query("SELECT * FROM weeklymailinglist"); 
        $conn->query("DELETE FROM `weeklymailinglist`");
    }
    
    $mailArrCsv = fopen($_SERVER["DOCUMENT_ROOT"] . '/docs/OpenSkateMailingList.csv', 'w+');
 
    if ($result->num_rows > 0)
    {
        $addArr = [];
        array_push($addArr, "First Name");
        array_push($addArr, "Last Name");
        array_push($addArr, "Email");
        fputcsv($mailArrCsv, $addArr);

        $addArr = [];
        array_push($addArr, "----------");
        array_push($addArr, "----------");
        array_push($addArr, "----------");
        fputcsv($mailArrCsv, $addArr);

        while ($row = $result->fetch_assoc())
        {
            $addArr = [];
            array_push($addArr, $row['fname']);
            array_push($addArr, $row['lname']);
            array_push($addArr, $row['email']);
            fputcsv($mailArrCsv, $addArr);
        }
    }
    
    fclose($mailArrCsv);

    $attachment_location = $_SERVER["DOCUMENT_ROOT"] . '/docs/OpenSkateMailingList.csv';
    if (file_exists($attachment_location)) {

        header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
        header('Content-Description: File Transfer');
        header("Cache-Control: public"); // needed for internet explorer
        header("Content-Type: application/download");
        header("Content-Transfer-Encoding: Text");
        header("Content-Length:".filesize($attachment_location));
        header('Content-Disposition: attachment; filename="OpenSkateMailingList.csv"');
        readfile($attachment_location);
        //unlink($_SERVER["DOCUMENT_ROOT"] . '/docs/OpenSkateMailingList.csv');
        exit;      
    } else {
        die("Error: File not found.");
    }
?>