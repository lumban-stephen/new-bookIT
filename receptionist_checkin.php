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
        <link rel="stylesheet" href="ameneties.css">
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
                <li><a href="receptionist_dashboard.php">Dashboard</a></li>
                <li><a href="#">Check In</a></li>
                <li><a href="receptionist_checkout.php">Check Out</a></li>
                <li><a href="receptionist_reservation.php">Reservation</a></li>
                <li><a href="receptionist_records.php">Records</a></li>
                <li><a href="receptionist_toDoList.php">To Do List</a></li>
                <li><a href="receptionist_guests.php">Guests</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code Here only-->
            <!--Check in page code in here-->

    <?php
    include 'connection.php';
    //error_reporting(0);
    if(isset($_POST['search'])){
        
    $checkin=$_POST['checkin'];
    $checkout=$_POST['checkout'];
    $numguest=$_POST['numguest'];

    $_SESSION['checkin'] = $checkin;
    $_SESSION['checkout'] = $checkout;
    $_SESSION['numguest'] = $numguest;

    $sql1 = "SELECT r.room_id as 'room_id',t.room_desc AS room_desc
    FROM room_type t, rooms r
    WHERE r.room_id NOT IN(
    SELECT g.room_id FROM guests g where $checkin between g.date_in and g.date_out) AND r.room_id NOT IN(
    SELECT g.room_id FROM guests g where $checkout between g.date_in and g.date_out) AND t.room_cap>=$numguest AND t.roomtype_id=r.roomtype_id AND r.room_status != 'Maintenance'";

    $result1 = $conn->query($sql1); 

    if(mysqli_num_rows($result1) > 0){
    while($row = $result1->fetch_assoc()){
                
                echo "
                <div class='amty-box' style='background-color:#CCFFCC; '><form action='' method='POST'>
                <button type='submit' name='select'>".$row['room_id']."<br>".$row['room_desc']."</button>
                <input type='hidden' name='room_id' value='{$row['room_id']}'>
                <input type='hidden' name='room_desc' value='{$row['room_desc']}'>
                
                </form></div>";}
    }else{
        echo 'No available room.';
    }
    }

     if(isset($_POST['select'])){  
        $room_id = $_POST['room_id'];
        $_SESSION['room_id'] = $room_id;
        header("location:receptionist_checkinform.php");   
}

        ?>

    <br><br>
    <hr>
    <br><br>


    <form method="post" action="">  
    <label>Number of Guests</label>
    <select name="numguest" required>
    <option value="Select">Select</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>  
    </select> 
    <br><br>

    <label>Check-in</label><br>
    <input type="date" name="checkin" required>
    <br><br>

    <label>Check-out</label><br>
    <input type="date" name="checkout" required>
    <br><br>
    <input type="submit" name="search" value="search" class="submit">
        <br><br>
    </form>

        </div>
    </body>
