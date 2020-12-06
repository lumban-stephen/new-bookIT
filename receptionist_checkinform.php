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
                <li><a href="receptionist_guests.php">Guests</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code Here only-->
            <!--receptionist check in form page code in here-->

            <?php
            include 'connection.php';
            //error_reporting(0);

            echo "<form method='post' action=''>  
                <label>First Name</label><br>".$_SESSION['fname']."
                <br><br>

                <label>Last Name</label><br>".$_SESSION['lname']."
                <br><br>

                <label>Middle Name</label><br>".$_SESSION['mname']."
                <br><br>

                <label>Check-in</label><br>".$_SESSION['checkin']."
                <br><br>

                <label>Check-out</label><br>".$_SESSION['checkout']."
                <br><br>

                <label>Number of Guests</label><br>".$_SESSION['numguest']."
                <br><br>

                <label>Room Selected</label><br>".$_SESSION['room_code']."
                <br><br>

                <label>Phone Number</label><br>".$_SESSION['phone']."
                <br><br>

                <label>E-mail</label><br>".$_SESSION['email']."
                <br><br>

             <label>ID Type</label>
                <select name='roomtype' class='button'>
                <option value='Select'>Select</option>
                <option value='passport'>passport</option>
                <option value='driver license'>driver license</option>
                <option value='PhilHealth'>PhilHealth</option>
                <option value='SSS UMID'>SSS UMID</option>
                <option value='POSTAL'>POSTAL</option>
                <option value='TIN'>TIN</option>
                <option value='SENIOR CITIZEN'>SENIOR CITIZEN</option>
                <option value='OFW'>OFW</option>
                <option value='OTHERS'>OTHERS</option>
                </select>
                <br><br>

                <label>ID_number</label>
                <input type='text' name='ID_number' class='button' >
                <br><br>

                <label>File Upload</label>
                <input type='file' name='file'>
                <br><br>
                <label>Address</label>
                <input type='text' name='address' class='button' >
                <br><br>
                <input type='submit' name='checkin' value='CHECKIN' class='submit'>
                <br><br>

            </form>";

?>

                
        </div>
    </body>