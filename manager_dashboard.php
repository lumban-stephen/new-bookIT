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
                <li><a href="manager_revenue.php">Revenue</a></li>
                <li><a href="manager_records.php">Records</a></li>
                <li><a href="manager_guests.php">Guests</a></li>
                <li><a href="manager_room-mgt.php">Room Management</a></li>
                <li><a href="manager_staff.php">Staff Management</a></li>
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
        
                        $sql = "SELECT COUNT(*) AS 'Guests'
                                 FROM checked_in_guests;";
                        $display = $conn->query($sql);
                        if($rows = $display != NULL){ 
                            while($rows = $display->fetch_assoc()){
                                echo
                                    "Number of Guests checked in:  ".$rows['Guests'].""; 
                             }
                            }else{
                              echo "No guest checked in";
                            }     
                    ?></div>
                <div class="dash box2" id="mgt-vacancies">
                    <?php
                         include 'connection.php';
        
                         $sql = "SELECT COUNT(*) AS 'Vacancies' 
                                 FROM `rooms`
                                 WHERE room_status='Available';";
                        $display = $conn->query($sql);
                        if($rows = $display != NULL){ 
                            while($rows = $display->fetch_assoc()){
                                echo
                                    "Number of Vacancies:  ".$rows['Vacancies'].""; 
                             }
                            }else{
                              echo "No available rooms";
                            }     
                    ?></div>

                <div class="dash box3" id="mgt-coming">
                    <?php
                         include 'connection.php';
        
                         $sql = "SELECT COUNT(*) AS 'Coming'
                                FROM schedule, guests g
                                WHERE schedule.sched_id= g.guest_id 
                                    AND g.date_in >= NOW() - INTERVAL 1 DAY;";
                        $display = $conn->query($sql);
                        if($rows = $display != NULL){ 
                            while($rows = $display->fetch_assoc()){
                                echo
                                    "Number of Guests coming in:  ".$rows['Coming'].""; 
                             }
                            }else{
                              echo "No Guest is coming in";
                            }     
                    ?></div>
                <div class="dash box4" id="mgt-reservation"><?php
                         include 'connection.php';
        
                         $sql = "SELECT 
                                    count(*)
                                 FROM
                                    Schedule s;";
                        $display = $conn->query($sql);
                        if($rows = $display != NULL){ 
                            while($rows = $display->fetch_assoc()){
                                echo
                                    "Number of Reservations:  ".$rows['count(*)'].""; 
                             }
                            }else{
                              echo "No reservations";
                            }     
                    ?></div>
                <div class="dash longbox5" id="mgt-earnings">Earnings</div>
            </div>
        </div>
    </body>