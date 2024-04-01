<?php
    require "dbConnect.php";

    $id = $_REQUEST['id'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT Price, MaxCapacity from events WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $price = number_format($row["Price"], 2);
    $maxCap = $row["MaxCapacity"];
    var_dump($row["MaxCapacity"]);
    $stmt->close();

    $stmt = $conn->prepare("SELECT COUNT(*) FROM skaters WHERE SessionID=? AND IsDeleted=0");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = intval($result->fetch_assoc()["COUNT(*)"]);
    $stmt->close();

    var_dump($maxCap);
    if ($maxCap - $count >= 6 || $maxCap <= 0)
    {
        echo        '<option class="moneyField" value="1">1 x $'. $price . ' = $' . number_format(($price * 1), 2) . '</option>'.
                    '<option class="moneyField" value="2">2 x $'. $price . ' = $' . number_format(($price * 2), 2) . '</option>'.
                    '<option class="moneyField" value="3">3 x $'. $price . ' = $' . number_format(($price * 3), 2) . '</option>'.
                    '<option class="moneyField" value="4">4 x $'. $price . ' = $' . number_format(($price * 4), 2) . '</option>'.
                    '<option class="moneyField" value="5">5 x $'. $price . ' = $' . number_format(($price * 5), 2) . '</option>'.
                    '<option class="moneyField" value="6">6 x $'. $price . ' = $' . number_format(($price * 6), 2) . '</option>';
    }

    else if ($maxCap - $count > 0 && $maxCap - $count < 6)
    {
        $ticketsLeft = $maxCap - $count;
        for ($i = 1; $i <= $ticketsLeft; $i++)
        {
            echo        '<option class="moneyField" value="'.$i.'">'.$i.' x $'. $price . ' = $' . number_format(($price * $i), 2) . '</option>';
        }
    }
    else
    {
        echo        '<option value="0">No Tickets Available</option>';
    }
?>