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
        <link rel="stylesheet" href="ameneties.css">
    </head>
    <body>
        <header>
        <div id="header">
        <img src="assets/bookIT_Logo.png">
            <div class="right-float">
                <img>
            </div>
            <div class="right-float">
                <p>Welcome,</p>
            </div>
            <div class="right-float">
                <a><img></img></a>
            </div>
        </div>
        </header>
        <nav>
            <ul>
                <li><a href="receptionist_dashboard.php">Dashboard</a></li>
                <li><a href="receptionist_checkin.php">Check In</a></li>
                <li><a href="receptionist_checkout.php">Check Out</a></li>
                <li><a href="receptionist_reservation.php">Reservation</a></li>
                <li><a href="receptionist_records.php">Records</a></li>
                <li><a href="receptionist_toDoList.php">To Do List</a></li>
                <li><a href="receptionist_guests.php">Guests</a></li>
            </ul>
        </nav>
        <div id="content">
            <div class="amty">
                <p>Hygiene</p>
                <div class="amty-box">
                    <img src="assets/img-dummy.jpg">
                    <p class="name"></p>
                    <div class="counter"><div class="minus"></div><!--Insert php number--><div class="plus"></div></div>
                </div>
                <div class="amty-box">
                    <img src="assets/img-dummy.jpg">
                    <p class="name"></p>
                    <div class="counter"><img class="minus"><!--Insert php number--><img class="plus"></div>
                </div>
                <div class="amty-box">
                    <img src="assets/img-dummy.jpg">
                    <p class="name"></p>
                    <div class="counter"><img class="minus"><!--Insert php number--><img class="plus"></div>
                </div>
                <hr>
            </div>
            <div class="amty">
                <p>Food</p>
                <div class="amty-box">
                    <img src="assets/img-dummy.jpg">
                    <p class="name"></p>
                    <div class="counter"><img class="minus"><!--Insert php number--><img class="plus"></div>
                </div>
                <div class="amty-box">
                    <img src="assets/img-dummy.jpg">
                    <p class="name"></p>
                    <div class="counter"><img class="minus"><!--Insert php number--><img class="plus"></div>
                </div>
                <div class="amty-box">
                    <img src="assets/img-dummy.jpg">
                    <p class="name"></p>
                    <div class="counter"><img class="minus"><!--Insert php number--><img class="plus"></div>
                </div>
                <div class="amty-box">
                    <img src="assets/img-dummy.jpg">
                    <p class="name"></p>
                    <div class="counter"><img class="minus"><!--Insert php number--><img class="plus"></div>
                </div>
                <hr>
            </div>
            <div class="amty">
                <p>Extras</p>
                <div class="amty-box">
                    <img src="assets/img-dummy.jpg">
                    <p class="name"></p>
                    <div class="counter"><img class="minus"><!--Insert php number--><img class="plus"></div>
                </div>
                <div class="amty-box">
                    <img src="assets/img-dummy.jpg">
                    <p class="name"></p>
                    <div class="counter"><img class="minus"><!--Insert php number--><img class="plus"></div>
                </div>
                <div class="amty-box">
                    <img src="assets/img-dummy.jpg">
                    <p class="name"></p>
                    <div class="counter"><img class="minus"><!--Insert php number--><img class="plus"></div>
                </div>
                <hr>
            </div>
            <div class="amty">
                <p>Guest Details</p>
                <div class="amty-desc">
                    <p>Guest Name: </p>
                    <p>Bill ID: </p>
                    <p>Total Amount: </p>
                    <div class="amty-btn bluegray">Process Order</div>
                    <div class="amty-btn green">Check In</div>
                </div>
            </div>
        </div>
    </body>