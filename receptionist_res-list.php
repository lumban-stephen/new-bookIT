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
                <a>
                    <form method="post" action="#">
                        <button class="Logoutbutton" name="logout">Logout</button>
                    </form>
                </a>
            </div>
            <div class="right-float">
                <p>Welcome,</p>
            </div>
            <div class="right-float">
                <a><img></img></a>
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
    include 'connection.php';
    //error_reporting(0);?
    $today=date("Y-d-m");
    $status="COMPLETE";

$sql = "SELECT CONCAT(c.fname,' ',c.MI,' ',c.lname) as name,c.fname as fname,c.MI as mname, c.lname as lname, r.room_id as room_id, g.date_in as date_in, g.date_out as date_out, g.guests_count as numguest, c.phone as phone, c.email as email, g.guest_status as guest_status, g.guest_id as guest_id
    FROM guests g, customers c, rooms r
    WHERE g.customer_id = c.customer_id and r.room_id = g.room_id
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
                <input type='submit' name='checkin' value='checkin' class='submit'>
                <input type='submit' name='update' value='Update/Reschedule' class='submit'>
                <input type='submit' name='cancel' value='Cancel Booking' class='submit'>
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
        $_SESSION['fname']=$fname;
        $_SESSION['lname']=$lname;
        $_SESSION['mname']=$mname;
        $_SESSION['phone']=$phone;
        $_SESSION['room_id']=$room_id;
        $_SESSION['date_in']=$date_in;
        $_SESSION['date_out']=$date_out;
        $_SESSION['phone']=$phone;
        $_SESSION['email']=$email;
}

   if(isset($_POST['cancel'])){
    $guest_id=$_POST['guest_id'];
    $sql1 = "SELECT b.bill_id as bill_id FROM bill b, guests g WHERE g.guest_id = b.guest_id";

    $result2 = $conn->query($sql1); 
        while($row = $result2->fetch_assoc()){
            $bill_id = $row['bill_id'];
        }

    $sql5 = "DELETE FROM bill_items WHERE bill_id = $bill_id";
    $sql2 = "DELETE FROM guests WHERE guest_id = $guest_id";
    $sql3 = "DELETE FROM bill WHERE guest_id = $guest_id";
    $sql4 = "DELETE FROM schedule WHERE guest_id = $guest_id";

    if($conn->query($sql2)===TRUE){
        echo "successfully deleted";
    }else{
        echo "failed".$conn->error;
    }   
        header("location:receptionist_checkinform.php");
}
$conn->close();
  ?>
            </table>   

        </div>
    </body>
