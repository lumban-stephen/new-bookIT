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
        <div id="header">
        <img src="assets/bookIT_Logo.png">
        <div class="right-float">
                <a>
                    <form method="post" action="#">
                        <button class="Logoutbutton" name="logout">Logout</button>
                    </form>
                </a>
            </div>
            <div class="right-float">
                <p>Welcome,</p>
            </div>
            <div class="right-float">
                <a><img></img></a>
            </div>
        </div>
        </header>
        <?php
            if(isset($_POST['logout'])){
                session_destroy();
                header("location:index.php");
            }
        ?>
        <nav>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="receptionist_checkin.php">Check In</a></li>
                <li><a href="receptionist_checkout.php">Check Out</a></li>
                <li><a href="receptionist_reservation.php">Reservation</a></li>
                <li><a href="receptionist_records.php">Records</a></li>
                <li><a href="receptionist_toDoList.php">To Do List</a></li>
                <li><a href="receptionist_guests.php">Guests</a></li>
            </ul>
        </nav>
        <div id="content">
        <br>
        <h2>Dashboard</h2>
        <br><br>
        <div class="dashwrapper">
                <div class="dash box1" id="mgt-guests-in">
                    <?php
                         include 'connection.php';
        
                         $sql = "SELECT 
                                    count(*)
                                 FROM
                                    Schedule s;";
                        $display = $conn->query($sql);
                        if($rows = $display != NULL){ 
                            while($rows = $display->fetch_assoc()){
                                echo
                                    "Number of Guests checked in:  ".$rows['count(*)'].""; 
                             }
                            }else{
                              echo "No guest checked in";
                            }     
                    ?></div>
                <div class="dash box2" id="mgt-vacancies"> 
                    <?php
                         include 'connection.php';
        
                         $sql = "SELECT 
                                    count(*)
                                 FROM
                                    Schedule s;";
                        $display = $conn->query($sql);
                        if($rows = $display != NULL){ 
                            while($rows = $display->fetch_assoc()){
                                echo
                                    "Number of Guests about to check-out:  ".$rows['count(*)'].""; 
                             }
                            }else{
                              echo "No guest who is about to check-out";
                            }     
                    ?></div>
                <div class="dash box3" id="mgt-coming">                    
                    <?php
                         include 'connection.php';
        
                         $sql = "SELECT 
                                    count(*)
                                 FROM
                                    Schedule s;";
                        $display = $conn->query($sql);
                        if($rows = $display != NULL){ 
                            while($rows = $display->fetch_assoc()){
                                echo
                                    "Number of Vacancies:  ".$rows['count(*)'].""; 
                             }
                            }else{
                              echo "No Vacancies";
                            }     
                    ?></div>
                <div class="dash box4" id="mgt-reservation">
                    <?php
                         include 'connection.php';
        
                         $sql = "SELECT 
                                    count(*)
                                 FROM
                                    Schedule s;";
                        $display = $conn->query($sql);
                        if($rows = $display != NULL){ 
                            while($rows = $display->fetch_assoc()){
                                echo
                                    "Number of Vacancies:  ".$rows['count(*)'].""; 
                             }
                            }else{
                              echo "No reservations";
                            }     
                    ?></div>
                <div class="dash longbox5" id="mgt-earnings">
                    <div class="datetime">
                        <div class="date">
                            <span id="dayname">Day</span>
                            <span id="month">Month</span>
                            <span id="daynum">00</span>
                            <span id="year">Year</span>
                        </div>
                        <div class="time">
                            <span id="hour">Day</span>
                            <span id="minutes">Month</span>
                            <span id="seconds">00</span>
                            <span id="period">Year</span>
                        </div> 
                </div>
            </div>
                
        </div>
    </body>
