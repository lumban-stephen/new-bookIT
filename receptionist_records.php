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
        <nav>
            <ul>
                <li><a href="receptionist_dashboard.php">Dashboard</a></li>
                <li><a href="receptionist_checkin.php">Check In</a></li>
                <li><a href="receptionist_checkout.php">Check Out</a></li>
                <li><a href="receptionist_reservation.php">Reservation</a></li>
                <li><a href="#">Records</a></li>
                <li><a href="receptionist_toDoList.php">To Do List</a></li>
                <li><a href="receptionist_guests.php">Guests</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code Here only-->
            <h2>Records</h2>
            <br>
            <table id="Table">
              <tr>
                <th>Record Type</th>
                <th>Room Number</th>
                <th>Record Description</th>
                <th>Date</th>
                <th>Time</th>
              </tr>


        <?php
            include 'connection.php';
            //error_reporting(0);?

        $sql = "SELECT t.room_code as room_code, rec.record_type as record_type, rec.record_desc as record_desc, rec.record_date as record_date, rec.record_time as record_time
            FROM records rec,rooms r,room_type t
            WHERE rec.room_id=r.room_id AND r.roomtype_id=t.roomtype_id ORDER BY rec.record_date";
            
        $result = $conn->query($sql);

    
        if($row = $result != NULL){ 
            while($row = $result->fetch_assoc()){
                echo "<tr>
                        <td>".$row['record_type']."</td>
                        <td>".$row['room_code']."</td>
                        <td>".$row['record_desc']."</td>
                        <td>".$row['record_date']."</td>
                        <td>".$row['record_time']."</td>
                      </tr>"; 
                }
                echo "</table>";
        }else{
            echo "No records made. ";
            }
        ?>
                </div>
            </body>
