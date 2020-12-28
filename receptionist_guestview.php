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
                    r.room_id AS 'Room Number', rt.room_desc AS 'Room Type',
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

        echo "<form method='post' action='' enctype='multipart/form-data'>  
                <label class='Labelform'>Guest Name</label><input type='text' class='booking' value=\"".$row['Firstname']."\" >
                <label class='Labelform'>Guest Name</label><input type='text' class='booking' value=\"".$row['Middlename']."\">
                <label class='Labelform'>Guest Name</label><input type='text' class='booking' value=\"".$row['Lastname']."\">
                <br>
                <label class='Labelform'>Phone Number</label><input type='text' class='booking'  value=\"".$row['Phone']."\">
                <label class='Labelform'>Email</label><input type='text' class='booking'  value=\"".$row['Email']."\">
                <br>
                <label class='Labelform'>Check-in Date</label><input type='text' class='booking'  value=\"".$row['Check-in Date']."\">
                <label class='Labelform'>Check-out Date</label><input type='text' class='booking'  value=\"".$row['Check-out Date']."\">
                <br><br>
                <label class='Labelform'>Room Number</label><input type='text' class='booking'  value=\"".$row['Room Number']."\">
                <label class='Labelform'>Room Description</label><input type='text' class='booking'  value=\"".$row['Room Type']."\">
                <br><br>
                <label class='Labelform'>Guest Status</label><input type='text' class='booking'  value=\"".$row['Guest Status']."\">
                <label class='Labelform'>Number of Guests</label><input type='text' class='booking'  value=\"".$row['Number of Guests']. "\">
                <br><br>
            </form>";                
        }
?>
        </div>
    </body>