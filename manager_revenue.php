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
                <li><a href="manager_dashboard.php">Dashboard</a></li>
                <li><a href="#">Revenue</a></li>
                <li><a href="manager_records.php">Records</a></li>
                <li><a href="manager_guests.php">Guests</a></li>
                <li><a href="manager_room-mgt.php">Room Management</a></li>
                <li><a href="manager_staff.php">Staff Management</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code here for manager revenue page code
            weekly
            $year=date("y");
            
            $week=date("y");
            -->

            <?php
            include 'connection.php';
            //error_reporting(0);
            $month=date("m");
        $sql1 = "SELECT COUNT(guest_id) as monthly
                FROM guests
                WHERE MONTH(date_in)=$month";
                $result1 = $conn->query($sql1);
                while($row1 = $result1->fetch_assoc()){
                    echo "monthly".$row1['monthly'];   
                }

        $year=date("Y");
        $sql2 = "SELECT COUNT(guest_id) as yearly
                FROM guests
                WHERE YEAR(date_in)=$year";
                $result2 = $conn->query($sql2);
                while($row2 = $result2->fetch_assoc()){
                    echo "<br>yearly".$row2['yearly'];   
                }

        $week=date("W");
        $sql3 = "SELECT COUNT(guest_id) as weekly
                FROM guests
                WHERE WEEK(date_in)=$week";
                $result3 = $conn->query($sql3);
                while($row3 = $result3->fetch_assoc()){
                    echo "<br>weekly".$row3['weekly'];   
                }
                         

            ?>
        


        </div>
    </body>
