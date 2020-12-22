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
        <style type="text/css">
            .grid-container {
            display: grid;
            grid-template-columns: auto auto;
            grid-gap: 10px;
            padding: 10px;
            grid-auto-rows: minmax(200px, auto);
            }

        </style>
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
                <li><a href="manager_dashboard.php">Dashboard</a></li>
                <li><a href="#">Revenue</a></li>
                <li><a href="manager_records.php">Records</a></li>
                <li><a href="manager_guests.php">Guests</a></li>
                <li><a href="manager_room-mgt.php">Room Management</a></li>
                <li><a href="manager_staff.php">Staff Management</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code here for manager revenue page code-->
            <form action='' method='POST'>
                <label for='month'>Month: </label>
                <input type='number' name='month' id='monthly' min='1' max='12' required>
                <label for='year'>Year: </label>
                <input type='number' name='year' id='yearly' min='2000' max='2021' required>
                <input type='submit' name='search' value='Search'>
                <input type='hidden' name='month' value='monthly'>
                <input type='hidden' name='year' value='yearly'>
            </form>
            <?php
            include 'connection.php';
            //error_reporting(0);
            if(isset($_POST['search'])){
                $month = $_POST['month'];
                $year = $_POST['year'];
                
                echo "<div class='grid-container'>";
                $week=date("W");
                $sql3 = "SELECT COUNT(guest_id) as weekly
                        FROM guests
                        WHERE WEEK(date_in)=$week";
                        $result3 = $conn->query($sql3);
                        while($row3 = $result3->fetch_assoc()){
                            echo "<button type='submit' name='select' style='background-color: #FEC200; padding: 10px;' class='button'><p>weekly</p><h1>".$row3['weekly']."</h1></button>";   
                        }


                    
                $sql1 = "SELECT SUM(record_paid) AS 'monthly'
                                
                        FROM    records
                        WHERE   MONTH(record_date) = '$month' AND
                                record_type = 'CHECKED OUT'";
                        $result1 = $conn->query($sql1);
                        while($row1 = $result1->fetch_assoc()){
                            echo "<button type='submit' name='select' style='background-color: #E35D40; padding: 10px;' class='button'><p>monthly</p><h1>".$row1['monthly']."</h1></button>";   
                        }

                
                $sql2 = "SELECT SUM(record_paid) AS 'yearly'
                                
                        FROM    records
                        WHERE   YEAR(record_date) = '$year' AND
                        record_type = 'CHECKED OUT'";
                        $result2 = $conn->query($sql2);
                        while($row2 = $result2->fetch_assoc()){
                            echo "<button type='submit' name='select' style='background-color: #C70039; padding: 10px; grid-column: 1 / span 2;' class='button'><p>yearly</p><h1>".$row2['yearly']."</h1></div>";   
                        }                          
                echo "</div>";
            }

            
            ?>
        </div>
</body>
