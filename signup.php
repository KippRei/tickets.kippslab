<?php require "scripts/isSoldOut.php"; ?>
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
        <!--If site were accepting payment, the PayPal SDK script would be located here-->
    <script src="/scripts/js.js"></script>
</head>

<body>
    <div id="loadingBG">
        <img id="loadingImg" src="/images/loading.gif" alt="loading...">
    </div>

    <div id="rules">
        <div id="rulesContent">
            <img class="rulesImg" src="/images/noDrinkSmoke.png" alt="No Alcohol or Drugs">
            <br/>
            This is an alcohol and drug-free event.<br/>
            <br/>
            <!--<img class="rulesImg" src="/images/masksReq.png" alt="Face Masks Are Required">-->
            <!--<br/>-->
            <!--Currently face masks are required at all times.<br/>-->
            <!--<br/>-->
        </div>
        <button id="rulesBtnOk" onclick="CloseRules()">Accept</button>
        <button id="rulesBtnNo" onclick="window.location.href='/index.php'">Cancel</button>
    </div>

    <div id="signupPage">
        <div>
            <img id="logo" src="/images/cageLogo.png"/>
        </div>

        <div class="contentBuffer"></div>

        <div id="waiverPageEventTitleLoc">
            <?php include "scripts/getEvent.php"; ?>
        </div>

        <div class="contentBuffer"></div>
        <div id="noticeTextLoc">
            <div style="text-decoration: underline;">NOTICE</div>
            <div>We DO NOT offer skate rentals at this time. Please bring your own skates with you to the event.</div>
        </div>

        <div class="contentBuffer"></div>

        <div id="waiverFrame">
            <iframe src="/docs/waiver.php" width="100%" height="300" id="waiver"></iframe> 
        </div>

        <form id="addSkater" action="javascript:AddToDb()">
            <input type="hidden" id="id" name="id" value=
                <?php
                    $id = $_REQUEST['id'];
                    echo $id;
                ?>
            >

            <div id="waiverLoc">
                <div class="contentBuffer"></div>
                <div class="waiverCheckboxLoc">
                    <input type="checkbox" id="waiverCheckbox" onclick="CheckForm()" required>
                    <div id="waiverCheckboxText">
                        By checking this box I hereby certify that I am at 
                        least eighteen (18) years old and agree to the terms and
                        conditions of this waiver.
                    </div>
                </div>
                <div class="contentBuffer"></div>
                 <div id="salesFinalText">
                    <br/>
                    <div>PLEASE NOTE THAT ALL SALES ARE FINAL.</div>
                </div>
                <div class="contentBuffer"></div>
                <br/>

                <script>
                    GetPrice();
                </script>
                
                <label for="tickets" class="waiverInput">Ticket Quantity:</label><br/>
                <select id="tickets" class="waiverInput" name="tickets" onchange="PopulateTicketForm();" required>
                    <?php require "scripts/ticketQuants.php"; ?>
                </select>
                <br/>

                <div id="ticketForm"></div>
                <hr>
            </div>


            <!-- TODO: This button is for testing only. REMOVE BEFORE GOING LIVE!-->
            <!--<input type="submit" value="test"> -->

            <div id="ppBtn">
                <div id="paypal-button"></div>
                <div id="formWarning">Please Fill Out All Fields To Continue</div>
                <img id='greyedPPBtn' src="/images/ppDisabled.jpg">
            </div>
        </form>
        <footer>
            Copyright &#169 2024 <a href="https://skatingtix.com">Skatingtix.com</d>
        </footer>
    </div>
    
    <script>
        PopulateTicketForm();
        document.getElementById("paypal-button").style.display="none";
    </script>
    <script>
        if ( window.history.replaceState ) {
        window.history.replaceState( null, null, "/index.php");
        }
    </script>
</body>
</html>