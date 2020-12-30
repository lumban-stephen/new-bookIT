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
        grid-template-columns: 1fr 1fr 1fr 1fr;
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
    WHERE r.roomtype_id=t.roomtype_id AND r.room_status != 'Maintenance' AND r.room_status !='Used by guest' AND r.room_id NOT IN(
    SELECT g.room_id FROM guests g where $checkin between g.date_in and g.date_out) AND r.room_id NOT IN(
    SELECT g.room_id FROM guests g where $checkout between g.date_in and g.date_out) AND t.room_cap>=$numguest
    GROUP BY r.room_id";

    $result1 = $conn->query($sql1); 

    if(mysqli_num_rows($result1) > 0){
        echo "Available Rooms<br><br>";
        echo "<div class='grid-container'>";
    while($row = $result1->fetch_assoc()){
                
                echo "
                <form  method='post' action=''><button type='submit' name='select' style='background-color: #28C479; padding: 10px; '><h1>ROOM  ".$row['room_id']."</h1>".$row['room_desc']."</button>
                <input type='hidden' name='room_id' value='{$row['room_id']}'>
                <input type='hidden' name='room_desc' value='{$row['room_desc']}'>
                
                </form>";}
                echo "</div>";
    }else{
        echo 'No available room.';
    }
    echo "<br><br>
              <hr>
              <br><br>";
    }

     if(isset($_POST['select'])){  
        $room_id = $_POST['room_id'];
        $_SESSION['room_id'] = $room_id;
        $_SESSION['from_checkin']=1; //examine in checkin_form if it is from checkin.
        header("location:receptionist_checkinform.php");   
}
        
        ?>

    


    <form method="post" action="">  
    <label class='Labelform'>Number of Guests</label><select name="numguest" class='bookingnum' style = 'height:10%;' required>
    <option value="Select" >Select</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>  
    </select> 
    <br>

    <label class='Labelform'>Check-in</label><input type="date" name="checkin" class='booking' required>
    <br>

    <label class='Labelform'>Check-out</label><input type="date" name="checkout" class='booking' required>
    <br><br>
    <button type="submit" name="search" class="searchbutton">SEARCH</button>
        
    </form>

        </div>
    </body>
