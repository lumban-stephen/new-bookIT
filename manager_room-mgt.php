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
            <br>
            <h2 style=" display: inline-block;">Rooms</h2>
                <div style="float: right;">
                    <form action='' method='POST'>
                        <input type='submit' class='Greenbutton'  name='Createroom' value='Add Room'>
                    </form>
                </div>
            <?php 
                include 'connection.php';

                if(isset($_POST['Createroom'])){
                    echo "<br><div>
                            <form method='POST' action='' >
                            <label class='Labelform-Rev'>Room Number</label><input type='text' class='input-Rev' name='roomnum' required>
                            <label class='Labelform-Rev'>Room Rate per night</label><input type='number' class='input-Rev' name='roomrate' required><br>
                            <label class='Labelform-Rev'>Room Capacity</label><input type='number' class='input-Rev' name='roomcap' required><br>
                            <label class='Labelform-Rev'>Room Description</label><input type='text' class='input-Rev' list='desc' name='roomdesc' required />
                                <datalist id='desc'>
                                    <option value='Single bed, Aircon, 1-2 people'>Single bed, Aircon, 1-2 people</option>
                                    <option value='Single bed, Fan only, 1-2 people'>Single bed, Fan only, 1-2 people</option>
                                    <option value='Two beds, Aircon, 2-4 people'>Two beds, Aircon, 2-4 people</option>
                                    <option value='Three beds, Aircon, 3-5 people'>Three beds, Aircon, 3-5 people</option>
                                </datalist>
                                <label class='Labelform-Rev'>Room Status</label><select name='roomstatus' class='input-Rev' id='status' required>
                                <option value='Available'>Available</option>
                                <option value='Maintenance'>Maintenance</option>
                            </select>
                            <button type='submit' class='Greenbutton' name='save' >SAVE</button>
                            
                            </form> 
                        </div>";
                }

                if(isset($_POST['save'])){
                    $roomnum = $_POST['roomnum'];
                    $roomrate = $_POST['roomrate'];
                    
                    $roomcap = $_POST['roomcap'];
                    $roomdesc = $_POST['roomdesc'];
                    $roomstatus = $_POST['roomstatus'];

                    $sqlinsert1 = "INSERT INTO room_type(room_cost, room_desc, room_cap) 
                            VALUES('$roomrate','$roomdesc', '$roomcap')";
                    $conn->query($sqlinsert1) or die($conn->error);
                    
                    $sqlinsert2 = "INSERT INTO rooms(room_id, room_status,roomtype_id) 
                            VALUES('$roomnum','$roomstatus',LAST_INSERT_ID())";           
                    $conn->query($sqlinsert2) or die($conn->error);
            
                    header('location: manager_room-mgt.php');
                }
            ?>
            
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
                                        <input type='submit' class='Checkoutbutton'  name='delete' value='Delete Room'>
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
            
            if(isset($_GET['delete'])){
                $roomID = $_POST['roomID'];
                
                $deleteQuery = "DELETE FROM rooms WHERE room_id=$roomID";
        
                $conn->query($deleteQuery) or die($conn->error);
                
                if ($conn->query($deleteQuery) === TRUE) {
                    echo "<script language='javascript'>
                                window.location.href='manager_room-mgt.php';
                                
                        </script>";
                } else {
                    echo "Error: " .$deleteQuery. "<br>" .$conn->error;
                }
            }     
            $conn->close();        
            ?>
            </form>
        </div>
    </body>
