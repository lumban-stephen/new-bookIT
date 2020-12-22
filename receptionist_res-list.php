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
  grid-template-columns: 33% 33% 33%;
  grid-gap: 10px;
  padding: 10px;
}

button, input[type=submit]{
  border: none;
  padding:10px;
  text-decoration: initial;
  display: initial;
  font-size: initial;
  margin:initial;
  font-weight: initial;
  white-space: initial;
  -webkit-appearance: initial;
  width: initial;
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
            <!--Reservation list page code in here-->
            <h2>Reservation List</h2>
            <br>
            <table id="Table">
              <tr>
                <th>Guest Name</th>
                <th>Room<br>Number</th>
                <th>Check-in<br>Date</th>
                <th>Check-out<br>Date</th>
                <th>Actions</th>
              </tr>

<?php
ob_start();
    include 'connection.php';
    //error_reporting(0);?
    $today=date("Y-d-m");
    $status="COMPLETE";

$sql = "SELECT CONCAT(c.fname,' ',c.MI,' ',c.lname) as name,c.fname as fname,c.MI as mname, c.lname as lname, r.room_id as room_id, g.date_in as date_in, g.date_out as date_out, g.guests_count as numguest, c.phone as phone, c.email as email, g.guest_status as guest_status, s.guest_id as guest_id, c.customer_id as customer_id
    FROM guests g, customers c, rooms r, schedule s
    WHERE g.customer_id = c.customer_id and r.room_id = g.room_id and s.guest_id=g.guest_id
    ORDER BY g.date_in";

    $result = $conn->query($sql); 
while($row = $result->fetch_assoc()){
    if($row['guest_status'] != $status){
         echo "<form method='post' action=''><tr>
        
                <td>".$row['name']."</td>
                <td>".$row['room_id']."</td>
                <td>".$row['date_in']."</td>
                <td>".$row['date_out']."</td>
                <td>
                <span class='grid-container'>
                <button type='submit' name='checkin' ' class='Greenbutton'>Check in</button>
                <button type='submit' name='update'  class='Graybutton'>Update<br>Reschedule</button>
                <button type='submit' name='cancel' class='Checkoutbutton'>Cancel Booking</button>
                </span>
                </td>

                <input type='hidden' name='fname' value='{$row['fname']}'>
                <input type='hidden' name='lname' value='{$row['lname']}'>
                <input type='hidden' name='mname' value='{$row['mname']}'>
                <input type='hidden' name='room_id' value='{$row['room_id']}'>
                <input type='hidden' name='date_in' value='{$row['date_in']}'>
                <input type='hidden' name='date_out' value='{$row['date_out']}'>
                <input type='hidden' name='numguest' value='{$row['numguest']}'>
                <input type='hidden' name='phone' value='{$row['phone']}'>
                <input type='hidden' name='email' value='{$row['email']}'>
                <input type='hidden' name='guest_id' value='{$row['guest_id']}'>
                <input type='hidden' name='customer_id' value='{$row['customer_id']}'>
                
                
              </tr></form>";}}

   if(isset($_POST['checkin'])){
    header("location:receptionist_checkinform.php");
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $mname=$_POST['mname'];
        $room_id=$_POST['room_id'];
        $date_in=$_POST['date_in'];
        $date_out=$_POST['date_out'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $numguest=$_POST['numguest'];
        $customer_id=$_POST['customer_id'];
        $_SESSION['fname']=$fname;
        $_SESSION['lname']=$lname;
        $_SESSION['mname']=$mname;
        $_SESSION['phone']=$phone;
        $_SESSION['room_id']=$room_id;
        $_SESSION['checkin']=$date_in;
        $_SESSION['checkout']=$date_out;
        $_SESSION['phone']=$phone;
        $_SESSION['email']=$email;
        $_SESSION['numguest']=$numguest;
        $_SESSION['customer_id']=$customer_id;
        $_SESSION['list']=2; ////examine in checkin_form if it is from list.
}

   if(isset($_POST['cancel'])){
    $guest_id=$_POST['guest_id'];
    
    $sql4 = "DELETE FROM schedule WHERE guest_id = $guest_id";

//delete check_in and out dates. 

    $null="1000-01-01";
    $cancelled="CANCELLED";
    $prepare1 = $conn->prepare("UPDATE guests SET date_in =?, date_out=?,guest_status=? WHERE guest_id=?");
    $prepare1->bind_param("sssi", $null,$null,$cancelled, $guest_id);
    $prepare1->execute();

//get payment_id
    $sql5="SELECT payment_id FROM guests WHERE guest_id=$guest_id";
    $result5 = $conn->query($sql5);
    while($row = $result5->fetch_assoc()){
        $payment_id=$row['payment_id'];
    } 

//delete amount in payments
    $a=0;
    $prepare2 = $conn->prepare("UPDATE payments SET payment_amount =? WHERE payment_id=?");
    $prepare2->bind_param("ii", $a, $payment_id);
    $prepare2->execute();


    if($conn->query($sql4)===TRUE){
        echo "successfully deleted";
        header("location:receptionist_res-list.php");
    }else{
        echo "failed".$conn->error;
    }      
}

   if(isset($_POST['update'])){
    header("location:receptionist_update.php");
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $mname=$_POST['mname'];
        $room_id=$_POST['room_id'];
        $date_in=$_POST['date_in'];
        $date_out=$_POST['date_out'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $numguest=$_POST['numguest'];
        $customer_id=$_POST['customer_id'];

        $_SESSION['fname']=$fname;
        $_SESSION['lname']=$lname;
        $_SESSION['mname']=$mname;
        $_SESSION['phone']=$phone;
        $_SESSION['room_id']=$room_id;
        $_SESSION['checkin']=$date_in;
        $_SESSION['checkout']=$date_out;
        $_SESSION['phone']=$phone;
        $_SESSION['email']=$email;
        $_SESSION['numguest']=$numguest;
        $_SESSION['customer_id']=$customer_id;
    
     
}
$conn->close();
ob_end_flush();
  ?>
            </table>   

        </div>
    </body>
