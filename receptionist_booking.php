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
            <!--Booking page code in here-->

            <?php
            include 'connection.php';
            //error_reporting(0);

            echo "<form method='post' action=''>  
                <label class='Labelform'>First Name</label>
                <input type='text' name='fname'class='booking'>
                <br><br>
                <label class='Labelform'>Last Name</label>
                <input type='text' name='lname' class='booking'>
                <br><br>
                <label class='Labelform'>Middle Name</label>
                <input type='text' name='mname' class='booking' >
                <br><br>
                <label class='Labelform'>Check-in</label><span class='booking'>".$_SESSION['checkin']."</span>
                <br><br>
                <label class='Labelform'>Check-out</label><span class='booking'>".$_SESSION['checkout']."</span>
                <br><br>
                <label class='Labelform'>Check-in Time</label>
                <input type='time' name='time' class='booking'>
                <br><br>
                <label class='Labelform'>Number of Guests</label><span class='booking'>".$_SESSION['numguest']."</span>
                <br><br>
                <label class='Labelform'>Room Selected</label><span class='booking'>".$_SESSION['room_id']."</span>
                <br><br>
                <label class='Labelform'>Phone Number</label>
                <input type='number' name='phone' class='booking' style='width:20%;'>
                <br><br>
                <label class='Labelform'>E-mail</label>
                <input type='email' name='email' class='booking' style='width:30%;'>
                <br><br>
                <button type='submit' name='book' class='Greenbutton'>Book Reservation</button>
                <input type='submit' name='cancel' value='Cancel Check-in' class='Checkoutbutton'>
                <br><br>
            </form>";

        if(isset($_POST['book'])){
                $fname=$_POST['fname'];
                $lname=$_POST['lname'];
                $mname=$_POST['mname'];
                $phone=$_POST['phone'];
                $email=$_POST['email'];
                $time=$_POST['time'];

                $stays=(strtotime($_SESSION['checkout'])-strtotime($_SESSION['checkin']))/60/60/24; //number of stays

                //get room_id
                $sql = "SELECT t.room_cost AS room_cost,t.roomtype_id AS roomtype_id
                FROM rooms r,room_type t
                WHERE r.roomtype_id = t.roomtype_id AND 
                r.room_id='{$_SESSION['room_id']}'";
                $result = $conn->query($sql);

                while($row = $result->fetch_assoc()){
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
            $prepare2 = $conn->prepare("INSERT INTO guests(date_in,date_out,guests_count,room_id,customer_id) VALUES (?,?,?,?,?)");
            $prepare2->bind_param("ssiii",$_SESSION['checkin'],$_SESSION['checkout'],$_SESSION['numguest'],$_SESSION['room_id'],$customer_id);
            $prepare2->execute();

            //get guest_id ($conn->insert_id : get the last generated id)
            $guest_id = $conn->insert_id;
            $_SESSION['guest_id']=$guest_id;


            //create data in schedule
            $prepare3 = $conn->prepare("INSERT INTO schedule(guest_id,room_id) VALUES (?,?)");
            $prepare3->bind_param("ii",$guest_id,$room_id);
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
            $prepare6 = $conn->prepare("INSERT INTO bill(bill_date,guest_id) VALUES (?,?)");
            $prepare6->bind_param("si",$_SESSION['checkin'],$guest_id);
            $prepare6->execute();

            //get bill_id ($conn->insert_id : get the last generated id)
            $bill_id= $conn->insert_id;
            
            //create data in bill_items
            $prepare7 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date) VALUES (?,?,?)");
            $prepare7->bind_param("iis",$stays,$bill_id,$_SESSION['checkin']);
            $prepare7->execute();

            //create data in records
            $record_type="COMING";
            $prepare7 = $conn->prepare("INSERT INTO records(record_type,record_date,record_time,guest_id) VALUES (?,?,?,?)");
            $prepare7->bind_param("sssi",$record_type,$_SESSION['checkin'],$time,$guest_id);
            $prepare7->execute();
            header("location:receptionist_dashboard.php");}
           

            

            

            //if cancel booking
            if(isset($_POST['cancel'])){
            
            header("location:receptionist_dashboard.php");}


            ?>
            



            <br>
            <br>
            <br>



        </div>
    </body>
