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

    if ($conn->query("UPDATE events SET IsDeleted=1 WHERE id=$id") === TRUE )
    {
        header("Location: /admin.php");
        exit;
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error . "<br>".
             "Please contact support";
    }
?>