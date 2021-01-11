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
            <!--Check out page code in here-->
            <!--search bar in the checkout page that uses room number to find the guests-->
            <div class="search-container">
                <form method="POST">
                    <label class="Labelform">Search Room Number: </label><input type="text" class="input-search"placeholder="Search.." name="keyword">
                    <button class= "searchbutton"  name="search">Search</button>
                </form>
            </div>
                    <?php 
                        error_reporting(0);
                        include 'connection.php';
                        if (isset($_POST['keyword'])) {
                            $keyword = trim ($_POST['keyword']);

                            $sql = "SELECT  rooms.room_id, 
                                            guests.guest_id, 
                                            customers.fname, 
                                            customers.lname,
                                            SUM(bill_items.quantity * amenities.amenity_price) AS 'payables', 
                                            payments.payment_amount as room_cost,
                                            SUM(bill_items.quantity * amenities.amenity_price) + payments.payment_amount AS 'total_amount',
                                            payments.payment_id,
                                            ch.paid_amount as payment_amount,
                                            ch.paid_amount - (SUM(bill_items.quantity * amenities.amenity_price) + payments.payment_amount) AS 'change',
                                            CURRENT_DATE AS 'date',
                                            CURRENT_TIME AS 'time'                                 
                                    FROM guests, customers, rooms, room_type, payments, bill, bill_items, amenities,checked_in_guests ch
                                    WHERE guests.customer_id = customers.customer_id AND 
                                    guests.room_id = rooms.room_id AND 
                                    guests.payment_id = payments.payment_id AND 
                                    rooms.roomtype_id = room_type.roomtype_id AND 
                                    payments.bill_id = bill.bill_id AND
                                    bill.bill_id = bill_items.bill_id AND
                                    bill_items.amenity_id = amenities.amenity_id AND
                                    guests.guest_status = 'INCOMPLETE' AND
                                    guests.date_out = CURDATE() AND 
                                    ch.guest_id=guests.guest_id AND 
                                    rooms.room_id LIKE '%$keyword%'
                                    GROUP BY guests.guest_id";
                           
                            echo "<br>
                                <div id='SearchTable'>
                                    <div>
                                        <h4 style='float:left;'>Results for \"$keyword\"</h4> <input type='submit' style='float:right;' class='Logoutbutton'  onclick='closeTable()' value='Close Search'>
                                    </div>
                                <table id='Table'>
                                    <tr>
                                        <th>Room Number</th>
                                        <th>Guest ID</th>
                                        <th>Customer Name</th>
                                        <th>Payables</th>
                                        <th>Room Cost</th>
                                        <th>Total Amount</th>
                                        <th>Payment Amount</th>
                                        <th>Action</th>
                                    </tr>";
        
                         $result = mysqli_query($conn, $sql) or die('query did not work');
                            if(mysqli_num_rows($result) > 0){
            
                                while($row = mysqli_fetch_assoc($result)){
                                    echo "
                                    <form action='' method='POST'>
                                        <tr>
                                            <td>".$row["room_id"]."</td> 
                                            <td>".$row["guest_id"]."</td>
                                            <td>".$row["fname"]." ".$row["lname"]."</td>
                                            <td>".$row["payables"]."</td>
                                            <td>".$row["room_cost"]."</td>
                                            <td>".$row["total_amount"]."</td>
                                            <td><input type='number' class='restocknum' name='newPay' value=".$row["payment_amount"].">
                                                <input type='submit' class='Greenbutton1' name='updatePay' value='Update Payment'></td>
                                            <td><input type='submit' class='Checkoutbutton' name='remove' value='Check Out'></td> 
                                        </tr>    
                                            <input type='hidden' name='guestID' value='{$row['guest_id']}'>
                                            <input type='hidden' name='roomID' value='{$row['room_id']}'>
                                            <input type='hidden' name='date' value='{$row['date']}'>
                                            <input type='hidden' name='time' value='{$row['time']}'>
                                            <input type='hidden' name='payAmount' value='{$row['payment_amount']}'>
                                            <input type='hidden' name='totAmount' value='{$row['total_amount']}'>
                                            <input type='hidden' name='change' value='{$row['change']}'>
                                            <input type='hidden' name='payID' value='{$row['guest_id']}'>                               
                                    </form>                        
                                ";
                            }
                                    echo "</table></div>";
                                    unset($_POST['keyword']); 
                                }else{
                                echo "...  Nothing was found that matched your query.  :(( sorry..</table></div><br><br>";
                                }
                        }
                    ?>
            <br>
            <!--the table format in displaying the guests that are about to check out today-->
            <table id="Table">
                <tr>
                    <th>Room Number</th>
                    <th>Guest ID</th>
                    <th>Customer Name</th>
                    <th>Payables</th>
                    <th>Room Cost</th>
                    <th>Total Amount</th>
                    <th>Payment Amount</th>
                    <th>Action</th>
                </tr>
            <?php
                include 'connection.php';
                //the query of the guests who are about to checkout in the current date
                $sql = "SELECT  rooms.room_id, 
                                guests.guest_id, 
                                customers.fname, 
                                customers.lname,
                                SUM(bill_items.quantity * amenities.amenity_price) AS 'payables', 
                                payments.payment_amount as room_cost,
                                SUM(bill_items.quantity * amenities.amenity_price) + payments.payment_amount AS 'total_amount',
                                payments.payment_id,
                                ch.paid_amount as payment_amount,
                                ch.paid_amount - (SUM(bill_items.quantity * amenities.amenity_price) + payments.payment_amount) AS 'change',
                                CURRENT_DATE AS 'date',
                                CURRENT_TIME AS 'time'                                 
                        FROM guests, customers, rooms, room_type, payments, bill, bill_items, amenities,checked_in_guests ch
                        WHERE guests.customer_id = customers.customer_id AND 
                        guests.room_id = rooms.room_id AND 
                        guests.payment_id = payments.payment_id AND 
                        rooms.roomtype_id = room_type.roomtype_id AND 
                        payments.bill_id = bill.bill_id AND
                        bill.bill_id = bill_items.bill_id AND
                        bill_items.amenity_id = amenities.amenity_id AND
                        guests.guest_status = 'INCOMPLETE' AND
                        guests.date_out = CURDATE() AND 
                        ch.guest_id=guests.guest_id
                        GROUP BY guests.guest_id";
                $result = mysqli_query($conn, $sql);
                //to display the query into the table by following the format from above
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "
                        <form action='' method='POST'>
                        <tr>
                            <td>".$row["room_id"]."</td> 
                            <td>".$row["guest_id"]."</td>
                            <td>".$row["fname"]." ".$row["lname"]."</td>
                            <td>".$row["payables"]."</td>
                            <td>".$row["room_cost"]."</td>
                            <td>".$row["total_amount"]."</td>
                            <td><input type='number' class='restocknum' name='newPay' value=".$row["payment_amount"].">
                                <input type='submit' class='Greenbutton1' name='updatePay' value='Update Payment'></td>
                            <td><input type='submit' class='Checkoutbutton' name='remove' value='Check Out'></td> 
                        </tr>    
                            <input type='hidden' name='guestID' value='{$row['guest_id']}'>
                            <input type='hidden' name='roomID' value='{$row['room_id']}'>
                            <input type='hidden' name='date' value='{$row['date']}'>
                            <input type='hidden' name='time' value='{$row['time']}'>
                            <input type='hidden' name='payAmount' value='{$row['payment_amount']}'>
                            <input type='hidden' name='totAmount' value='{$row['total_amount']}'>
                            <input type='hidden' name='change' value='{$row['change']}'>
                            <input type='hidden' name='payID' value='{$row['guest_id']}'>                               
                    </form>                    
                        ";
                    }
                    echo "</table>";
                } else {
                    echo 'No guests are checking out for today.';
                }
                //code for updating the payment
                if(isset($_POST['updatePay'])){
                    $pID = $_POST['payID'];
                    $newPay = $_POST['newPay'];
                    $updatePayment = "UPDATE checked_in_guests SET paid_amount = $newPay WHERE guest_id = $pID";

                    if ($conn->query($updatePayment) === TRUE) {
                        echo "
                            <script language='javascript'>
                                    window.location.href='receptionist_checkout.php';
                            </script>";
                    } else {
                        echo "Error: " .$updatePayment. "<br>" .$conn->error;
                    }
                }
                //code for the checkout
                if(isset($_POST['remove'])){
                    $total = $_POST['totAmount'];
                    $payment = $_POST['payAmount'];
                    $gID = $_POST['guestID'];
                    $rID = $_POST['roomID'];
                    $date = $_POST['date'];
                    $time = $_POST['time'];
                    $change = $_POST['change'];

                    //checks if payment is greater than or equal to the payables
                    if($payment >= $total){
                        $updateGuest = "UPDATE guests SET guest_status = 'Complete' WHERE guest_id = $gID";
                        $updateRoom = "UPDATE rooms SET room_status = 'Available' WHERE room_id = $rID";
                        $newRecord = "UPDATE records 
                                        SET record_type = 'CHECKED OUT',
                                            record_date = '$date',
                                            record_time = '$time',
                                            record_paid = '$payment',
                                            record_payables = '$total',
                                            record_change = '$change'
                                        WHERE guest_id = $gID";
                        $deleteSched = "DELETE FROM schedule WHERE guest_id = $gID";
                        $deleteCheckIn = "DELETE FROM checked_in_guests WHERE guest_id = $gID";
                        //if all the queries are true, it will prompt to the records
                        if ($conn->query($updateGuest) === TRUE && 
                            $conn->query($updateRoom) === TRUE && 
                            $conn->query($newRecord) === TRUE && 
                            $conn->query($deleteSched) === TRUE &&
                            $conn->query($deleteCheckIn) === TRUE) {
                            echo "<script language='javascript'>
                                        window.location.href='receptionist_records.php';
                                </script>";
                        //a simple error exception handling
                        } else if(!$conn->query($updateGuest) === TRUE) {
                            echo "Error: " .$updateGuest. "<br>" .$conn->error;
                        } else if(!$conn->query($updateRoom) === TRUE) {
                            echo "Error: "  .$updateRoom. "<br>" .$conn->error;
                        } else if(!$conn->query($newRecord) === TRUE) {
                            echo "Error: " .$newRecord. "<br>" .$conn->error;
                        } else if(!$conn->query($deleteSched) === TRUE) {
                            echo "Error: " .$deleteSched. "<br>" .$conn->error;
                        } else if(!$conn->query($deleteCheckIn) === TRUE) {
                            echo "Error: " .$deleteCheckIn. "<br>" .$conn->error;
                        }
                    //if payment is not enough, returns to the page itself
                    } else {
                        echo "<script language='javascript'>
                                        window.location.href='receptionist_checkout.php';    
                                </script>";
                    }
                }

            ?>
        </div>
        <script src="dashmodal.js"></script>
    </body>