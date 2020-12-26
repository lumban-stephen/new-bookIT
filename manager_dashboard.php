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
                <p>Welcome Manager,</p>
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
            <li id="logoli"><img src="assets/bookIT_Logo.png"></li>
                <li><a href="#">Dashboard</a></li>
                <li><a href="manager_revenue.php">Revenue</a></li>
                <li><a href="manager_records.php">Records</a></li>
                <li><a href="manager_guests.php">Guests</a></li>
                <li><a href="manager_room-mgt.php">Room Management</a></li>
                <li><a href="manager_staff.php">Staff Management</a></li>
                <li><a href="manager_restock.php">Restock Amenities</a></li>
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
                                 FROM guests WHERE guest_status = 'INCOMPLETE';";
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
                                                AND g.room_id = r.room_id AND g.guest_status = 'INCOMPLETE'
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
                                            echo "</table>" ;  
                                ?>
                        </div>
                        </div>
                <div class="dash box2" id="Modal2"><?php
                         include 'connection.php';
        
                         $sql = "SELECT COUNT(*) AS 'Vacancies' 
                                 FROM `rooms`
                                 WHERE room_status='Available';";
                        $display = $conn->query($sql);
                        if($rows = $display != NULL){ 
                            while($rows = $display->fetch_assoc()){
                                echo
                                    "<div class='box2header'><h3>Number of Vacancies: </h3></div>
                                    <div class='dashcontent'><h1> ".$rows['Vacancies']."</h1></div>"; 
                             }
                            }else{
                              echo "No available rooms";
                            }     
                    ?></div>
                    <div class="bg-modal2">
                    <div class="modal-content2">
                    <div class="close2">+</div>
                    <div class="header_modal2">
                                <h1>Vacant Rooms</h1>
                                </div><br>
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
                                                    echo "</table>" ;  
                                        ?>
                        </div>
                        </div>
                <div class="dash box3" id="Modal3">
                <?php
                         include 'connection.php';
        
                         $sql = "SELECT COUNT(*) AS 'Checkin' 
                         FROM guests g 
                         WHERE g.date_in= CURDATE() AND g.guest_status = 'INCOMPLETE';";
                        $display = $conn->query($sql);
                        if($rows = $display != NULL){ 
                            while($rows = $display->fetch_assoc()){
                                echo
                                    "<div class='box3header'><h3>Number of Guests about to check-in: </h3></div>
                                    <div class='dashcontent'><h1> ".$rows['Checkin']."</h1></div>"; 
                             }
                            }else{
                              echo "No guest is about to check-in";
                            }     
                    ?>
                    </div>
                    <div class="bg-modal3">
                    <div class="modal-content3">
                    <div class="close3">+</div>
                    <div class="header_modal3">
                                <h1>About to checkin</h1>
                                </div><br>
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
                                                        AND g.room_id = r.room_id AND g.date_in= CURDATE() AND g.guest_status = 'INCOMPLETE'
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
                                                    echo "</table>" ;  
                                        ?>
                        </div>
                        </div>
                <div class="dash box4" id="Modal4">
                <?php
                         include 'connection.php';
        
                         $sql = "SELECT 
                                    count(*)
                                 FROM
                                    guests
                                WHERE date_in > CURDATE();";
                        $display = $conn->query($sql);
                        if($rows = $display != NULL){ 
                            while($rows = $display->fetch_assoc()){
                                echo
                                    "<div class='box4header'><h3>Number of Reservations:</h3></div> 
                                    <div class='dashcontent'><h1> ".$rows['count(*)']."</h1></div>"; 
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
                                <table id="Table">
                                <tr>
                                    <th>Guest name</th>
                                    <th>Check-in date</th>
                                </tr>
                                <?php
                                        include 'connection.php';
                        
                                        $sql = "SELECT CONCAT(c.fname, ' ', c.MI, ' ', c.lname) AS 'Guest Name',
                                                        g.date_in AS 'Guest in'
                                                FROM
                                                        Guests g, Customers c
                                                WHERE
                                                        g.customer_id = c.customer_id AND date_in > CURDATE();";
                                                $display = $conn->query($sql);
                                                if($rows = $display != NULL){ 
                                                    while($rows = $display->fetch_assoc()){
                                                        echo
                                                        "<tr><td>" .$rows['Guest Name']."</td>
                                                        <td>" .$rows['Guest in']."</td></tr>";
                                                    }
                                                    }else{
                                                    echo "No Reservations";
                                                    } 
                                                    echo "</table>" ;  
                                        ?>
                        </div>
                        </div>
                <div class="dash longbox5" id="Modal5">
                    <?php
                $sql = "SELECT SUM(record_paid) as monthly
                            FROM    records
                            WHERE   MONTH(record_date)= MONTH(CURRENT_DATE()) AND
                                    record_type = 'CHECKED OUT'";
                            $result1 = $conn->query($sql);
                            while($row1 = $result1->fetch_assoc()){
                                echo
                                    "<div class='box5header'>Earnings of this month :</h3></div>
                                    <div class='dashcontent'><h1> ".$row1['monthly']."</h1></div>"; 
                             }
                            ?></div>
                            
            </div>
        </div>
        <script src="dashmodal.js"></script>
    </body>