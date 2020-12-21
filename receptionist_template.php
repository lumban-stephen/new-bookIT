<?php
   session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Receptionist Template</title>
        <link rel="stylesheet" href="style.css">
        <style>
            .datetime{
            color: #fff;
            background: #10101E;
            font-family: "Segoe UI", sans-serif;
            width: 400px;
            padding: 15px 10px;
            border: 3px solid #2E94E3;
            border-radius: 5px;
            -webkit-box-reflect: below 1px linear-gradient(transparent, rgba(255,255,255,0.1));
            transition: 0.5s;
            transition-property: background, box-shadow;
            }
            .datetime:hover{
            background: #2E94E3;
            box-shadow: 0 0 30PX #2E94E3;
            }
            .date{
            font-size: 30px;
            font-weight:600;
            text-align: center;
            letter-spacing: 3px;
            }
            .time{
            font-size: 60px;
            display: flex;
            justify-content: center;
            }
            .time span:not(:last-child){
            position: relative;
            margin: 0 6px;
            font-weight: 600;
            text-align: center;
            letter-spacing: 3px;
            }
            .time span:last-child{
            background: #2E94E3;
            font-size: 30px;
            font-weight: 600;
            text-transform: uppercase;
            margin-top: 10px;
            padding: 0 5px;
            border-radius: 3px;
            }
            </style>
    </head>
    <body>
        <header>
        <div id="header">
        <img src="assets/bookIT_Logo.png">
            <div class="right-float">
                <img>
            </div>
            <div class="right-float">
                <p>Welcome Receptionist  </p>
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
        <div id="content" onload="initClock()">
                    <div class="datetime">
                        <div class="date">
                            <span id="dayname">Day</span>
                            <span id="month">Month</span>
                            <span id="daynum">00</span>
                            <span id="year">Year</span>
                        </div>
                        <div class="time">
                            <span id="hour">00</span>:
                            <span id="minutes">00</span>:
                            <span id="seconds">00</span>
                            <span id="period">AM</span>
                        </div> 
                </div>
            <script type="text/javascript">
                function updateClock(){
                    var now = new Date();
                    var dname = now.getDay(),
                        mo = now.getMonth(),
                        dnum = now.getDate(),
                        yr = now.getFullYear(),
                        hou = now.getHours(),
                        min = now.getMinutes(),
                        sec = npw.getSeconds(),
                        pe = "AM";

                        var motths = 'Kanuary,')
                        
                }
                function initClock(){
                    updateClock();
                    window.setInterval("updateClock()")
                }

            </script>
            </div>
    </body>
