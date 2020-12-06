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
            <!--Booking page code in here-->

            <?php
            include 'connection.php';
            //error_reporting(0);

            echo "<form method='post' action=''>  
                <label>First Name</label>
                <input type='text' name='fname' class='button' required>
                <br><br>

                <label>Last Name</label>
                <input type='text' name='lname' class='button' required>
                <br><br>

                <label>Middle Name</label>
                <input type='text' name='mname' class='button' >
                <br><br>

                <label>Check-in</label><br>".$_SESSION['checkin']."
                <br><br>

                <label>Check-out</label><br>".$_SESSION['checkout']."
                <br><br>

                <label>Number of Guests</label><br>".$_SESSION['numguest']."
                <br><br>

                <label>Room Selected</label><br>".$_SESSION['room_code']."
                <br><br>

                <label>Phone Number</label>
                <input type='number' name='phone' class='button'>
                <br><br>

                <label>E-mail</label>
                <input type='email' name='email' class='button'>
                <br><br>

                <input type='submit' name='book' value='Book Reservation' class='submit'>
                <br><br>
            </form>";


            if(isset($_POST['book'])){
            //echo "<div class='content'>Successfully submitted!!</div>";

                $fname=$_POST['fname'];
                $lname=$_POST['lname'];
                $mname=$_POST['mname'];
                $phone=$_POST['phone'];
                $email=$_POST['email'];

            echo "<label>First Name : </label>".$fname."<br>
            <label>Last Name : </label>".$lname."<br>
            <label>Middle Name : </label>".$mname."<br>
            <label>Check-in : </label>".$_SESSION['checkin']."<br>
            <label>Check-out : </label>".$_SESSION['checkout']."<br>
            <label>Number of Guests : </label>".$_SESSION['numguest']."<br>
            <label>Room Selected : </label>".$_SESSION['room_code']."<br>
            <label>Phone Number : </label>".$phone."<br>
            <label>E-mail : </label>".$email;

            echo "<form method='post' action=''><input type='submit' name='confirm' value='Confirm' class='submit'>
                <br><br>
                <input type='submit' name='cancel' value='Cancel' class='submit'>
                <br><br>
                <input type='hidden' name='fname' value='{$fname}'>
                <input type='hidden' name='lname' value='{$lname}'>
                <input type='hidden' name='mname' value='{$mname}'>
                <input type='hidden' name='phone' value='{$phone}'>
                <input type='hidden' name='email' value='{$email}'>
                </form>";}

            if(isset($_POST['confirm'])){
                $fname=$_POST['fname'];
                $lname=$_POST['lname'];
                $mname=$_POST['mname'];
                $phone=$_POST['phone'];
                $email=$_POST['email'];
                $_SESSION['fname']=$fname;
                $_SESSION['lname']=$lname;
                $_SESSION['mname']=$mname;
                $_SESSION['phone']=$phone;
                $_SESSION['email']=$email;

                $stays=(strtotime($_SESSION['checkout'])-strtotime($_SESSION['checkin']))/60/60/24; //number of stays

                //get room_id
                $sql = "SELECT r.room_id AS room_id, t.room_cost AS room_cost,t.roomtype_id AS roomtype_id
                FROM rooms r,room_type t
                WHERE r.roomtype_id = t.roomtype_id AND 
                t.room_code='{$_SESSION['room_code']}'";
                $result = $conn->query($sql);

                while($row = $result->fetch_assoc()){
                        $room_id = $row['room_id'];
                        $room_cost = $row['room_cost'];
                        $roomtype_id = $row['roomtype_id'];
                }

                $payment = $stays*$room_cost;  //total cost

            //create data in customers
                $prepare = $conn->prepare("INSERT INTO customers(fname,lname,MI,email,phone) VALUES (?,?,?,?,?)");
            $prepare->bind_param("sssss",$fname,$lname,$mname,$email,$phone);
            $prepare->execute();

            //get customer_id ($conn->insert_id : get the last generated id)
            $customer_id = $conn->insert_id;
            
            //create data in guests
            $prepare2 = $conn->prepare("INSERT INTO guests(date_in,date_out,guests_count,room_id,customer_id,roomtype_id) VALUES (?,?,?,?,?,?)");
            $prepare2->bind_param("ssiiii",$_SESSION['checkin'],$_SESSION['checkout'],$_SESSION['numguest'],$room_id,$customer_id,$roomtype_id);
            $prepare2->execute();

            //get guest_id ($conn->insert_id : get the last generated id)
            $guest_id = $conn->insert_id;

            //create data in schedule
            $prepare3 = $conn->prepare("INSERT INTO schedule(guest_id,customer_id,room_id,roomtype_id) VALUES (?,?,?,?)");
            $prepare3->bind_param("iiii",$guest_id,$customer_id,$room_id,$roomtype_id);
            $prepare3->execute();


            //create data in payments
            $prepare4 = $conn->prepare("INSERT INTO payments(payment_amount) VALUES (?)");
            $prepare4->bind_param("i",$payment);
            $prepare4->execute();

            //get payment_id ($conn->insert_id : get the last generated id)
            $payment_id= $conn->insert_id;

            //insert payment_id to guests
            $prepare5= $conn->prepare("UPDATE guests SET payment_id =? WHERE guest_id=?");
            $prepare5->bind_param("ii", $payment_id, $guest_id);
            $prepare5->execute();

            //create data in bill
            $prepare6 = $conn->prepare("INSERT INTO bill(bill_date,subtotal,payment_id,guest_id) VALUES (?,?,?,?)");
            $prepare6->bind_param("siii",$_SESSION['checkin'],$payment,$payment_id,$guest_id);
            $prepare6->execute();

            //get bill_id ($conn->insert_id : get the last generated id)
            $bill_id= $conn->insert_id;

            //create data in bill_items
            $prepare7 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,roomtype_id) VALUES (?,?,?,?)");
            $prepare7->bind_param("iisi",$stays,$bill_id,$_SESSION['checkin'],$roomtype_id);
            $prepare7->execute();
            
            echo "<form method='post' action=''><input type='submit' name='checkin' value='Check-in' class='submit'>
                <br><br>
                <input type='submit' name='back' value='finish booking' class='submit'>
                <br><br>
                </form>";

            }

            //if check in
            if(isset($_POST['checkin'])){

            header("location:receptionist_checkinform.php");}

            //if cancel booking
            if(isset($_POST['cancel'])){
            unset($_SESSION['checkin']);
            unset($_SESSION['checkout']);
            unset($_SESSION['numguest']);
            unset($_SESSION['room_code']);
            header("location:receptionist_reservation.php");}

            //if finish booking
            if(isset($_POST['back'])){
            unset($_SESSION['checkin']);
            unset($_SESSION['checkout']);
            unset($_SESSION['numguest']);
            unset($_SESSION['room_code']);
            header("location:receptionist_dashboard.php");}

            ?>
            



            <br>
            <br>
            <br>



        </div>
    </body>