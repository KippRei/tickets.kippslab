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

<body id="adminPage" style="background-color:black;">
    <div>
        <img id="logoCenter" src="/images/cageLogo.png"/>
    </div>
    <div id="logout">
        <form action="/scripts/logout.php">
            <input id="logoutBtn" type="submit" value="Log Out">
        </form>
    </div>
    <button class="centered adminTableLabel collapsible">Edit Event</button>
    <div class="content-open">
        <?php require "scripts/editEventInfo.php"; ?>
    </div>

    <div class="adminBtnBG">
        <button class="adminBtn" onclick="location.href= '/admin.php'">Back To Admin Home Page</button>
    </div>

    <div class="adminBtnBG">
    <button class="adminBtn" onclick="DeleteEventPopup()">Delete Event</button>
    </div>

    <div id="popupBG">
        <div id="deleteConfirmPopup">
            <div id="popupText">
                Are You Sure You Want To Delete This Event?
            </div>
            <form action="scripts/deleteEvent.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $_REQUEST["id"];?>"/>
                <input type="submit" id="delPopupDelBtn" class="adminBtn" value="Delete Event"/>
            </form>
            <button class="adminBtn" id="delPopupCancelBtn" onclick="ClosePopup()">Cancel</button>
        </div>
    </div>

    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, "/admin.php");
        }
    </script>
</body>
</html>