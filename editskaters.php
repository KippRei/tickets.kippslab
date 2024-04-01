<?php require "scripts/loggedin.php"; ?>
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
    
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/normalize.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/scripts/js.js"></script>
</head>

<body id="editSkatersPage" style="background-color:black;">
    <div>
        <img id="logoCenter" src="/images/cageLogo.png"/>
    </div>
    <div id="logout">
        <form action="/scripts/logout.php">
            <input id="logoutBtn" type="submit" value="Log Out">
        </form>
    </div>

    <div class="contentBuffer"></div>
    <div class="contentBuffer"></div>
    <div class="adminBtnBG">
        <button class="adminBtn" onclick="location.href= '/admin.php'">Back To Admin Home Page</button>
    </div>

    <button class="centered adminTableLabel collapsible">Edit Skaters</button>
    <div class="content content-open">
    <table id="editSkatersTable">
        <tr>
            <th>Ticket #</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th class="centerText">Update</th>
            <th class="centerText">Delete</th>
        </tr>
        <!-- Populate list of signed up skaters -->
        <?php require "scripts/editSkatersInfo.php"; ?>
    </table>
    </div>

    <button class="centered adminTableLabel collapsible">Add Skater</button>
    <div class="content">
    <form action="/scripts/addSkater.php" method="POST">
        <input type="hidden" name="sessionid" value="<?php echo $_REQUEST["id"]; ?>">
        <table id="addSkaterTable">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
            </tr>
            <tr>
                <td>
                    <input type="text" name="fname" required>
                </td>

                <td>
                    <input type="text" name="lname" required>
                </td>

                <td>
                    <input type="text" name="email" required>
                </td>
            </tr>
        </table>
        <div class="adminBtnBG">
            <input type="submit" class="adminBtn" value="Add">
        </div>
    </form>
    </div>

    <button class="centered adminTableLabel collapsible">Restore Deleted Skater</button>
    <div class="content">
    <form action="/scripts/undoDelSkater.php" method="POST">
        <input type="hidden" name="sessionid" value="<?php echo $_REQUEST["id"]; ?>">
        <table id="editSkatersTable">
            <tr>
                <td>
                    <select class="adminList" name="id">
                        <?php include "scripts/getDelSkaters.php"; ?>;
                    </select>
                </td>
            </tr>
        </table>
        <div class="adminBtnBG">
            <input type="submit" class="adminBtn" value="Restore">
        </div>
    </form>
    </div>

    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, "/admin.php");
        }
    </script>
</body>
</html>