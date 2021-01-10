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
            <!--receptionist check in form page code in here-->

             <?php
            include 'connection.php';
            error_reporting(0);
            ob_start();
            
            echo "<form method='post' action=''>  
                <label class='Labelform'>First Name</label><input type='text' class='mngt' name='fname' value='{$_SESSION['fname']}'>
                <br>

                <label class='Labelform'>Last Name</label><input type='text' class='mngt' name='lname' value='{$_SESSION['lname']}'><br>
                <label class='Labelform'>Middle Name</label><input type='text' class='mngt' name='mname' value='{$_SESSION['mname']}'>
                <br>
              
                <label class='Labelform'>Phone Number</label><input type='number' name='phone' class='mngt' value='{$_SESSION['phone']}' style='width:20%;'>

                <br>
                <label class='Labelform'>E-mail</label><input type='email' name='email' class='mngt' value='{$_SESSION['email']}' style='width:30%;'>
                
                <br><br>
                
                <button type='submit' name='update' class='Greenbutton'><h3>Update</h3></button>
            </form>";


//update name
if(isset($_POST['update'])){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $mname=$_POST['mname'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $update= $conn->prepare("UPDATE customers SET fname =?,lname =?,MI =?,phone =?,email =? WHERE customer_id=?");
        $update->bind_param("sssisi", $fname,$lname,$mname,$phone,$email,$_SESSION['customer_id']);
        $update->execute();
    $_SESSION['fname']=$fname;
    $_SESSION['lname']=$lname;
    $_SESSION['mname']=$mname;
    $_SESSION['phone']=$phone;
    $_SESSION['email']=$email;
    header("location:receptionist_update.php");
    }

            echo "<hr><form method='post' action=''>
                <label  class='Labelform'>Room Type</label>  ".$_SESSION['room_desc']."
                <br>
                <label class='Labelform'>Check-in</label>  ".$_SESSION['checkin']."<input type='date' name='checkin' class='mngt' required>
                
                <label class='Labelform'>Check-out</label>  ".$_SESSION['checkout']."<input type='date' name='checkout' class='mngt' required>
                
                <label class='Labelform'>Number of Guests</label>    ".$_SESSION['numguest']."   <select name='numguest' class='mngt' style='width:10%;' required>
    <option value='Select'>Select</option>
    <option value='1'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>  
    </select></span><br>
    <button type='submit' name='search_room'  style='background-color: #003399; padding: 5px; ' class='button'>Search Room</button></form><br><br>";

if(isset($_POST['search_room'])){
    $checkin=$_POST['checkin'];
    $checkout=$_POST['checkout'];
    $numguest=$_POST['numguest'];

    $_SESSION['checkin'] = $checkin;
    $_SESSION['checkout'] = $checkout;
    $_SESSION['numguest'] = $numguest;

$rooomtype = "SELECT DISTINCT t.room_desc AS room_desc, t.roomtype_id as roomtype_id
            FROM    room_type t, 
                    rooms r
            WHERE   r.roomtype_id=t.roomtype_id AND 
                    r.room_status != 'Maintenance' AND 
                    r.room_status !='Used by guest' AND 
                    r.room_status !='Reserved' AND 
                    r.room_id NOT IN(SELECT g.room_id 
                                    FROM guests g 
                                    WHERE $checkin between g.date_in and g.date_out) AND 
                    r.room_id NOT IN(SELECT g.room_id 
                                    FROM guests g 
                                    WHERE $checkout between g.date_in and g.date_out) AND 
                    t.room_cap>=$numguest";

    $result1 = $conn->query($rooomtype); 

    if(mysqli_num_rows($result1) > 0){
        echo "Available Room Type<br><br>";
        echo "<div class='grid-container'>";
    while($row = $result1->fetch_assoc()){
                
                echo "
                <form  method='post' action=''>
                <button type='submit' name='select' style='background-color: #28C479; padding: 10px; '><h1>".$row['room_desc']."</button>
                <input type='hidden' name='roomtype_id' value='{$row['roomtype_id']}'>
                <input type='hidden' name='room_desc' value='{$row['room_desc']}'>
                
                </form>";}
                echo "</div>";

}}
            


if(isset($_POST['select'])){
    $roomtype_id = $_POST['roomtype_id'];
    $room_desc = $_POST['room_desc'];
    $_SESSION['room_desc']=$room_desc;
header("location:receptionist_update.php");
    $rooomId = "SELECT r.room_id AS room_id
            FROM    rooms r
            WHERE   r.roomtype_id=$roomtype_id AND 
                    r.room_status = 'Available' AND 
                    r.room_id NOT IN(SELECT g.room_id 
                                    FROM guests g 
                                    WHERE '{$_SESSION['checkin']}' between g.date_in and g.date_out) AND 
                    r.room_id NOT IN(SELECT g.room_id 
                                    FROM guests g 
                                    WHERE '{$_SESSION['checkout']}' between g.date_in and g.date_out)";
    $result2 = $conn->query($rooomId); 
    while($rows = $result2->fetch_assoc()){
    $room_id=$rows['room_id'];}
    $_SESSION['room_id']=$room_id;

        
    $prepare01= $conn->prepare("UPDATE guests SET date_in =?, date_out=?, guests_count=?,room_id=? WHERE customer_id=?");
        $prepare01->bind_param("ssiii", $_SESSION['checkin'],  $_SESSION['checkout'], $_SESSION['numguest'],$room_id, $_SESSION['customer_id']);
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
header("location:receptionist_update.php");

}




ob_end_flush();
?>
<a href='receptionist_res-list.php' class='Greenbutton' style='width:20%;'>Back to Reservation List</a>

                
        </div>
    </body>
