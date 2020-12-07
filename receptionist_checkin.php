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

    $sql1 = "SELECT t.room_code as 'room_code'
    FROM room_type t 
    WHERE t.roomtype_id NOT IN(
    SELECT g.roomtype_id FROM guests g where $checkin between g.date_in and g.date_out) AND t.roomtype_id NOT IN(
    SELECT g.roomtype_id FROM guests g where $checkout between g.date_in and g.date_out) AND t.room_cap>=$numguest";

    $result1 = $conn->query($sql1); 

    if(mysqli_num_rows($result1) > 0){
    while($row = $result1->fetch_assoc()){
                
                echo "<form action='' method='POST'>".
                $row['room_code']."<br>
                <input type='submit' name='select' value='select'>
                <input type='hidden' name='room' value='{$row['room_code']}'>
                </form>";}
    }else{
        echo 'No available room.';
    }

    $sql2 = "SELECT t.room_code as 'room_code', c.fname as 'fname', c.lname as 'lname', c.MI as 'MI', g.date_in as 'date_in', g.date_out as 'date_out'
    FROM guests g, customers c, room_type t
    WHERE c.customer_id=g.customer_id AND g.roomtype_id=t.roomtype_id AND g.date_in>=$checkin";

    $result2 = $conn->query($sql2); 

    if(mysqli_num_rows($result2) > 0){
    while($row = $result2->fetch_assoc()){
                
                echo "<form action='' method='POST'><label>First Name: </label>".$row['fname']."\t

                <label>Last Name: </label>".$row['lname']."\t

                <label>Middle Name: </label>".$row['MI']."
                <br><br>

                <label>Check-in: </label>".$row['date_in']."\t

                <label>Check-out: </label>".$row['date_out']."
                <br>
                <label>Room: </label>".$row['room_code']."
                <br>

                <input type='submit' name='select' value='select'>
                </form><br>

                ";}
    }else{
        echo 'No list.';
    }




}

    if(isset($_POST['select'])){  
        $room_code = $_POST['room'];
        
        $_SESSION['room_code'] = $room_code;
        
        header("location:receptionist_checkinform.php");   
}

        ?>
    <form method="post" action="">  
    <label>Number of Guests</label>
    <select name="numguest" class="button" required>
    <option value="Select">Select</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>  
    </select> 
    <br><br>

    <label>Check-in</label><br>
    <input type="date" name="checkin" class="button" required>
    <br><br>

    <label>Check-out</label><br>
    <input type="date" name="checkout" class="button" required>
    <br><br>
    <input type="submit" name="search" value="search" class="submit">
        <br><br>
    </form>

        </div>
    </body>