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
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script src="/scripts/js.js"></script>
</head>
<body style="background-color: black;">
    <div>
        <img id="logo" src="/images/cageLogo.png"/>
    </div>
    <div id="adminLoginFormLoc">
        <form id="adminLoginForm" action="/scripts/validateUser.php" method="POST">
            <label for="username" class="adminLoginLabelText">Username:</label><br/>
            <input name="username" class="adminLoginFields" type="text"><br/>
            <label for="password" class="adminLoginLabelText">Password:</label><br/>
            <input name="password" class="adminLoginFields" id="password" type="password"><br/>
            <input type="checkbox" class="adminLoginFields" onclick="ShowPassword()"><span class="adminLoginLabelText"> Show Password</span><br/>
            <div class="contentBuffer"></div>
            <input type="submit" id="adminLoginBtn" value="Log In">
        </form>
    </div>
</body>
</html>
