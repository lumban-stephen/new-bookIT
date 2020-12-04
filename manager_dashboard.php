<?php
   session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BookIT</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
        <img>
        <div>
            <img>
            <p>Welcome, </p>
            <a><img></img></a>
        </div>
        </header>
        <nav>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="manager_revenue.php">Revenue</a></li>
                <li><a href="manager_records.php">Records</a></li>
                <li><a href="manager_guests.php">Guests</a></li>
                <li><a href="manager_room-mgt.php">Room Management</a></li>
                <li><a href="manager_staff.php">Staff Management</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code here for manager_dashboard-->
            <div class="dash-box" id="mgt-guests-in"></div>
            <div class="dash-box" id="mgt-vacancies"></div>
            <div class="dash-box" id="mgt-coming"></div>
            <div class="dash-box" id="mgt-reservation"></div>
            <div class="dash-long-box" id="mgt-earnings"></div>
        </div>
    </body>