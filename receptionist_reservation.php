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
<style type="text/css">
.grid-container {
  display: grid;
  grid-template-columns: 20% 20% 20% 20%;
  grid-gap: 10px;
  padding: 10px;
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
                <li><a class="navli" href="receptionist_dashboard.php">Dashboard</a></li>
                <li><a class="navli" href="receptionist_checkin.php">Check In</a></li>
                <li><a class="navli" href="receptionist_checkout.php">Check Out</a></li>
                <li><a class="navli" href="receptionist_reservation.php">Reservation</a></li>
                <li><a class="navli" href="receptionist_records.php">Records</a></li>
                <li><a class="navli" href="receptionist_toDoList.php">To Do List</a></li>
                <li><a class="navli" href="receptionist_guests.php">Guests</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code Here only-->
            <!--Reservation page code in here-->
            <form method="post" action="">  
                <label class='Labelform'>SELECT ROOM TYPE</label><select name="room_type" class="booking" style='height: 10%;' required>
                    <option value="Select">Select</option>
                    <option value="1">Single bed, Aircon, 1-2 people</option>
                    <option value="2">Single bed, Fan only, 1-2 people</option>
                    <option value="3">Two beds, Aircon, 2-4 people</option>
                    <option value="4">Three beds, Aircon, 3-5 people</option>  
                </select> 
                <br><br>

                <label class='Labelform'>Check-in</label><input type="date" name="checkin" class="booking" required>
                <br><br>

                <label class='Labelform'>Check-out</label><input type="date" name="checkout" class="booking" required>
                <br><br>

                <button type="submit" name="search" class="searchbutton">SEARCH</button>

                <button class="Viewbutton"><a href="receptionist_res-list.php">Reservation List</a></button>
                <br><br>
            </form>

    <?php
        include 'connection.php';
        //error_reporting(0);
        if(isset($_POST['search'])){
                    
        $checkin=$_POST['checkin'];
        $checkout=$_POST['checkout'];
        $room_type=$_POST['room_type'];

        $_SESSION['checkin'] = $checkin;
        $_SESSION['checkout'] = $checkout;


//select available room type
/*r.room_id NOT IN : find rooms that are not booked by other guests
COUNT(r.room_id) : count the number of available rooms*/    
$rooomtype = "SELECT DISTINCT COUNT(r.room_id) as 'available', t.room_desc AS room_desc, t.roomtype_id as roomtype_id
            FROM    room_type t, 
                    rooms r
            WHERE   r.roomtype_id=t.roomtype_id AND 
                    r.room_status != 'Maintenance' AND 
                    r.room_id NOT IN(SELECT g.room_id 
                                    FROM guests g 
                                    WHERE $checkin between g.date_in and g.date_out) AND 
                    r.room_id NOT IN(SELECT g.room_id 
                                    FROM guests g 
                                    WHERE $checkout between g.date_in and g.date_out) AND 
                    t.roomtype_id=$room_type";

    $result1 = $conn->query($rooomtype); 

    if(mysqli_num_rows($result1) > 0){
        echo "<div class='grid-container'>";
    while($row = $result1->fetch_assoc()){
                
                echo $row['available']." ROOMS available
                <form  method='post' action=''>
                <button type='submit' name='select' style='background-color: #28C479; padding: 10px; '>
                <h1>".$row['room_desc']."</button>
                <input type='hidden' name='roomtype_id' value='{$row['roomtype_id']}'>
                <input type='hidden' name='room_desc' value='{$row['room_desc']}'>
                </form>";}
                echo "</div>";
                }else{
                    echo 'No available room.';
                }}

//after selecting room type. select room_id. send sessions to booking.php
        if(isset($_POST['select'])){  
        $roomtype_id = $_POST['roomtype_id'];
        $room_desc = $_POST['room_desc'];
        $_SESSION['room_desc']=$room_desc;

//choose room which is not under maintenance
        $rooomId = "SELECT r.room_id AS room_id
            FROM    rooms r
            WHERE   r.roomtype_id=$roomtype_id AND 
                    r.room_status != 'Maintenance'";
        $result2 = $conn->query($rooomId); 
        while($rows = $result2->fetch_assoc()){
        $room_id=$rows['room_id'];
        $_SESSION['room_id']=$room_id;}
        
        header("location:receptionist_booking.php");   
        }

        ?>


    

        </div>
    </body>
