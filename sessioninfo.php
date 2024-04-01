<?php 
    require "scripts/loggedin.php";
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $id = $_REQUEST["id"];
    }
    if ($id == 'NULL')
    {
        header("Location: /admin.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">      
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <meta name="description" content="Get tickets here for Cage Roller Hockey Events.">
    
    <!-- Favicon Icons -->
    <!-- icon in the highest resolution we need it for -->
    <link rel="icon" href="icon.png">
    
    <!-- reuse same icon for Safari -->
    <link rel="apple-touch-icon" href="ios-icon.png">
    
    <!-- multiple icons for IE -->
    <meta name="msapplication-square310x310logo" content="icon_largetile.png">

    <meta name="theme-color" content="#444444">
    
    <title>Cage Hockey Event Tickets</title>
    
    <link rel="stylesheet" href="/css/styles.css" media="screen">
    <link rel="stylesheet" href="/css/printstyle.css" media="print">
    <link rel="stylesheet" href="/css/normalize.css" media="all">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/scripts/js.js"></script>
    <script src="/scripts/sortOrder.js"></script>
    <script>
        const sortMethod = "<?php echo $_REQUEST["sortType"]; ?>";
        const id = "<?php echo $id; ?>";
    </script>
</head>
<body>
    <!--TODO: FIX PRINT-->
    <!--<button id="printBtn" onclick="Print()">-->
    <!--    Print-->
    <!--</button>-->
    <div id="printArea">
        <div id="eventTitle">
            <?php include "scripts/getEvent.php"; ?>
            <?php include "scripts/getSkaterCount.php"; ?>
        </div>
        <table>
            <tr>
                <th id="tickets"><a class="sortButton" href="/sessioninfo.php?sortType=id asc&id=<?php echo $id; ?>">Ticket #</a></input></th>
                <th id="names"><a class="sortButton" href="/sessioninfo.php?sortType=lname+asc%2Cfname+asc&id=<?php echo $id; ?>">Name</a></th>
                <th id="emails"><a class="sortButton" href="/sessioninfo.php?sortType=email+asc&id=<?php echo $id; ?>">Email</a></th>
                <th id="referrals"><a class="sortButton" href="/sessioninfo.php?sortType=referral+desc&id=<?php echo $id; ?>">Referred By</a></th>
            </tr>
            <!-- Populate list of signed up skaters -->
            <?php 
                $sortType = $_REQUEST["sortType"];
                include "scripts/getEventSkaterList.php";
            ?>
        </table>
    </div>
</body>
</html>