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

<body id="adminPage" style="background-color: black;">

    <div>
        <img id="logoCenter" src="/images/cageLogo.png"/>
    </div>
    <div id="logout">
        <form action="/scripts/logout.php">
            <input id="logoutBtn" type="submit" value="Log Out">
        </form>
    </div>
    <!-- <nav id="adminNav">
        <a href="#skaters" class="navItems">Skater List</a>
        <a href="#create" class="navItems">Create Event</a>
        <a href="#edit" class="navItems">Edit Event</a>
        <a href="#restore" class="navItems">Restore Deleted Event</a>
    </nav> -->


    <button id="skaters" class="centered adminTableLabel collapsible">Skater List</button>
    <div class="content">
    <form action="/sessioninfo.php" method="GET">
        <input type="hidden" name="sortType" value="lname asc,fname asc">
        <table  id="skaterListTable">
            <tr>
                <td>
                    <select class="adminList" name="id">
                        <?php include "scripts/skaterLists.php"; ?>;
                    </select>
                </td>
            </tr>
        </table>
        <div class="adminBtnBG">
            <input type="submit" class="adminBtn" value="Get Skater List">
        </div>
    </form>
    </div>

    <button id="editSkaters" class="centered adminTableLabel collapsible">Edit Skater List</button>
    <div class="content">
    <form action="/editskaters.php" method="POST">
        <table  id="editSkatersTable">
            <tr>
                <td>
                    <select class="adminList" name="id">
                        <?php include "scripts/skaterLists.php"; ?>;
                    </select>
                </td>
            </tr>
        </table>
        <div class="adminBtnBG">
            <input type="submit" class="adminBtn" value="Edit Skater List">
        </div>
    </form>
    </div>

    <button id="create" class="centered adminTableLabel collapsible">Create Event</button>
    <div class="content">
    <form action="/scripts/createEvent.php" method="POST" enctype="multipart/form-data">
        <table id="createEventTable" class="centerTable">
            <tr>
                <td>
                    <label for="eventName">New Event Name:</label>
                </td>
                <td>
                    <input type="text" name="eventName" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="eventDate">Event Date:</label>
                </td>
                <td>
                    <input type="date" name="eventDate" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="eventStart">Event Start Time:</label>
                </td>
                <td>
                    <input type="text" name="eventStart" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="eventEnd">Event End Time:</label>
                </td>
                <td>
                    <input type="text" name="eventEnd">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="price">Price:</label>
                </td>
                <td>
                <input type="number" min="0" step=".01" class="moneyField" name="price" value=0 required>
                </td>
            </tr> 
            <tr>
                <td>
                    <label for="maxCap">Max Capacity:</label>
                </td>
                <td>
                    <input type="number" min="0" name="maxCap">
                </td>
            </tr> 
            <tr>
                <td>
                    <label for="flyer">Upload Flyer:</label>
                </td>
                <td>
                    <div id="drop-area">
                        <input type="file" id="flyer" name="flyer">
                        <script src="/scripts/dragDrop.js"></script>
                    </div>
                </td>
            </tr>   
        </table>
        <div class="adminBtnBG">
            <input type="submit" class="adminBtn" value="Create">
        </div>
    </form>
    </div>

    <button id="edit" class="centered adminTableLabel collapsible">Edit Event</button>
    <div class="content">
    <form action="/editevent.php" method="POST">
    <table id="editEventTable">
        <tr>
            <td>
                <select class="adminList" name="id">
                    <?php include "scripts/skaterLists.php"; ?>;
                </select>
            </td>
        </tr>
    </table>
    <div class="adminBtnBG">
        <input type="submit" class="adminBtn" value="Edit">
    </div>
    </form>
    </div>

    <button id="restore" class="centered adminTableLabel collapsible">Restore Deleted Event</button>
    <div class="content">
    <form action="/scripts/undoDelEvent.php" method="POST">
    <table id="undoDelEventTable">
        <tr>
            <td>
                <select class="adminList" name="id">
                    <?php include "scripts/getDelEvents.php"; ?>;
                </select>
            </td>
        </tr>
    </table>
    <div class="adminBtnBG">
        <input type="submit" class="adminBtn" value="Restore">
    </div>
    </form>
    </div>

    <button id="pastEvents" class="centered adminTableLabel collapsible">Past Events Skater Lists</button>
    <div class="content">
    <form action="/sessioninfo.php" method="GET">
        <input type="hidden" name="sortType" value="lname asc,fname asc">
        <table  id="skaterListTable">
            <tr>
                <td>
                    <select class="adminList" name="id">
                        <?php include "scripts/pastSkaterLists.php"; ?>;
                    </select>
                </td>
            </tr>
        </table>
        <div class="adminBtnBG">
            <input type="submit" class="adminBtn" value="Get Past Event Skater List">
        </div>
    </form>
    </div>

    <button id="downloadMailingList" class="centered adminTableLabel collapsible">Mailing Lists</button>
    <div class="content">
    <form action="/scripts/downloadMailingList.php" method="POST">
        <table  id="skaterListTable">
            <tr>
                <td>
                    <select class="adminList" name="id">
                        <option value="full">Full Mailing List</option>
                        <?php include "scripts/pastSkaterLists.php"; ?>;
                    </select>
                </td>
            </tr>
        </table>
        <div class="adminBtnBG">
            <input type="submit" class="adminBtn" value="Download">
        </div>
    </form>
    </div>

    <button id="addToMailingList" class="centered adminTableLabel collapsible">Add To Mailing List</button>
    <div class="content">
    <form action="javascript: AddToFullMailingList()" method="POST">
        <table id="createEventTable" class="centerTable">
            <tr>
                <td>
                    <label for="fname">First Name:</label>
                </td>
                <td>
                    <input type="text" id="fname" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="lname">Last Name:</label>
                </td>
                <td>
                    <input type="text" id="lname" required>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="email">Email:</label>
                </td>
                <td>
                    <input type="text" id="email" required>
                </td>
            </tr> 
        </table>
        <div class="adminBtnBG">
            <input type="submit" class="adminBtn" value="Add To Mailing List">
        </div>
    </form>
    </div>
</body>
</html>