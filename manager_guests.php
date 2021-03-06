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
                <p>Welcome Manager</p>
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
                <li><a class="navli" href="manager_records.php">Records</a></li>
                <li><a class="navli" href="#">Guests</a></li>
                <li><a class="navli" href="manager_room-mgt.php">Room Management</a></li>
                <li><a class="navli" href="manager_staff.php">Staff Management</a></li>
                <li><a class="navli" href="manager_restock.php">Restock Amenities</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code here for manager guest code-->
            <div class="search-container">
                        <form method="POST">
                        <label class="Labelform">Search Guest Name: </label><input type="text" class="input-search"placeholder="Search.." name="keyword">
                        <button class= "searchbutton"  name="search">Search</button>
                        </form>
                    </div>
                    <?php 
                        include 'connection.php';
                        if (isset($_POST['keyword'])) {
                            $keyword = trim ($_POST['keyword']);

                            $sql1 = "SELECT /**Displays the Guest and their room number */
                                        CONCAT(c.fname, ' ', c.MI, ' ', c.lname) AS 'Guest Name',
                                        c.fname as 'fname',
                                        c.MI as 'mname',
                                        c.lname as 'lname',
                                        r.room_id as 'Room Number', 
                                        g.guest_id AS 'guest_id',
                                        b.bill_id as 'bill_id',
                                        CURDATE() as 'date'
                                    FROM
                                             Guests g, Customers c,
                                            Rooms r,bill b, checked_in_guests ch
                                    WHERE
                                            g.customer_id = c.customer_id AND 
                                            g.room_id = r.room_id AND 
                                            b.guest_id=g.guest_id AND 
                                            ch.guest_id=g.guest_id AND /**Displays the guest depending on the keyword that is being inputted */
                                            g.guest_status = 'INCOMPLETE' AND CONCAT(c.fname, ' ', c.lname) LIKE '%$keyword%'
                                    GROUP BY
                                            g.guest_id /*I grouped it by guest id because it would be group by roomtype_id if isnt guest_id*/ 
                                    ORDER BY
                                            g.date_in;";
                            echo "<br>
                                <div id='SearchTable'>
                                    <div>
                                        <h4 style='float:left;'>Results for \"$keyword\"</h4> <input type='submit' style='float:right;' class='Logoutbutton'  onclick='closeTable()' value='Close Search'>
                                    </div>
                                <table id='Table'>
                                    <tr>
                                        <th>Guest Name</th>
                                        <th>Room Number</th>
                                        <th>Actions</th>
                                        <th>More Info</th>
                                    </tr>";
            
                            $display = $conn->query($sql1) or die('query did not work');

                            if($rows = $display != NULL){ //I didn't put fetch assoc because the first value won't show if the fetch_assoc() is called twice.
                                while($rows = $display->fetch_assoc()){
                                    echo
                                        "<form action='' method='POST'>
                                        <tr><td>". $rows['Guest Name']. "</td>
                                            <td>". $rows['Room Number']. "</td>
                                            <td><button  class='Offerbutton' name='ameneties'>Offer<br>Amenities</a></button>
                                                <button class='Extendbutton' name='extend'>Extend<br>Stay</button>
                                                
                                                <input type='submit' class='Checkoutbutton'  name='checkout' value='Early Checkout'></td>
                                            <td><button class= 'Viewbutton'><a href= 'manager_guestview.php?id=".$rows['guest_id']."'>View</a></button></td></tr>
                                            <input type='hidden' name='Date' value='{$rows['date']}'>
                                            <input type='hidden' name='guest_id' value='{$rows['guest_id']}'>
                                            <input type='hidden' name='bill_id' value='{$rows['bill_id']}'>
                                            <input type='hidden' name='fname' value='{$rows['fname']}'>
                                            <input type='hidden' name='lname' value='{$rows['lname']}'>
                                            <input type='hidden' name='mname' value='{$rows['mname']}'>
                                            
                                            </form>"; 
                                    }
                                    echo "</table></div>";
                                    unset($_POST['keyword']); 
                                }else{
                                echo "Nothing was found that matched your query.<br><br>";
                                }
                        }
                    ?>

            <br>
            <table id="Table">
              <tr>
                <th>Guest Name</th>
                <th>Room Number</th>
                <th>Actions</th>
                <th>More Info</th>
              </tr>

            <?php
                include 'connection.php';
                ob_start();
                
                $sql = "SELECT  s.sched_id AS 'SID',
                                CONCAT(c.fname, ' ', c.MI, ' ', c.lname) AS 'Guest Name',
                                c.fname as 'fname',
                                c.MI as 'mname',
                                c.lname as 'lname',
                                r.room_id as 'Room Number', 
                                g.guest_id AS 'guest_id',
                                b.bill_id as 'bill_id',
                                CURDATE() as 'date'
                        FROM
                                Schedule s, Guests g, Customers c,
                                Rooms r,bill b, checked_in_guests ch
                        WHERE
                                s.guest_id = g.guest_id AND 
                                g.customer_id = c.customer_id AND 
                                s.room_id = r.room_id AND 
                                b.guest_id=g.guest_id AND 
                                ch.guest_id=g.guest_id AND
                                g.guest_status = 'INCOMPLETE'/**Displays the guest with the status as incomplete which means not yet checked-out */
                        GROUP BY
                                g.guest_id 
                        ORDER BY
                                g.date_in;"; //Ordered the table by the dates they checked in

                        $display = $conn->query($sql);


                        if($rows = $display != NULL){
                            while($rows = $display->fetch_assoc()){
                                echo
                                    "<form action='' method='POST'>
                                    <tr><td>". $rows['Guest Name']. "</td>
                                        <td>". $rows['Room Number']. "</td>
                                        <td><button  class='Offerbutton' name='ameneties'>Offer<br>Amenities</a></button>
                                            <button class='Extendbutton' name='extend'>Extend<br>Stay</button>
                                            
                                            <input type='submit' class='Checkoutbutton'  name='checkout' value='Early Checkout'></td>
                                        <td><button class= 'Viewbutton'><a href= 'manager_guestview.php?id=".$rows['SID']."'>View</a></button></td></tr>
                                        <input type='hidden' name='Date' value='{$rows['date']}'>
                                        <input type='hidden' name='guest_id' value='{$rows['guest_id']}'>
                                        <input type='hidden' name='bill_id' value='{$rows['bill_id']}'>
                                        <input type='hidden' name='fname' value='{$rows['fname']}'>
                                        <input type='hidden' name='lname' value='{$rows['lname']}'>
                                        <input type='hidden' name='mname' value='{$rows['mname']}'>
                                        
                                        </form>"; 
                                }
                                echo "</table>";
                            }else{
                            echo "No guest checked-in. ";
                            }

                if(isset($_POST['extend'])){
                    $guest_id=$_POST['guest_id'];
                    $_SESSION['guest_id']=$guest_id;
                    $_SESSION['customer_id']=$customer_id;
                    header("location:manager_extend.php");
                    } 

                    if(isset($_POST['checkout'])){
                        $guest_id = $_POST['guest_id'];
                        $date = $_POST['Date'];
                        
                        $updateDate = " UPDATE guests 
                                        SET date_out = '$date'
                                        WHERE guest_id = $guest_id";
                    
                            if ($conn->query($updateDate) === TRUE) {
                                echo "<script language='javascript'>
                                            window.location.href='manager_checkout.php';
                                    </script>";
                            } else {
                                echo "Error: " .$updateDate. "<br>" .$conn->error;
                            }
                    }



                    if(isset($_POST['ameneties'])){
                    $guest_id=$_POST['guest_id'];
                    $bill_id=$_POST['bill_id'];
                    $fname=$_POST['fname'];
                    $mname=$_POST['mname'];
                    $lname=$_POST['lname'];

                    $_SESSION['guest_id']=$guest_id;
                    $_SESSION['bill_id']=$bill_id;
                    $_SESSION['fname']=$fname;
                    $_SESSION['mname']=$mname;
                    $_SESSION['lname']=$lname;






                    header("location:manager_ameneties.php");
                    }


                    ob_end_flush();
                    $conn->close();        
                ?>
        </div>

        <script src="dashmodal.js"></script>
    </body>
