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
                <p>Welcome, </p>
                <a><img></img></a>
            </div>
        </div>
        </header>
        <nav><ul>
                <li><a>Dashboard</a></li>
                <li><a>Check In</a></li>
                <li><a>Check Out</a></li>
                <li><a>Reservation</a></li>
                <li><a>Records</a></li>
                <li><a>To Do List</a></li>
                <li><a>Guests</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code Here only-->
            <!--Reservation page code in here-->
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
<input type="submit" name="submit" value="search" class="submit">
        <br><br>
</form>


    <?php
    include 'connection.php';
    //error_reporting(0);
    if(isset($_POST['submit'])){
    echo "<link rel='stylesheet' href='css.css'>";
    
    $checkin=$_POST['checkin'];
    $checkout=$_POST['checkout'];
    $numguest=$_POST['numguest'];

        $sql = "SELECT DISTINCT t.room_code as 'room_code'
    FROM room_type t 
    WHERE t.roomtype_id NOT IN(
    SELECT g.roomtype_id FROM guests g where $checkin between g.date_in and g.date_out) AND t.roomtype_id NOT IN(
    SELECT g.roomtype_id FROM guests g where $checkout between g.date_in and g.date_out) AND t.room_cap>=$numguest";

    $result = $conn->query($sql); 

    if(mysqli_num_rows($result) > 0){
    while($row = $result->fetch_assoc()){
                
                echo "<form action='receptionist_booking.php' method='POST'>".
                $row['room_code']."<br>
                <input type='submit' name='select' value='select'>
                <input type='hidden' name='room' value='{$row['room_code']}'>
                </form>";}
    }else{
        echo 'No available room.';
    }}

    if(isset($_POST['select'])){  
        $room_code = $_POST['room'];
        
        $_SESSION['room_code'] = $room_code;
        $_SESSION['numguest'] = $numguest;
        //header("location:receptionist_booking.php");   
}

        ?>

        </div>
    </body>