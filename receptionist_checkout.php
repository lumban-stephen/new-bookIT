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
                <li><a href="receptionist_dashboard.php">Dashboard</a></li>
                <li><a href="receptionist_checkin.php">Check In</a></li>
                <li><a href="#">Check Out</a></li>
                <li><a href="receptionist_reservation.php">Reservation</a></li>
                <li><a href="receptionist_records.php">Records</a></li>
                <li><a href="receptionist_toDoList.php">To Do List</a></li>
                <li><a href="receptionist_guests.php">Guests</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code Here only-->
            <!--Check out page code in here-->
            <?php
                include 'connection.php';

                $sql = "SELECT  rooms.room_id, 
                                guests.guest_id, 
                                customers.fname, 
                                customers.lname,
                                SUM(bill_items.quantity * amenities.amenity_price) AS 'payables', 
                                room_type.room_cost,
                                SUM(bill_items.quantity * amenities.amenity_price) + room_type.room_cost AS 'total_amount',
                                payments.payment_id,
                                payments.payment_amount                                 
                        FROM guests, customers, rooms, room_type, payments, bill, bill_items, amenities
                        WHERE guests.customer_id = customers.customer_id AND 
                        guests.room_id = rooms.room_id AND 
                        guests.payment_id = payments.payment_id AND 
                        rooms.roomtype_id = room_type.roomtype_id AND 
                        payments.bill_id = bill.bill_id AND
                        bill.bill_id = bill_items.bill_id AND
                        bill_items.amenity_id = amenities.amenity_id AND
                        guests.guest_status = 'INCOMPLETE'
                        GROUP BY guests.guest_id";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) > 0){

                    while($row = mysqli_fetch_assoc($result)){
                        echo "
                        <div class='grid-container'>
                            <form action='' method='POST'>
                                <h2>Room Number: ".$row["room_id"]."</h2> 
                                <p> 
                                    Guest ID: ".$row["guest_id"]."<br>
                                    Customer Name: ".$row["fname"]." ".$row["lname"]."<br><br>
                                    Payables: ".$row["payables"]."<br>
                                    Room Cost: ".$row["room_cost"]."<br>   
                                    Total Amount: ".$row["total_amount"]."<br><br>   
                                    Payment Amount: ".$row["payment_amount"]."<br>
                                    
                                    <input type='submit' name='remove' value='Check Out'>
                                    <input type='hidden' name='paid' value='{$row["total_amount"]}'>
                                    <input type='hidden' name='guestID' value='{$row['guest_id']}'>
                                    <input type='hidden' name='roomID' value='{$row['room_id']}'>
                                    <input type='hidden' name='paymentID' value='{$row['payment_id']}'>
                                    <input type='hidden' name='payAmount' value='{$row['payment_amount']}'>
                                    <input type='hidden' name='totAmount' value='{$row['total_amount']}'>
                                    <br><br>
                                </p>
                            </form>
                        </div>
                        ";
                    }
                } else {
                    echo 'No data found.';
                }

                if(isset($_POST['remove'])){
                    $total = $_POST['totAmount'];
                    $payment = $_POST['payAmount'];
                    $paid = $_POST['paid']; 
                    $gID = $_POST['guestID'];
                    $rID = $_POST['roomID'];
                    $pID = $_POST['paymentID'];

                    if($payment >= $total){
                        $updateGuest = "UPDATE guests SET guest_status = 'Complete' WHERE guest_id = $gID";
                        $updateRoom = "UPDATE rooms SET room_status = 'Available' WHERE guest_id = $gID";
                        $newRecord = "INSERT INTO records (record_type, record_date, record_time, record_paid, guest_id, room_id, payment_id)
                                    VALUES ('STAYING', 
                                            SELECT CAST( GETDATE() AS Date ), 
                                            SELECT CONVERT(TIME,GETDATE()), TRY_CONVERT(TIME, GETDATE()), CAST(GETDATE() AS TIME),
                                            $paid,
                                            $gID,
                                            $rID, 
                                            $pID)";
            
                        if ($conn->query($updateGuest) === TRUE && $conn->query($updateRoom) === TRUE && $conn->query($newRecord) === TRUE) {
                            echo "<script language='javascript'>
                                        window.location.href='receptionist_checkout.php';
                                        alert('Check Out is successful');
                                </script>";
                            
                        } else {
                            echo "Error: " .$updateGuest. "<br>" .$conn->error;
                        }
                    } else {
                        echo "<script language='javascript'>
                                        window.location.href='receptionist_checkout.php';
                                        alert('Payment Amount is not enough! Pay the total amount of $total');
                                </script>";
                    }
                }
            ?>
        </div>
    </body>