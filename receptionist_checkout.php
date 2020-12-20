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
                                SUM(bill_items.quantity * amenities.amenity_price) AS 'total_amount', 
                                room_type.room_cost, 
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
                        GROUP BY rooms.room_id";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) > 0){

                    while($row = mysqli_fetch_assoc($result)){
                        echo "
                        <form action='' method='POST'>
                            <h2>Room Number: ".$row["room_id"]."</h2> 
                            <p> 
                                Guest ID: ".$row["guest_id"]."<br>
                                Customer Name: ".$row["fname"]." ".$row["lname"]."<br>
                                Payables: ".$row["total_amount"]."<br>
                                Room Cost: ".$row["room_cost"]."<br>   
                                Payment ID: ".$row["payment_id"]."<br>                                   
                                Payment Amount: ".$row["payment_amount"]."<br><br>
                                
                                <input type='submit' name='remove' value='Check Out'>
                                <input type='hidden' name='guestID' value='{$row['guest_id']}'>
                                <input type='hidden' name='roomID' value='{$row['room_id']}'>
                                <input type='hidden' name='paymentID' value='{$row['payment_id']}'>
                            </p>
                        </form>
                        ";
                    }
                } else {
                    echo 'No data found.';
                }

                if(isset($_POST['remove'])){
                    $gID = $_POST['guestID'];
                    $rID = $_POST['roomID'];
                    $pID = $_POST['paymentID'];
                    $updateGuest = "UPDATE guests SET guest_status = 'Complete' WHERE guest_id = $gID";
                    $updateRoom = "UPDATE rooms SET room_status = 'Available' WHERE guest_id = $gID";
                    $newRecord = "INSERT INTO records (record_type, record_date, record_time, guest_id, room_id, payment_id)
                                VALUES ('STAYING', 
                                        SELECT CAST( GETDATE() AS Date ), 
                                        SELECT CONVERT(TIME,GETDATE()), TRY_CONVERT(TIME, GETDATE()), CAST(GETDATE() AS TIME),
                                        $gID,
                                        $rID, 
                                        $pID)";
        
                    if ($conn->query($updateGuest) === TRUE && $conn->query($updateRoom) === TRUE && $conn->query($newRecord) === TRUE) {
                        echo "<script language='javascript'>
                                    window.location.href='display.php';
                                    alert('Check Out is successful');
                            </script>";
                        
                    } else {
                        echo "Error: " .$updateGuest. "<br>" .$conn->error;
                    }
                }
            ?>
        </div>
    </body>