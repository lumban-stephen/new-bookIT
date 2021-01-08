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
.grid-form {
  display: grid;
  grid-template-columns: 20% 20% 20%;
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
            <!--receptionist check in form page code in here-->

            <?php
            include 'connection.php';
            //error_reporting(0);
            ob_start();
            //to extend
            
                
                $sql0 = "SELECT g.room_id as room_id, g.date_in as date_in, g.date_out as date_out, g.payment_id as payment_id, g.guests_count as guests_count,g.customer_id as customer_id,p.payment_amount as 'payment_amount', t.room_desc as room_desc,t.roomtype_id as roomtype_id
                    FROM guests g, payments p,rooms r, room_type t
                    WHERE g.guest_id='{$_SESSION['guest_id']}' AND g.payment_id=p.payment_id AND r.room_id=g.room_id AND t.roomtype_id=r.roomtype_id";

                    $result0 = $conn->query($sql0);
            while($row = $result0->fetch_assoc()){
                $room_id=$row['room_id'];
                $date_in=$row['date_in'];
                $date_out=$row['date_out'];
                $payment_id=$row['payment_id'];
                $guests_count=$row['guests_count'];
                $customer_id=$row['customer_id'];
                $payment_amount=$row['payment_amount'];
                $room_desc=$row['room_desc'];
                $pre_roomtype_id=$row['roomtype_id'];
            }

                echo "<form method='post' action=''>
                <div class='grid-form'>
                <span><label  class='Labelform'>Room</label><p>".$room_id."</p><br>
                <label  class='Labelform'>Room Type</label><p>".$room_desc."</P></span>
                <span><label class='Labelform'>Check-in</label><p>".$date_in."</p></span>
                
                <span><label class='Labelform'>Check-out</label><br><p>".$date_out."</p><input type='date' name='extend' required>
                 </div>
                <button type='submit' name='search_room'  style='background-color: #003399; padding: 5px; ' class='button'>Search Room</button><a href='receptionist_guests.php' style='width:15%;'class='Greenbutton'>Back to Guests</a></form>
                ";

if(isset($_POST['search_room'])){
    $extend=$_POST['extend'];
    $_SESSION['extended_date']=$extend;

    $rooomtype = "SELECT DISTINCT t.room_desc AS room_desc, t.roomtype_id as roomtype_id
            FROM    room_type t, 
                    rooms r
            WHERE   r.roomtype_id=t.roomtype_id AND 
                    r.room_status != 'Maintenance' AND 
                    r.room_status !='Used by guest' AND 
                    r.room_status !='Reserved' AND 
                    r.room_id NOT IN(SELECT g.room_id 
                                    FROM guests g 
                                    WHERE $date_out between g.date_in and g.date_out) AND 
                    r.room_id NOT IN(SELECT g.room_id 
                                    FROM guests g 
                                    WHERE $extend between g.date_in and g.date_out) AND 
                    t.room_cap>=$guests_count";

    $result1 = $conn->query($rooomtype); 

    if(mysqli_num_rows($result1) > 0){
        echo "Available Room Type<br><br>";
        echo "<div class='grid-container'>";
    while($row = $result1->fetch_assoc()){
                
                echo "
                <form  method='post' action=''>
                <button type='submit' name='select' style='background-color: #28C479; padding: 10px; '><h1>".$row['room_desc']."</button>
                <input type='hidden' name='roomtype_id' value='{$row['roomtype_id']}'>
                <input type='hidden' name='extend' value='{$extend}'>
                
                </form>";}
                echo "</div>";
    }else{
        echo 'No available room.';
    }}

//update room
if(isset($_POST['select'])){
    $roomtype_id = $_POST['roomtype_id'];
    $extend = $_POST['extend'];

//if selected different room type, change the room.
    if($pre_roomtype_id!=$roomtype_id){
        $rooomId = "SELECT r.room_id AS room_id
            FROM    rooms r
            WHERE   r.roomtype_id=$roomtype_id AND 
                    r.room_status = 'Available' AND 
                    r.room_id NOT IN(SELECT g.room_id 
                                    FROM guests g 
                                    WHERE $date_out between g.date_in and g.date_out) AND 
                    r.room_id NOT IN(SELECT g.room_id 
                                    FROM guests g 
                                    WHERE $extend between g.date_in and g.date_out)";
        $result2 = $conn->query($rooomId); 
        while($rows = $result2->fetch_assoc()){
        $room_id=$rows['room_id'];}}



    $prepare01= $conn->prepare("UPDATE guests SET date_out=?,room_id=? WHERE guest_id=?");
        $prepare01->bind_param("sii", $extend,$room_id, $_SESSION['guest_id']);
        $prepare01->execute();

    $stays=(strtotime($extend)-strtotime($date_out))/60/60/24; //number of stays

//get room_cost
$sql2 = "SELECT t.room_cost as 'room_cost', g.payment_id as 'payment_id'
    FROM room_type t, rooms r, guests g
    WHERE t.roomtype_id=r.roomtype_id AND r.room_id=$room_id AND g.room_id=r.room_id";
    $result2 = $conn->query($sql2); 

    while($row = $result2->fetch_assoc()){$room_cost=$row['room_cost'];
        $payment_id=$row['payment_id'];}

    $payment = $payment_amount+$stays*$room_cost;

//update payment
$prepare02= $conn->prepare("UPDATE payments SET payment_amount =? 
    WHERE payment_id=?");
        $prepare02->bind_param("ii", $payment, $payment_id);
        $prepare02->execute();

//update schedule
$schedule= $conn->prepare("UPDATE schedule SET room_id=? WHERE guest_id=?");
        $schedule->bind_param("ii", $room_id, $_SESSION['guest_id']);
        $schedule->execute();

    $_SESSION['room_id']=$room_id;
    header("location:receptionist_extend.php");


}

ob_end_flush();
?>


                
        </div>
    </body>
