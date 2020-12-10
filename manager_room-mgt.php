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
                <li><a href="manager_dashboard.php">Dashboard</a></li>
                <li><a href="manager_revenue.php">Revenue</a></li>
                <li><a href="manager_records.php">Records</a></li>
                <li><a href="manager_guests.php">Guests</a></li>
                <li><a href="#">Room Management</a></li>
                <li><a href="manager_staff.php">Staff Management</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code here for manager room management code-->
            <h2>Rooms</h2>
            <table id="Table">
              <tr>
                <th>Room Number</th>
                <th>Room Status</th>
                <th>Room rate per night</th>
                <th>Room Description</th>
                <th>Actions</th>
              </tr>
        <?php
            include 'connection.php';
            
            $sql = "SELECT r.room_id AS 'Room Number',
                        r.room_status AS 'Room Status',
                        t.room_cost AS 'Room Cost', t.room_desc AS 'Room Description'
                    FROM
                        Rooms r, room_type t
                    WHERE
                        r.roomtype_id = t.roomtype_id
                    GROUP BY
                    r.room_id;";

            $display = $conn->query($sql);

        
            if($rows = $display != NULL){ 
            while($rows = $display->fetch_assoc()){
                echo
                    "<tr><td>". $rows['Room Number']. "</td>
                         <td>". $rows['Room Status']. "</td>
                         <td>". $rows['Room Cost']. "</td>
                         <td>". $rows['Room Description']. "</td>";
                    if ($rows['Room Status'] == 'Available') {
                        echo "<td>
                                <button class= 'Extendbutton'>Extend<br>Stay</button>
                                <button class= 'Greenbutton'>Enable<br>Room</button></td>
                             </tr>";
                    }elseif ($rows['Room Status'] == 'Maintenance' ||$rows['Room Status'] == 'Unavailable') {
                        echo "<td>
                                <button class= 'Extendbutton'>Extend<br>Stay</button>
                                <button class= 'Checkoutbutton'>Disable<br>Room</button></td>
                             </tr>";
                    }elseif($rows['Room Status'] == 'Used by guest'){
                        echo "<td>
                                <button class= 'Extendbutton'>Extend<br>Stay</button>
                                <button class= 'Graybutton'>No Actions<br>Room is in use</button></td>
                             </tr>";                     
                    }
                }
                echo "</table>";
            }else{
                  echo "No rooms added";
                }
            $conn->close();        
            ?>

        </div>
    </body>