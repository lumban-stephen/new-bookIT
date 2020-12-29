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
    <body onload="initClock()">
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
                <p>Welcome Receptionist  </p>
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
                <li id="logoli"><a href="receptionist_dashboard.php"><img src="assets/bookIT_Logo.png"></li>
                <li><a class="navli" href="#">Dashboard</a></li>
                <li><a class="navli" href="receptionist_checkin.php">Check In</a></li>
                <li><a class="navli" href="receptionist_checkout.php">Check Out</a></li>
                <li><a class="navli" href="receptionist_reservation.php">Reservation</a></li>
                <li><a class="navli" href="receptionist_records.php">Records</a></li>
                <li><a class="navli" href="receptionist_toDoList.php">To Do List</a></li>
                <li><a class="navli" href="receptionist_guests.php">Guests</a></li>
            </ul>
        </nav>
        <div id="content">
        <br>
        <h2>Dashboard</h2>
        <br><br>
        <div class="dashwrapper">
            <div class="dash box1" id="Modal1">
                     <?php
                        include 'connection.php';
        
                        $sql = "SELECT COUNT(*) AS 'Guests'
                                 FROM guests WHERE guest_status = 'INCOMPLETE' AND g.date<= CURRENT_DATE;";
                        $display = $conn->query($sql);
                        if($rows = $display != NULL){ 
                            while($rows = $display->fetch_assoc()){
                                echo
                                    "<div class='box1header'><h3>Number of Guests checked in:</h3></div>  
                                    <div class='dashcontent'><h1>".$rows['Guests']."</h1></div>"; 
                             }
                            }else{
                              echo "No guest checked in";
                            }     

                    ?>
            </div>
            <div class="bg-modal1">
            <div class="modal-content1">
            <div class="close1">+</div>
            <div class="header_modal1">
                        <h1>Guests checked in</h1>
                        </div><br>
                        <div class="Pad">
                        <table id="Table">
                        <tr>
                            <th>Guest Name</th>
                            <th>Room Number</th>
                        </tr>
                        <?php
                                include 'connection.php';
                
                                $sql = "SELECT g.guest_id AS 'ID',
                                                CONCAT(c.fname, ' ', c.MI, ' ', c.lname) AS 'Guest Name',
                                                r.room_id as 'Room Number'
                                        FROM
                                                Guests g, Customers c,
                                                Rooms r
                                        WHERE
                                                g.customer_id = c.customer_id
                                                AND g.room_id = r.room_id AND g.guest_status = 'INCOMPLETE' AND g.date<= CURRENT_DATE
                                        ORDER BY
                                                g.date_in;";
                                        $display = $conn->query($sql);
                                        if($rows = $display != NULL){ 
                                            while($rows = $display->fetch_assoc()){
                                                echo
                                                   "<tr><td>" .$rows['Guest Name']."</td>
                                                   <td>" .$rows['Room Number']."</td></tr>";
                                             }
                                            }else{
                                              echo "No guest checked in";
                                            } 
                                            echo "</table></div>" ;  
                                ?>
                        </div>
                        </div>

                <div class="dash box2" id="Modal2"> 
                    <?php
                         include 'connection.php';
        
                         $sql = "SELECT COUNT(*) AS 'checkout' 
                                 FROM guests g 
                                 WHERE g.guest_status = 'INCOMPLETE' AND g.date_out= CURDATE();";
                        $display = $conn->query($sql);
                        if($rows = $display != NULL){ 
                            while($rows = $display->fetch_assoc()){
                                echo
                                    "<div class='box2header'><h3>Number of Guests about to check-out: </h3></div> 
                                    <div class='dashcontent'><h1>".$rows['checkout']."</h1></div>"; 
                             }
                            }else{
                              echo "No guest is about to check-out";
                            }     
                    ?>
                    </div>
                    <div class="bg-modal2">
                    <div class="modal-content2">
                    <div class="close2">+</div>
                    <div class="header_modal2">
                                <h1>About to checkout</h1>
                                </div><br>
                                <div class="Pad">
                                <table id="Table">
                                <tr>
                                    <th>Guest Names</th>
                                    <th>Room Number</th>
                                </tr>
                                <?php
                                        include 'connection.php';
                        
                                        $sql = "SELECT CONCAT(c.fname, ' ', c.MI, ' ', c.lname) AS 'Guest Name',
                                                     r.room_id as 'Room Number'
                                                FROM
                                                        Guests g, Customers c,
                                                        Rooms r
                                                WHERE
                                                        g.customer_id = c.customer_id
                                                        AND g.room_id = r.room_id AND g.date_out= CURDATE() AND g.guest_status = 'INCOMPLETE'
                                                ORDER BY
                                                        g.date_in;";
                                                $display = $conn->query($sql);
                                                if($rows = $display != NULL){ 
                                                    while($rows = $display->fetch_assoc()){
                                                        echo
                                                        "<tr><td>" .$rows['Guest Name']."</td>
                                                        <td>" .$rows['Room Number']."</td></tr>";
                                                    }
                                                    }else{
                                                    echo "No guest is going to checkout";
                                                    } 
                                                    echo "</table></div>" ;  
                                        ?>
                        </div>
                        </div>
                <div class="dash box3" id="Modal3">                    
                    <?php
                         include 'connection.php';
        
                         $sql = "SELECT COUNT(*) AS 'Vacancies' 
                                 FROM `rooms`
                                 WHERE room_status='Available';";
                        $display = $conn->query($sql);
                        if($rows = $display != NULL){ 
                            while($rows = $display->fetch_assoc()){
                                echo
                                    "<div class='box3header'><h3>Number of Vacancies:</h3></div>  
                                    <div class='dashcontent'><h1>".$rows['Vacancies']."</h1></div>"; 
                             }
                            }else{
                              echo "No available rooms";
                            }     
                    ?></div>
                    <div class="bg-modal3">
                    <div class="modal-content3">
                    <div class="close3">+</div>
                    <div class="header_modal3">
                                <h1>Vacant Rooms</h1>
                                </div><br>
                                <div class="Pad">
                                <table id="Table">
                                <tr>
                                    <th>Room ID</th>
                                    <th>Room Description</th>
                                </tr>
                                <?php
                                        include 'connection.php';
                        
                                        $sql = "SELECT r.room_id AS 'Room ID', rt.room_desc AS 'Room Description'
                                        FROM rooms r, room_type rt
                                        WHERE r.roomtype_id=rt.roomtype_id AND room_status='Available';";
                                                $display = $conn->query($sql);
                                                if($rows = $display != NULL){ 
                                                    while($rows = $display->fetch_assoc()){
                                                        echo
                                                        "<tr><td>" .$rows['Room ID']."</td>
                                                        <td>" .$rows['Room Description']."</td></tr>";
                                                    }
                                                    }else{
                                                    echo "No Vacant rooms";
                                                    } 
                                                    echo "</table></div>" ;  
                                        ?>
                        </div>
                        </div>
                <div class="dash box4" id="Modal4">
                    <?php
                         include 'connection.php';
        
                         $sql = "SELECT COUNT(*) as 'count'
                                    FROM schedule s, guests g
                                    WHERE s.guest_id=g.guest_id AND g.guest_status = 'INCOMPLETE' AND g.date_in >= CURRENT_DATE";

                        $display = $conn->query($sql);
                        if($rows = $display != NULL){ 
                            while($rows = $display->fetch_assoc()){
                                echo
                                    "<div class='box4header'><h3>Number of Reservations:</h3></div>
                                    <div class='dashcontent'><h1> ".$rows['count']."</h1></div>"; 
                             }
                            }else{
                              echo "No reservations";
                            }     
                    ?></div>
                    <div class="bg-modal4">
                    <div class="modal-content4">
                    <div class="close4">+</div>
                    <div class="header_modal4">
                                <h1>Reservations</h1>
                                </div><br>
                                <div class="Pad">
                                <table id="Table">
                                <tr>
                                    <th>Guest name</th>
                                    <th>Check-in date</th>
                                </tr>
                                <?php
                                        include 'connection.php';
                        
                                        $sql = "SELECT CONCAT(c.fname,' ',c.MI,' ',c.lname) as 'Guest Name', g.date_in as date_in
                                        FROM guests g, customers c, schedule s
                                        WHERE g.customer_id = c.customer_id AND s.guest_id=g.guest_id AND guest_status = 'INCOMPLETE' AND g.date_in >= CURRENT_DATE
                                        ORDER BY g.date_in";
                                                $display = $conn->query($sql);
                                                if($rows = $display != NULL){ 
                                                    while($rows = $display->fetch_assoc()){
                                                        echo
                                                        "<tr><td>" .$rows['Guest Name']."</td>
                                                        <td>" .$rows['date_in']."</td></tr>";
                                                    }
                                                    }else{
                                                    echo "No Reservations";
                                                    } 
                                                    echo "</table></div>" ;  
                                        ?>
                        </div>
                        </div>
                <div class="dash longbox5" id="Modal5">
                    <div class="datetime">
                        <div class="date">
                            <span id="dayname">Day</span>,
                            <span id="month">Month</span>
                            <span id="daynum">00</span>,
                            <span id="year">Year</span>
                        </div>
                        <div class="time">
                            <span id="hour">00</span>:
                            <span id="minutes">00</span>:
                            <span id="seconds">00</span>
                            <span id="period">AM</span>
                        </div>
                        </div>
            </div>
        </div>
        </div>
        <script src="dashmodal.js"></script>
    </body>
