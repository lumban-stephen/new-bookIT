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
            <p>Welcome Manager,</p>
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
                <li><a class="navli" href="manager_dashboard.php">Dashboard</a></li>
                <li><a class="navli" href="manager_revenue.php">Revenue</a></li>
                <li><a class="navli" href="#">Records</a></li>
                <li><a class="navli" href="manager_guests.php">Guests</a></li>
                <li><a class="navli" href="manager_room-mgt.php">Room Management</a></li>
                <li><a class="navli" href="manager_staff.php">Staff Management</a></li>
                <li><a class="navli" href="manager_restock.php">Restock Amenities</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code here for manager records page code-->


           <h2>Records</h2>
            <br>
            <table id="Table">
              <tr>
                <th>Record Type</th>
                <th>Room Number</th>
                <th>Paid Amount</th>
                <th>Date</th>
                <th>Time</th>
              </tr>

<?php
            include 'connection.php';
            //error_reporting(0);

            $sql = "SELECT  r.room_id as room_id, 
                            rec.record_type as record_type,
                            rec.record_paid as paid_amount, 
                            rec.record_date as record_date, 
                            rec.record_time as record_time
                    FROM    records rec,rooms r,guests g
                    WHERE   g.room_id=r.room_id AND 
                            g.guest_id=rec.guest_id AND
                            rec.record_type = 'CHECKED OUT'
                    ORDER BY rec.record_date";

        $result = $conn->query($sql);


        if($row = $result != NULL){ 
        while($row = $result->fetch_assoc()){
            echo "<tr>
                    <td>".$row['record_type']."</td>
                    <td>".$row['room_id']."</td>
                    <td>".$row['paid_amount']."</td>
                    <td>".$row['record_date']."</td>
                    <td>".$row['record_time']."</td>
                </tr>"; 
            }
                echo "</table>";
        }else{
            echo "No records made. ";
            }
        ?>
            </table>        

        </div>
    </body>
