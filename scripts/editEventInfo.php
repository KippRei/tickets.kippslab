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

    $result = $conn->query("SELECT * FROM events WHERE id=$id");
    $event = $result->fetch_assoc();

    $formattedDate = $event["eventDate"][0] . $event["eventDate"][1] . $event["eventDate"][2] . $event["eventDate"][3] . 
                     "-". $event["eventDate"][4] . $event["eventDate"][5] .
                     "-". $event["eventDate"][6] . $event["eventDate"][7];  

    echo    '<form action="scripts/updateEvent.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value='.$id.'>
                <table id="editEventTable">
                    <tr>
                        <td>
                            <label for="eventName">Event Name:</label>
                        </td>
                        <td>
                            <input type="text" name="eventName" value="'.$event["eventName"].'" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="eventDate">Event Date:</label>
                        </td>
                        <td>
                            <input type="date" name="eventDate" value="'.$formattedDate.'" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="eventStart">Event Start Time:</label>
                        </td>
                        <td>
                            <input type="text" name="eventStart" value="'.$event["eventStart"].'" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="eventEnd">Event End Time:</label>
                        </td>
                        <td>
                            <input type="text" name="eventEnd" value="'.$event["eventEnd"].'">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="price">Price:</label>
                        </td>
                        <td>
                        <input type="number" min="0" step=".01" class="moneyField" name="price" value="'.
                        number_format($event["Price"], 2).
                        '" required>
                        </td>
                    </tr> 
                    <tr>
                        <td>
                            <label for="maxCap">Max Capacity:</label>
                        </td>
                        <td>
                            <input type="number" name="maxCap" value="'.$event["MaxCapacity"].'">
                        </td>
                    </tr> 
                    <tr>
                        <td>
                            <label for="flyer">Change Flyer:</label>
                        </td>
                        <td>
                            <div id="drop-area">
                                <input type="hidden" name="currentFlyerName" value="' . $event["flyer"] . '">
                                <input type="file" id="flyer" name="flyer">
                                <script src="/scripts/dragDrop.js"></script>
                            </div>
                        </td>
                    </tr>      
                </table>
                <div class="adminBtnBG">
                    <input type="submit" class="adminBtn" value="Update">
                </div>
            </form>';
?>