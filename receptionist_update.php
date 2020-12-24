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
                <li id="logoli"><img src="assets/bookIT_Logo.png"></li>
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
            <!--receptionist check in form page code in here-->

             <?php
            include 'connection.php';
            error_reporting(0);
            ob_start();
            //to extend
            if(isset($_SESSION['extend'])){
                unset($_SESSION['extend']);
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

                echo "<form method='post' action=''>
                <div class='grid-form'>
                <span><label>Current Room</label><br>".$room_id."</span>
                <span><label>Check-in</label><br>".$date_in."</span>
                
                <span><label>Check-out</label><br>".$date_out."<input type='date' name='extend'>
                <span><label>Selected Date</label><br>".$_SESSION['extended_date']."</span>
                </div>
                <button type='submit' name='search_room'  style='background-color: #003399; padding: 5px; ' class='button'>Search Room</button><a href='receptionist_res-list.php'>Back to Guests</a></form>
                ";

if(isset($_POST['search_room'])){
    $extend=$_POST['extend'];
    $_SESSION['extended_date']=$extend;

$sql1 = "SELECT r.room_id as 'room_id',t.room_desc AS room_desc
    FROM room_type t, rooms r
    WHERE r.room_id NOT IN(
    SELECT g.room_id FROM guests g where $date_out between g.date_in and g.date_out) AND r.room_id NOT IN(
    SELECT g.room_id FROM guests g where $extend between g.date_in and g.date_out) AND t.room_cap>=$guests_count AND t.roomtype_id=r.roomtype_id AND r.room_status != 'Maintenance'";

    $result1 = $conn->query($sql1); 

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

    $_SESSION['room_id']=$room_id;
    header("location:receptionist_update.php");


}

//edit info
            }else{
            echo "<form method='post' action='' enctype='multipart/form-data'>  
                <label>First Name</label><br>".$_SESSION['fname']."
                <input type='text' name='fname' class='button'>
                <br><br>

                <label>Last Name</label><br>".$_SESSION['lname']."<input type='text' name='lname' class='button'>
                <br><br>
                <label>Middle Name</label><br>".$_SESSION['mname']."<input type='text' name='mname'>
                <button type='submit' name='upname'  style='background-color: #81B1D5; padding: 5px; ' class='button'>Update</button>
                <br><br>

    <div class='grid-form'>
                <span><label>Check-in</label><br>".$_SESSION['checkin']."<input type='date' name='checkin'></span>
                
                <span><label>Check-out</label><br>".$_SESSION['checkout']."<input type='date' name='checkout'></span>
                
                <span><label>Number of Guests</label><br>".$_SESSION['numguest']."<br><select name='numguest'>
    <option value='Select'>Select</option>
    <option value='1'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>  
    </select></span> </div>
    <button type='submit' name='search_room'  style='background-color: #003399; padding: 5px; ' class='button'>Search Room</button>";

if(isset($_POST['search_room'])){
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
        echo "<div class='grid-container'>";
    while($row = $result1->fetch_assoc()){
                
                echo "
                <form action='' method='POST'>
                <button type='submit' name='select' style='background-color: #28C479; padding: 10px; ' class='button'><h1>ROOM  ".$row['room_id']."</h1>".$row['room_desc']."</button>
                <input type='hidden' name='room_id' value='{$row['room_id']}'>
                <input type='hidden' name='room_desc' value='{$row['room_desc']}'>
                
                </form>";}
                echo "</div>";

}}
            echo "<br><br>
                <label>Room Selected</label><br>".$_SESSION['room_id']."
                <br><br>
                <label>Phone Number</label><br>".$_SESSION['phone']."<input type='number' name='phone' class='button'>
                <button type='submit' name='upphone'  style='background-color: #81B1D5; padding: 5px; ' class='button'>Update</button>
                <br><br>
                <label>E-mail</label><br>".$_SESSION['email']."<input type='email' name='email' class='button'>
                <button type='submit' name='upemail'  style='background-color: #81B1D5; padding: 5px; ' class='button'>Update</button>
                <br><br>
                
                <a href='receptionist_res-list.php' class='Greenbutton' style='color: white;'>Back to Liservation List</a>
                <br><br>
            </form>";

//update name
if(isset($_POST['upname'])){
    if(isset($_POST['fname'])){
    $fname=$_POST['fname'];
    $prepare= $conn->prepare("UPDATE customers SET fname =? WHERE customer_id=?");
        $prepare->bind_param("si", $fname, $_SESSION['customer_id']);
        $prepare->execute();
    $_SESSION['fname']=$fname;
}

if(isset($_POST['lname'])){
    $lname=$_POST['lname'];
    $prepare= $conn->prepare("UPDATE customers SET lname =? WHERE customer_id=?");
        $prepare->bind_param("si", $lname, $_SESSION['customer_id']);
        $prepare->execute();
    $_SESSION['lname']=$lname;
    header("location:receptionist_update.php");
}

if(isset($_POST['mname'])){
    $mname=$_POST['mname'];
    $prepare= $conn->prepare("UPDATE customers SET MI =? WHERE customer_id=?");
        $prepare->bind_param("si", $mname, $_SESSION['customer_id']);
        $prepare->execute();
    $_SESSION['mname']=$mname;
    header("location:receptionist_update.php");
}
}

if(isset($_POST['upphone'])){
    $phone=$_POST['phone'];
    $prepare= $conn->prepare("UPDATE customers SET phone =? WHERE customer_id=?");
        $prepare->bind_param("ii", $phone, $_SESSION['customer_id']);
        $prepare->execute();
    $_SESSION['phone']=$phone;
    header("location:receptionist_update.php");
}



if(isset($_POST['upemail'])){
    $email=$_POST['email'];
    $prepare= $conn->prepare("UPDATE customers SET email =? WHERE customer_id=?");
        $prepare->bind_param("si", $email, $_SESSION['customer_id']);
        $prepare->execute();
    $_SESSION['email']=$email;
    header("location:receptionist_update.php");
}

if(isset($_POST['select'])){
    $room_id=$_POST['room_id'];
        
    $prepare01= $conn->prepare("UPDATE guests SET date_in =?, date_out=?, guests_count=?,room_id=? WHERE customer_id=?");
        $prepare01->bind_param("ssiii", $_SESSION['checkin'],  $_SESSION['checkout'], $guests_count,$room_id, $_SESSION['customer_id']);
        $prepare01->execute();

    $stays=(strtotime($_SESSION['checkout'])-strtotime($_SESSION['checkin']))/60/60/24; //number of stays

//get room_cost
$sql2 = "SELECT t.room_cost as 'room_cost', g.payment_id as 'payment_id'
    FROM room_type t, rooms r, guests g
    WHERE t.roomtype_id=r.roomtype_id AND r.room_id=$room_id AND g.room_id=r.room_id";
    $result2 = $conn->query($sql2); 

    while($row = $result2->fetch_assoc()){
        $room_cost=$row['room_cost'];
        $payment_id=$row['payment_id'];}

    $payment = $stays*$room_cost;

//update payment
$prepare02= $conn->prepare("UPDATE payments SET payment_amount =? 
    WHERE payment_id=?");
        $prepare02->bind_param("ii", $payment, $payment_id);
        $prepare02->execute();
    $_SESSION['room_id']=$room_id;

}

    if(isset($_POST['back'])){
        header("location:receptionist_res-list.php");
    }
}

unset($_SESSION['extended_date']);

ob_end_flush();
?>


                
        </div>
    </body>
