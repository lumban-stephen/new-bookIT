<?php
   session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Receptionist Template</title>
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
                <p>Welcome Receptionist  </p>
            </div>
        </div>
        </header>
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
            <?php
            echo "<form method='post' action='' enctype='multipart/form-data' class='checkingrid'>  
            <span class='checkinbox1'>
                <label class='Labelform'>First Name</label><input type='text' class='booking' id='fname' name='fname'></span>
            <span class='checkinbox2'>
                <label class='Labelform'>Last Name</label><input type='text' class='booking' id='lname' name='lname'></span>
            <span class='checkinbox3'>
                <label class='Labelform'>Middle Name</label><input type='text' class='booking' id='mname' name='mname'></span>
            <span class='checkinbox4'>
                <label class='Labelform'>Check-in</label><div class='booking' id='checkin'>" .$_SESSION['checkin']."</div></span>
            <span class='checkinbox5'>
                <label class='Labelform'>Check-out</label><div class='booking' id='checkout'>" .$_SESSION['checkout']."</div></span>
            <span class='checkinbox6'>
                <label class='Labelform'>Number of Guests</label><div class='booking' id='numguest'>" .$_SESSION['numguest']."</div></span>
            <span class='checkinbox7'>
                <label class='Labelform'>Room Selected</label><div class='booking' id='room_id'>" .$_SESSION['room_id']."</div></span>
            <span class='checkinbox8'>
                <label class='Labelform'>Phone Number</label><input type='number' class='booking' id='phone' name='phone'></span>
            <span class='checkinbox9'>
                <label class='Labelform'>E-mail</label><input type='email' class='booking' id='email'name='email'></span>
            <span class='checkinbox10'>
             <label class='Labelform'>ID Type</label><select class='booking' id='id_type' name='id_type' >
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
                </select></span>
            <span class='checkinbox11'>
                <label class='Labelform'>ID_number</label><input type='text' class='booking' id='id_num' name='ID_number' class='button' ></span>
            <span class='checkinbox12'>
                <label class='Labelform'>File Upload</label><input type='file' id='file' class='booking' name='file'></span>
            <span class='checkinbox13'>
                <label class='Labelform'>Address</label><input type='text' class='booking' id='address' name='address' class='button'></span>
                <br>
                <input type='submit'  name='amenities2' value='Proceed to Amenities' class='Greenbutton'>
                <input type='submit' name='cancel' value='Cancel Check-in' class='Checkoutbutton'></span>
                <br>
            </form>";                    ?>
        </div>
    </body>