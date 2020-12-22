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
                <li><a href="receptionist_dashboard.php">Dashboard</a></li>
                <li><a href="receptionist_checkin.php">Check In</a></li>
                <li><a href="receptionist_checkout.php">Check Out</a></li>
                <li><a href="receptionist_reservation.php">Reservation</a></li>
                <li><a href="receptionist_records.php">Records</a></li>
                <li><a href="receptionist_toDoList.php">To Do List</a></li>
                <li><a href="receptionist_guests.php">Guests</a></li>
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

        <button type="submit" name="submit" class="Offerbutton">SEARCH</button>

        <a href="receptionist_res-list.php" class="Viewbutton" style="color: white;">Liservation List</a>
        <br><br>
</form>


    <?php
    include 'connection.php';
    //error_reporting(0);
    if(isset($_POST['submit'])){
        
    $checkin=$_POST['checkin'];
    $checkout=$_POST['checkout'];
    $numguest=$_POST['numguest'];

    $_SESSION['checkin'] = $checkin;
    $_SESSION['checkout'] = $checkout;
    $_SESSION['numguest'] = $numguest;

    $sql = "SELECT r.room_id as 'room_id',t.room_desc AS room_desc
    FROM room_type t, rooms r
    WHERE r.room_id NOT IN(
    SELECT g.room_id FROM guests g where $checkin between g.date_in and g.date_out) AND r.room_id NOT IN(
    SELECT g.room_id FROM guests g where $checkout between g.date_in and g.date_out) AND t.room_cap>=$numguest AND t.roomtype_id=r.roomtype_id AND r.room_status != 'Maintenance'";

    $result = $conn->query($sql); 

    if(mysqli_num_rows($result) > 0){
        echo "<div class='grid-container'>";
    while($row = $result->fetch_assoc()){
                
                echo "<form  method='post' action=''><button type='submit' name='select' style='background-color: #28C479; padding: 10px; '><h1>ROOM ".
                $row['room_id']."</h1>".$row['room_desc']."</button>
                <input type='hidden' name='room_id' value='{$row['room_id']}'>
                </form>";}
            echo "</div>";
    }else{
        echo 'No available room.';
    }}

    if(isset($_POST['select'])){  
        $room_id = $_POST['room_id'];
        
        $_SESSION['room_id'] = $room_id;
        $_SESSION['from_checkin']=1;
        header("location:receptionist_checkinform.php");   
    }

        ?>

        </div>
    </body>
