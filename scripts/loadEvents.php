<?php
    require "dbConnect.php";
    date_default_timezone_set("America/Los_Angeles");
    $todaysDate = date("Ymd");

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
    //$result = $conn->query("select * from events where eventDate >= $todaysDate order by eventDate");

    $isLive = true;

    while ($row = $result->fetch_assoc())
    {
        // Default image for events
        $flyer = '/images/rollerskateMobile.jpg';
        if ($row["flyer"] !== NUll && $row["flyer"] !== 'none') {
            $flyer = '../' . $row["flyer"];
        }

        if ($row["IsDeleted"] == 0)
        {
            $remainingSpots = 0;
            $dateToString = strval($row["eventDate"]);
            $dateToFormat = mktime(0, 0, 0, 
                                   intval($dateToString[4] . $dateToString[5]),
                                   intval($dateToString[6] . $dateToString[7]),
                                   intval($dateToString[0] . $dateToString[1] . $dateToString[2] . $dateToString[3]));
            $date = date("D, F j", $dateToFormat);

            // TODO: Ugly ass way of getting skater count for each event
            $getCount = $conn->query("SELECT COUNT(*) FROM skaters WHERE SessionID=$row[id] AND IsDeleted=0");
            $count = intval($getCount->fetch_assoc()["COUNT(*)"]);

            if ($row["MaxCapacity"] != NULL)
            {
                $remainingSpots = $row["MaxCapacity"] - $count;
            }

            // gets $formAction for form (signup page or sold out popup)
            if ($remainingSpots > 0 && $row["MaxCapacity"] != NULL)
            {
                $formAction = "/signup.php";
            }
            else if ($remainingSpots <= 0 && $row["MaxCapacity"] != NULL)
            {
                $formAction = "/soldout.php";
            }
            else if ($row["MaxCapacity"] == NULL)
            {
                $formAction = "/signup.php";
            }


            if ($row["Price"] == 0)
            {
                $price = "FREE";
            }
            else
            {
                $price = '$' . number_format($row["Price"], 2);
            }


            if ($result->num_rows > 0)
            {
                if ($isLive)
                {
                    echo    "<form action='$formAction' method='POST'>".
                                "<input type='hidden' name='id' value=$row[id]>".
                                "<button class='eventButton available' type='submit'>".
                                    "<div class='indexEventInfo'>".
                                        "<div class='indexEventTitle'>".
                                            $row["eventName"].
                                        "</div>".
                                        "<div class='indexEventDate eventDetails'>".
                                            $date.
                                        "</div>".
                                        "<div class='indexEventTime eventDetails'>".
                                            $row["eventStart"];
                                        if ($row["eventEnd"] == null) 
                                        {
                                            echo    "</div>";
                                        }
                                        else
                                        {
                                            echo    " - " . $row["eventEnd"] . "</div>";
                                        }
                        
                    echo                "<div class='indexEventPrice eventDetails'>".
                                            $price.
                                        "</div>".
                                        "<div class='indexEventSpots eventDetails' ";
                                         if ($remainingSpots > 0 && $remainingSpots < 11 && $row["MaxCapacity"] != NULL)
                                        {
                                            echo    ">Spots Left: " . $remainingSpots;
                                        }
                                        else if ($remainingSpots <= 0 && $row["MaxCapacity"] != NULL)
                                        {
                                            echo    "style='color: red;'>SOLD OUT";
                                        }
                                        else
                                        {
                                            echo    "><div style='visibility: hidden;'>PLaceholder</div>";
                                        }
                    echo                "</div>".
                                    "</div>".
                                    "<div class='eventImageLoc'>".
                                        "<img class='eventImage' src='". $flyer ."'>".
                                    "</div>".
                                "</button>".
                            "</form>".
                            "<div class='contentBuffer'></div>".
                            "<div class='contentBuffer'></div>".
                            "<div class='contentBuffer'></div>". 
                            // Remove one content buffer div if reverting back to original availability option (i.e. if you uncomment the section below)
                            "<div class='contentBuffer'></div>";
                            
                    /// UNCOMMENT BELOW IF YOU ONLY WANT TO ALLOW THE PURCHASING OF TICKETS TO THE NEAREST UPCOMING EVENT (WILL SHOW EVENTS AFTER BUT NOT ALLOW PURCHASE)
                    // echo    "<hr/>".
                    //         "<div class='indexSectionTitle'>Future Dates</div>".
                    //         "<div class='contentBuffer'></div>".
                    //         "<div class='contentBuffer'></div>".
                    //         "<div class='contentBuffer'></div>";

                    // $isLive = false;

                    // if ($result->num_rows == 1)
                    //     echo "<button class='eventButton noPointer'>".
                    //                 "<div class='indexEventInfo'>".
                    //                     "<div class='eventDetails greyedOut'>".
                    //                 "No Future Dates At This Time".
                    //                 "</div></div>".
                    //             "</button>".
                    //         "<div class='contentBuffer'></div>".
                    //         "<div class='contentBuffer'></div>".
                    //         "<div class='contentBuffer'></div>".
                    //         "<div class='contentBuffer'></div>".
                    //         "<div class='contentBuffer'></div>";
                    
                }
                else if (!$isLive)
                { 
                    echo    "<div class='contentBuffer'></div>".
                            "<div>".
                                "<button class='eventButton noPointer'>".
                                    "<div class='indexEventInfo'>".
                                        "<div class='indexEventTitle greyedOut'>".
                                            $row["eventName"].
                                        "</div>".
                                        "<div class='indexEventDate eventDetails greyedOut'>".
                                            $date.
                                        "</div>".
                                        "<div class='indexEventTime eventDetails greyedOut'>".
                                        $row["eventStart"];
                                        if ($row["eventEnd"] == null) 
                                        {
                                            echo    "</div>";
                                        }
                                        else
                                        {
                                            echo    " - " . $row["eventEnd"] . "</div>";
                                        }
                    echo                "<div class='indexEventPrice eventDetails greyedOut'>".
                                            $price.
                                        "</div>".
                                        "<div class='indexEventSpots eventDetails greyedOut'>";
                                        if ($remainingSpots > 0 && $remainingSpots < 11 && $row["MaxCapacity"] != NULL)
                                        {
                                            echo    "Spots Left: " . $remainingSpots;
                                        }
                                        else if ($remainingSpots <= 0 && $row["MaxCapacity"] != NULL)
                                        {
                                            echo    "SOLD OUT";
                                        }
                                        else
                                        {
                                            echo    "<div style='visibility: hidden;'>PLaceholder</div>";
                                        }
                    echo               "</div>".
                                    "</div>".
                                    "<div class='eventImageLoc'>".
                                        "<img class='eventImage greyedOut' src='". $flyer ."'>".
                                    "</div>".
                                "</button>".
                            "</div>".
                            "<div class='contentBuffer'></div>".
                            "<div class='contentBuffer'></div>".
                            "<div class='contentBuffer'></div>".
                            "<div class='contentBuffer'></div>".
                            "<div class='contentBuffer'></div>";
                }
                else
                {
                    echo    "<div class='centered'>".
                            "No Dates Available At This Time<br/>".
                            "Check Back Soon!";
                } 
            }
        }
    }  
?>