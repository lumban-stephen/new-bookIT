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
                <p>Welcome Manager  </p>
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
                <li id="logoli"><img src="assets/bookIT_Logo.png"></li>
                <li><a class="navli" href="manager_dashboard.php">Dashboard</a></li>
                <li><a class="navli" href="manager_revenue.php">Revenue</a></li>
                <li><a class="navli" href="manager_records.php">Records</a></li>
                <li><a class="navli" href="manager_guests.php">Guests</a></li>
                <li><a class="navli" href="#">Room Management</a></li>
                <li><a class="navli" href="manager_staff.php">Staff Management</a></li>
                <li><a class="navli" href="manager_restock.php">Restock Amenities</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code here for manager room management code-->
            <h2>Rooms</h2>
            <form action="room_server.php" method="get">
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
                        t.room_cost AS 'Room Cost', 
                        t.room_desc AS 'Room Description'
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
                    if ($rows['Room Status'] == 'Maintenance' || $rows['Room Status'] == 'Unavailable') {
                        echo "  <td>
                                    <form action='' method='POST'>
                                        <input type='submit' class='Greenbutton'  name='enable' value='Enable Room'>
                                        <input type='hidden' name='roomID' value='{$rows['Room Number']}'>
                                    </form>
                                </td>
                             </tr>";
                    }elseif ($rows['Room Status'] == 'Available') {
                        echo "  <td>
                                    <form action='' method='POST'>
                                        <input type='submit' class='Checkoutbutton'  name='disable' value='Disable Room'>
                                        <input type='hidden' name='roomID' value='{$rows['Room Number']}'>
                                    </form>
                                </td>
                             </tr>";
                    }elseif($rows['Room Status'] == 'Used by guest'){
                        echo "<td>
                                    <form action='' method='POST'>
                                        <input type='submit' class='Graybutton'  name='nothing' value='No Actions Room is in use'>
                                        <input type='hidden' name='roomID' value='{$rows['Room Number']}'>
                                    </form>
                                </td>
                             </tr>";                     
                    }
                }
                echo "</table>";
            }else{
                  echo "No rooms added";
            }
            
            if(isset($_POST['enable'])){
                $roomID = $_POST['roomID'];
                $updateStatus = "UPDATE rooms SET room_status = 'Available' WHERE room_id = $roomID";

                if ($conn->query($updateStatus) === TRUE) {
                    echo "<script language='javascript'>
                                window.location.href='manager_room-mgt.php';
                                
                        </script>";
                } else {
                    echo "Error: " .$updateStatus. "<br>" .$conn->error;
                }
            }

            if(isset($_POST['disable'])){
                $roomID = $_POST['roomID'];
                $updateStatus = "UPDATE rooms SET room_status = 'Maintenance' WHERE room_id = $roomID";

                if ($conn->query($updateStatus) === TRUE) {
                    echo "<script language='javascript'>
                                window.location.href='manager_room-mgt.php';
                                
                        </script>";
                } else {
                    echo "Error: " .$updateStatus. "<br>" .$conn->error;
                }
            }

            $conn->close();        
            ?>
            </form>
        </div>
    </body>
