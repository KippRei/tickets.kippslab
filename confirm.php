<?php session_start(); ?>
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
<body>
    <div>
        <img id="logo" src="/images/cageLogo.png"/>
    </div>
    <div class="contentBuffer"></div>
    <div class="contentBuffer"></div>
    <div class="contentBuffer"></div>
    <div class="contentBuffer"></div>
    <div class="confirmContainer">
        <div class="confirmContent">
            <?php //include "getTicketInfo.php"; ?>
        <div class="contentBuffer"></div>
        <div class="contentBuffer"></div>
        </div>

        <div class="confirmContent">
            You're all set!<br><br/>
            You should be receiving an email with your ticket info shortly.<br/>
            (If you don't see it in your Inbox, be sure and check your Spam/Junk and Promotions folders)<br/><br/>
            If you have any questions, please contact: <a href="mailto:Support@Skatingtix.com">Support@Skatingtix.com</a><br><br/>
            
            We look forward to seeing you soon!
        </div>
        <div class="contentBuffer"></div>
        <div class="contentBuffer"></div>
        <!--<div id="mailingListText">Sign Up To Get Notified Of New Events!</div>-->
    </div>

    <!--<div id="mailingListSignup">-->
    <!--    <form action="javascript: AddToMailingList()" method="POST">-->
    <!--        <label for="mailingListFName" class="mailingListInputText">First Name</label><br/>-->
    <!--        <input type="text" id="mailingListFName" class="mailingListInput" value="<?php echo $_SESSION['fname']; ?>" required><br/>-->
    <!--        <label for="mailingListLName" class="mailingListInputText">Last Name</label><br/>-->
    <!--        <input id="mailingListLName" type="text" class="mailingListInput" value="<?php echo $_SESSION['lname']; ?>" required><br/>-->
    <!--        <label for="mailingListEmail" class="mailingListInputText">Email</label><br/>-->
    <!--        <input id="mailingListEmail" type="text" class="mailingListInput" value="<?php echo $_SESSION['email']; ?>" required><br/>-->
    <!--        <input id="mailingListBtn" type="submit" value="Submit">-->
    <!--    </form>-->
    <!--    </div>-->
    <!--    <div class="contentBuffer"></div>-->
    <!--    <div class="contentBuffer"></div>-->
    <!--    <div class="contentBuffer"></div>-->
    <!--    <div class="contentBuffer"></div>-->
    <!--</div>-->

    <div class="confirmContainer">
        <div class="confirmContent">
            <a href="/index.php">Click Here To Return To The Tickets Home Page!</a>
        </div>
        <div class="contentBuffer"></div>
        <div class="contentBuffer"></div>

        <div class="confirmContent">
            Click Here To Go To [Rink Website]!
        </div>
        <div class="contentBuffer"></div>
        <div class="contentBuffer"></div>
        
    </div>
</body>
</html>