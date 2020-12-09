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

    $sql1 = "SELECT t.room_code as 'room_code',t.room_desc AS room_desc
    FROM room_type t 
    WHERE t.roomtype_id NOT IN(
    SELECT g.roomtype_id FROM guests g where $checkin between g.date_in and g.date_out) AND t.roomtype_id NOT IN(
    SELECT g.roomtype_id FROM guests g where $checkout between g.date_in and g.date_out) AND t.room_cap>=$numguest";

    $result1 = $conn->query($sql1); 

    if(mysqli_num_rows($result1) > 0){
    while($row = $result1->fetch_assoc()){
                
                echo "<form action='' method='POST'>".
                $row['room_code']."\t".$row['room_desc']."<br>
                <input type='submit' name='select' value='select'>
                <input type='hidden' name='room' value='{$row['room_code']}'>
                </form>";}
    }else{
        echo 'No available room.';
    }

    $sql2 = "SELECT t.room_code as 'room_code', CONCAT(c.fname,', ',c.MI,', ',c.lname) as 'NAME', g.date_in as 'date_in', g.date_out as 'date_out',t.room_desc AS room_desc, c.fname AS fname, c.lname as lname, c.MI as mname, c.phone as phone, c.email as email,c.customer_id as customer_id, g.guest_id as guest_id, r.room_id as room_id, t.roomtype_id as roomtype_id, g.payment_id as payment_id
    FROM guests g, customers c, room_type t,rooms r
    WHERE c.customer_id=g.customer_id AND g.roomtype_id=t.roomtype_id AND g.date_in>=$checkin AND r.roomtype_id=t.roomtype_id
    GROUP BY g.date_in";

    $result2 = $conn->query($sql2); 

    if(mysqli_num_rows($result2) > 0){
    while($row = $result2->fetch_assoc()){
                
                echo "<form action='' method='POST'><label>Name: </label>".$row['NAME']."<br>

                <label>Check-in: </label>".$row['date_in']."\t

                <label>Check-out: </label>".$row['date_out']."
                <br>
                <label>Room: </label>".$row['room_code']."\t".$row['room_desc']."
                <br>

                <input type='hidden' name='fname' value='{$row['fname']}'>
                <input type='hidden' name='lname' value='{$row['lname']}'>
                <input type='hidden' name='mname' value='{$row['mname']}'>
                <input type='hidden' name='phone' value='{$row['phone']}'>
                <input type='hidden' name='email' value='{$row['email']}'>
                <input type='hidden' name='room_code' value='{$row['room_code']}'>
                <input type='hidden' name='guest_id' value='{$row['guest_id']}'>
                <input type='hidden' name='customer_id' value='{$row['customer_id']}'>
                <input type='hidden' name='room_id' value='{$row['room_id']}'>
                <input type='hidden' name='roomtype_id' value='{$row['roomtype_id']}'>
                <input type='hidden' name='payment_id' value='{$row['payment_id']}'>

                <input type='submit' name='select' value='select'>
                </form><br>

                ";}
    }else{
        echo 'No list.';
    }




}

    if(isset($_POST['select'])){
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $mname=$_POST['mname'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $room_code = $_POST['room_code'];

        $guest_id=$_POST['guest_id'];
        $customer_id=$_POST['customer_id'];
        $room_id=$_POST['room_id'];
        $roomtype_id=$_POST['roomtype_id'];
        $payment_id=$_POST['payment_id'];


        $_SESSION['fname']=$fname;
        $_SESSION['lname']=$lname;
        $_SESSION['mname']=$mname;
        $_SESSION['phone']=$phone;
        $_SESSION['email']=$email;  
        $_SESSION['room_code'] = $room_code;

        $_SESSION['guest_id'] = $guest_id;
        $_SESSION['customer_id'] = $customer_id;
        $_SESSION['room_id'] = $room_id;
        $_SESSION['roomtype_id'] = $roomtype_id;
        $_SESSION['payment_id'] = $payment_id;
        
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