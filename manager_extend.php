<?php
   session_start();
   error_reporting(0);
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
                <li><a class="navli" href="manager_room-mgt.php">Room Management</a></li>
                <li><a class="navli" href="manager_staff.php">Staff Management</a></li>
                <li><a class="navli" href="manager_restock.php">Restock Amenities</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code Here only-->
            <!--receptionist check in form page code in here-->

             <?php
            include 'connection.php';
            error_reporting(0);
            ob_start();
            
            
            //get info about the guest    
                $sql0 = "SELECT g.room_id as room_id, g.date_in as date_in, g.date_out as date_out, g.payment_id as payment_id, g.guests_count as guests_count,g.customer_id as customer_id,p.payment_amount as 'payment_amount'
                    FROM guests g, payments p
                    WHERE g.guest_id='{$_SESSION['guest_id']}' AND g.payment_id=p.payment_id";

                    $result0 = $conn->query($sql0);
            while($row = $result0->fetch_assoc()){
                $room_id=$row['room_id'];
                $date_in=$row['date_in'];
                $date_out=$row['date_out'];
                $payment_id=$row['payment_id'];
                $guests_count=$row['guests_count'];
                $customer_id=$row['customer_id'];
                $payment_amount=$row['payment_amount'];
            }

//show info about the guest. and input new checkout date
                echo "<form method='post' action=''>
                <div class='grid-form'>
                <span><label class='Labelform'>Room</label><br><div  class='booking' style='width:100%'>".$room_id."</div></span>
                <span><label class='Labelform'>Check-in</label><br><div class='booking'  style='width:100%'>".$date_in."</div></span>
                
                <span><label class='Labelform'>Check-out</label><br><div class='booking'  style='width:100%'>".$date_out."</div><br><br>
                <input type='date' name='extend'  class='booking' required> 
                 </div>
                <button type='submit' name='search_room'  style='background-color: #003399; padding: 5px; ' class='button'>Search Room</button><a href='manager_guests.php' class='Greenbutton' style='width:15%;'>Back to Guests</a></form>
                ";

//find available rooms
if(isset($_POST['search_room'])){
    $extend=$_POST['extend'];
    $_SESSION['extended_date']=$extend;

$sql1 = "SELECT r.room_id as 'room_id',t.room_desc AS room_desc
    FROM room_type t, rooms r
    WHERE r.room_id NOT IN(
    SELECT g.room_id FROM guests g where $date_out between g.date_in and g.date_out) AND r.room_id NOT IN(
    SELECT g.room_id FROM guests g where $extend between g.date_in and g.date_out) AND t.room_cap>=$guests_count AND t.roomtype_id=r.roomtype_id AND r.room_status != 'Maintenance'";

    $result1 = $conn->query($sql1); 

//show available rooms
    if(mysqli_num_rows($result1) > 0){
        echo "<div class='grid-container'>";
    while($row = $result1->fetch_assoc()){
                
                echo "
                <form action='' method='POST'>
                <button type='submit' name='select1' style='background-color: #28C479; padding: 10px; ' class='button'><h1>ROOM  ".$row['room_id']."</h1>".$row['room_desc']."</button>
                <input type='hidden' name='room_id' value='{$row['room_id']}'>
                <input type='hidden' name='room_desc' value='{$row['room_desc']}'>
                <input type='hidden' name='date_out' value='{$date_out}'>
                <input type='hidden' name='payment_amount' value='{$payment_amount}'>
                <input type='hidden' name='extend' value='{$extend}'>                
                </form>";}
                echo "</div>";

                unset($_SESSION['extended_date']);
    //header("location:receptionist_update.php");
}}

//update room
if(isset($_POST['select1'])){
    $room_id=$_POST['room_id'];
    $date_out=$_POST['date_out'];
    $payment_amount=$_POST['payment_amount'];
    $extend=$_POST['extend'];
    $prepare01= $conn->prepare("UPDATE guests SET date_out=?,room_id=? WHERE guest_id=?");
        $prepare01->bind_param("sii", $extend,$room_id, $_SESSION['guest_id']);
        $prepare01->execute();

    $stays=(strtotime($extend)-strtotime($date_out))/60/60/24; //number of stays

//get new room_cost
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

//update room_id in schedule
$schedule= $conn->prepare("UPDATE schedule SET room_id=? WHERE guest_id=?");
        $schedule->bind_param("ii", $room_id, $_SESSION['guest_id']);
        $schedule->execute();

    $_SESSION['room_id']=$room_id;
    header("location:manager_extend.php");


}
ob_end_flush();
?>

                
        </div>
    </body>