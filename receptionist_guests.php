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
                <li><a href="receptionist_dashboard.php">Dashboard</a></li>
                <li><a href="receptionist_checkin.php">Check In</a></li>
                <li><a href="receptionist_checkout.php">Check Out</a></li>
                <li><a href="receptionist_reservation.php">Reservation</a></li>
                <li><a href="receptionist_records.php">Records</a></li>
                <li><a href="receptionist_toDoList.php">To Do List</a></li>
                <li><a href="#">Guests</a></li>
            </ul>
        </nav>

        <div id="content">
            <!--Code Here only-->
            <div class="search-container">
                <form action="/action_page.php">
                  <label>Search Guest Name: </label>
                  <input type="text" placeholder="Search.." name="search">
                </form>
            </div>

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
        
            $sql = "SELECT s.sched_id AS 'SID',
                    CONCAT(c.fname, ' ', c.MI, ' ', c.lname) AS 'Guest Name',
                    r.room_id as 'Room Number'
            FROM
                    Schedule s, Guests g, Customers c,
                    Rooms r
            WHERE
                    s.guest_id = g.guest_id AND s.customer_id = c.customer_id
                    AND s.room_id = r.room_id
            GROUP BY
                    g.guest_id /*I grouped it by guest id because it would be group by roomtype_id if isnt guest_id*/ 
            ORDER BY
                    g.date_in;"; //Ordered the table by the dates they checked in

            $display = $conn->query($sql);

    
            if($rows = $display != NULL){ //I didn't put fetch assoc because the first value won't show if the fetch_assoc() is called twice.
                while($rows = $display->fetch_assoc()){
                    echo
                        "<tr><td>". $rows['Guest Name']. "</td>
                             <td>". $rows['Room Number']. "</td>
                             <td><button  class='Offerbutton'><a href='receptionist_ameneties.php'>Offer<br>Amenities</a></button>
                                 <button class='Extendbutton'>Extend<br>Stay</button>
                                 <button class='Checkoutbutton'>Early<br>Checkout</button></td>
                             <td><a class='Viewbutton' href= 'receptionist_guestview.php?id=".$rows['SID']."'>View</a></button></td></tr>"; /*When the button is clicked, it sends the guest ID of the row to guest_view.php*/
                      }
                    echo "</table>";
                }else{
                  echo "No guest checked-in. ";
                }
               $conn->close();        
        ?>
        </div>

    </body>