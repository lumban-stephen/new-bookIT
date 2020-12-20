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
        <style>
            .bg-modal {
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    position: absolute;
    top: 0;
    left: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    display: none; 
    margin-bottom: 0;
    overflow-x: hidden;
}
.modal-content {
    width: 400px;
    height: 400px;
    background-color: white;
    border-radius: 4px;
    text-align: center;
    position: relative;
}
.close{
    position: absolute;
    top: 0;
    right: 14px;
    font-size: 42px;
    transform: rotate(45deg);
    cursor: pointer;

}
        </style>
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
                <div class="dash box1" id="Modal">
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
                    ?>
                   <div class="bg-modal">
                        <div class="modal-content">
                            <div class="close">+</div>
                            <div class="header">
                                <h1>Modal</h1>
                                </div>
                                <table id="Table">
                                    <tr>
                                        <th>Guest Name</th>
                                        <th>Room Number</th>
                                    </tr>
                                <?php
                                include 'connection.php';
                
                                $sql = "SELECT ch.checked_in_id AS 'ID',
                                                CONCAT(c.fname, ' ', c.MI, ' ', c.lname) AS 'Guest Name',
                                                r.room_id as 'Room Number', g.guest_id AS 'guest_id'
                                        FROM
                                                Checked_in_guests ch, Guests g, Customers c,
                                                Rooms r
                                        WHERE
                                                ch.guest_id = g.guest_id AND g.customer_id = c.customer_id
                                                AND ch.room_id = r.room_id
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
                </div>
                <div class="dash box2" id="Modal"> 
                    <?php
                         include 'connection.php';
        
                         $sql = "SELECT COUNT(*) AS 'checkout' 
                                 FROM checked_in_guests ch,guests g 
                                 WHERE ch.guest_id=g.guest_id AND g.date_out= CURDATE();";
                        $display = $conn->query($sql);
                        if($rows = $display != NULL){ 
                            while($rows = $display->fetch_assoc()){
                                echo
                                    "Number of Guests about to check-out:  ".$rows['checkout'].""; 
                             }
                            }else{
                              echo "No guest is about to check-out";
                            }     
                    ?></div>
                <div class="dash box3" id="Modal">                    
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
                <div class="dash box4" id="Modal">
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
                                    "Number of Reservations:  ".$rows['count(*)'].""; 
                             }
                            }else{
                              echo "No reservations";
                            }     
                    ?></div>
                <div class="dash longbox5" id="Modal">
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
                            <span id="period">Am</span>
                        </div> 
                </div>
            </div>
                
        </div>
        <script>
            document.getElementById('Modal').addEventListener('click',function() {
                document.querySelector('.bg-modal').style.display = 'flex';
            });

            document.querySelector('.close').addEventListener('click', function(){
            document.querySelector('.bg-modal').style.display = 'none';
        });
        </script>
    </body>
