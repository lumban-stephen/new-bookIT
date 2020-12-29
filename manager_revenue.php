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
                <li id="logoli"><img src="assets/bookIT_Logo.png"></li>
                <li><a class="navli" href="manager_dashboard.php">Dashboard</a></li>
                <li><a class="navli" href="#">Revenue</a></li>
                <li><a class="navli" href="manager_records.php">Records</a></li>
                <li><a class="navli" href="manager_guests.php">Guests</a></li>
                <li><a class="navli" href="manager_room-mgt.php">Room Management</a></li>
                <li><a class="navli" href="manager_staff.php">Staff Management</a></li>
                <li><a class="navli" href="manager_restock.php">Restock Amenities</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code here for manager revenue page code-->
            <form action='' method='POST'>
                <h2>
                    <label class="Labelform-Rev" for='week'>Week: </label><input type='number' class="input-Rev"  name='week' id='weekly' min='1' max='53'>
                    <label class="Labelform-Rev" for='month'>Month: </label><input type='number' class="input-Rev" name='month' id='monthly' min='1' max='12'>
                    <label class="Labelform-Rev" for='year'>Year: </label><input type='number' class="input-Rev" name='year' id='yearly' min='2000' max='2021'>
                    <input type='submit' class="searchbutton" name='search' value='Search'>
                </h2>
            </form>
            <br><br>

            <?php
                include 'connection.php';
                //error_reporting(0);

                if(isset($_POST['search'])){
                    $month = $_POST['month'];
                    $year = $_POST['year'];
                    $week = $_POST['week'];                

                    echo "Week: ".$week." Month: ".$month." Year: ".$year."";
                    echo "<br><br>";
                    echo "<div class='grid-container'>";

                    if($week != null){
                        $sql3 = "SELECT SUM(record_paid) as weekly
                                FROM    records
                                WHERE   WEEK(record_date) = $week AND
                                        record_type = 'CHECKED OUT'";
                        $result3 = $conn->query($sql3);
                        while($row3 = $result3->fetch_assoc()){
                            echo "<button type='submit' name='select' style='background-color: #FEC200; padding: 20px;' class='button'><p>weekly</p><h1>".$row3['weekly']."</h1></button>";   
                        }
                    } else {
                        $sql3 = "SELECT SUM(record_paid) as weekly
                                FROM    records
                                WHERE   WEEK(record_date) = WEEK(CURDATE()) AND
                                        record_type = 'CHECKED OUT'";
                        $result3 = $conn->query($sql3);
                        while($row3 = $result3->fetch_assoc()){
                            echo "<button type='submit' name='select' style='background-color: #FEC200; padding: 20px;' class='button'><p>weekly</p><h1>".$row3['weekly']."</h1></button>";   
                        }
                    }
                    
                    if($month != null){
                        $sql1 = "SELECT SUM(record_paid) as monthly
                                FROM    records
                                WHERE   MONTH(record_date) = $month AND
                                        record_type = 'CHECKED OUT'";
                        $result1 = $conn->query($sql1);
                        while($row1 = $result1->fetch_assoc()){
                            echo "<button type='submit' name='select' style='background-color: #E35D40; padding: 20px;' class='button'><p>monthly</p><h1>".$row1['monthly']."</h1></button>";   
                        }
                    } else {
                        $sql1 = "SELECT SUM(record_paid) as monthly
                                FROM    records
                                WHERE   MONTH(record_date) = MONTH(CURDATE()) AND
                                        record_type = 'CHECKED OUT'";
                        $result1 = $conn->query($sql1);
                        while($row1 = $result1->fetch_assoc()){
                            echo "<button type='submit' name='select' style='background-color: #E35D40; padding: 20px;' class='button'><p>monthly</p><h1>".$row1['monthly']."</h1></button>";   
                        }
                    }

                    if($year != null){
                        $sql2 = "SELECT SUM(record_paid) as yearly
                                FROM    records
                                WHERE   YEAR(record_date) = $year AND
                                        record_type = 'CHECKED OUT'";
                        $result2 = $conn->query($sql2);
                        while($row2 = $result2->fetch_assoc()){
                            echo "<button type='submit' name='select' style='background-color: #C70039; padding: 20px; grid-column: 1 / span 2;' class='button'><p>yearly</p><h1>".$row2['yearly']."</h1></div>";   
                        }
                    } else {
                        $sql2 = "SELECT SUM(record_paid) as yearly
                                FROM    records
                                WHERE   YEAR(record_date) = YEAR(CURDATE()) AND
                                        record_type = 'CHECKED OUT'";
                        $result2 = $conn->query($sql2);
                        while($row2 = $result2->fetch_assoc()){
                            echo "<button type='submit' name='select' style='background-color: #C70039; padding: 20px; grid-column: 1 / span 2;' class='button'><p>yearly</p><h1>".$row2['yearly']."</h1></div>";   
                        }
                    }                        
                }                 
                echo "</div>"
            ?>            
    </div>
</body>
