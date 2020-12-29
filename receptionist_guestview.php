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
        <a href="receptionist_guests.php">Back to List</a>
<?php
        include 'connection.php';

        $sql = "SELECT g.guest_id AS 'SID', g.guest_id AS 'guest_id', b.bill_id as 'bill_id',
                    c.fname AS 'Firstname', c.MI AS 'Middlename', c.lname AS 'Lastname', c.phone AS 'Phone', c.email AS 'Email',
                    g.date_in AS 'Check-in Date', g.date_out AS 'Check-out Date',
                    r.room_id AS 'Room Number', rt.room_desc AS 'Room Type', c.Address AS 'address',
                    g.guest_status AS 'Guest Status', g.guests_count AS 'Number of Guests'
                FROM
                    Schedule s, Guests g, Customers c,
                     Rooms r, room_type rt, bill b
                WHERE
                     g.customer_id = c.customer_id
                    AND s.room_id = r.room_id AND b.guest_id=g.guest_id AND g.guest_id ='".$_GET['id']."'
                GROUP BY
                    g.guest_id;";


        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){

        echo "<form method='post' action='' enctype='multipart/form-data' class='checkingrid'> 
            <span class='checkinbox1'>
                <label class='Labelform'>Firstname</label><input type='text' class='booking' id='fname' value=\"".$row['Firstname']."\" ></span>
            <span class='checkinbox2'>
                <label class='Labelform'>Lastname</label><input type='text' class='booking' id='lname' value=\"".$row['Lastname']."\"></span>
            <span class='checkinbox3'>
                <label class='Labelform'> Middlename</label><input type='text' class='booking' id='mname' value=\"".$row['Middlename']."\"></span>
            <span class='checkinbox4'>
            <label class='Labelform'>Check-in Date</label><input type='text' class='booking' id='checkin'  value=\"".$row['Check-in Date']."\"></span>
            <span class='checkinbox5'>
            <label class='Labelform'>Check-out Date</label><input type='text' class='booking' id='checkout'  value=\"".$row['Check-out Date']."\"></span>
            <span class='checkinbox6'>
            <label class='Labelform'>Room Number</label><input type='text' class='booking' id='room_id'  value=\"".$row['Room Number']."\"></span>
            <span class='checkinbox7'>
            <label class='Labelform'>Room Description</label><input type='text' class='booking' id='roomdesc'  value=\"".$row['Room Type']."\"></span>
            <span class='checkinbox8'>
            <label class='Labelform'>Guest Status</label><input type='text' class='booking'  id='gueststatus' value=\"".$row['Guest Status']."\"></span>
            <span class='checkinbox9'>
            <label class='Labelform'>Number of Guests</label><input type='text' class='booking' id='numguest' value=\"".$row['Number of Guests']. "\"></span>
            <span class='checkinbox10'>
            <label class='Labelform'>Phone Number</label><input type='text' class='booking' id='phone' value=\"".$row['Phone']."\"></span>
            <span class='checkinbox11'>
            <label class='Labelform'>Email</label><input type='text' class='booking'  id='email' value=\"".$row['Email']."\"></span>
            <span class='checkinbox13'>
                <label class='Labelform'>Address</label><input type='text' id='address'name='address' class='booking' value=\"".$row['address']."\"></span>
                
                <br><br>
            </form>";                
        }
?>
        </div>
    </body>