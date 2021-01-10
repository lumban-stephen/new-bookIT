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
            <!--Code Here only-->
            <!--receptionist check in form page code in here-->

             <?php
            include 'connection.php';
            //error_reporting(0);
ob_start();

            echo "<form method='post' action='' enctype='multipart/form-data' class='checkingrid'>  
                <span class='checkinbox1'>
                <label class='Labelform'>First Name</label><div class='booking' id='fname'>".$_SESSION['fname']."</div></span>
                <span class='checkinbox2'>
                <label class='Labelform'>Last Name</label><div class='booking'id='lname'>".$_SESSION['lname']."</div></span>
                <span class='checkinbox3'>
                <label class='Labelform'>Middle Name</label><div class='booking' id='mname'>".$_SESSION['mname']."</div></span>
                <span class='checkinbox4'>
                <label class='Labelform'>Check-in</label><div class='booking' id='checkin'>".$_SESSION['checkin']."</div></span>
                <span class='checkinbox5'>
                <label class='Labelform'>Check-out</label><div class='booking' id='checkout'>".$_SESSION['checkout']."</div></span>
                <span class='checkinbox6'>
                <label class='Labelform'>Number of Guests</label><div class='booking' id='numguest'>" .$_SESSION['numguest']."</div></span>
                <span class='checkinbox7'>
                <label class='Labelform'>Room Selected</label><div class='booking' id='room_id'>" .$_SESSION['room_id']."</div></span>
                <span class='checkinbox8'>
                <label class='Labelform'>Phone Number</label><div class='booking' id='phone'>".$_SESSION['phone']."</div></span>
                <span class='checkinbox9'>
                <label class='Labelform'>E-mail</label><div class='booking' id='email'>".$_SESSION['email']."</div></span>
                <span class='checkinbox10'>
                <label class='Labelform'>ID Type</label><select name='id_type' id='id_type' class='booking' required>
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
                <label class='Labelform'>ID_number</label><input type='text' name='ID_number'id='id_num' class='booking' required></span>
                <span class='checkinbox12'>
                <label class='Labelform'>File Upload</label><input type='file' id='file' class='booking' name='file'></span>
                <span class='checkinbox13'>
                <label class='Labelform'>Address</label><input type='text' id='address'name='address' class='booking' required></span>
                <br><br>
                <input type='submit' name='amenities1' value='Proceed to Amenities' class='Greenbutton'>
                <a class='Checkoutbutton' href='receptionist_res-list.php' style='margin: auto;'>Cancel Check-in</a>
                <br><br>
            </form>";


    if(isset($_POST['amenities1'])){
        $id_type = $_POST['id_type'];
        $ID_number = $_POST['ID_number'];
        $address = $_POST['address'];

        $files = $_FILES['file'];
        $filename = $files['name'];
        $tmp = $files['tmp_name'];
        $location = 'assets/'.$filename;

        move_uploaded_file($tmp,$location);

        //insert address to cuctomers table
        $prepare1= $conn->prepare("UPDATE customers SET address =? WHERE customer_id=?");
        $prepare1->bind_param("si", $address, $_SESSION['customer_id']);
        $prepare1->execute();

        //insert ID details to guests table
        $status = "INCOMPLETE"; //since this came from the res-list then we change the RESERVED status to INCOMPLETE
        $prepare2= $conn->prepare("UPDATE guests SET ID_type =?, ID_number=?, files=?, guest_status=? WHERE customer_id=?");
        $prepare2->bind_param("ssssi", $id_type,$ID_number, $filename,$status, $_SESSION['customer_id']);
        $prepare2->execute();

        //create data in checked-in-guests
        $prepare3= $conn->prepare("INSERT INTO checked_in_guests(guest_id) VALUES (?)");
        $prepare3->bind_param("i", $_SESSION['guest_id']);
        $prepare3->execute();

        //insert status rooms
        $room_status="Used by guest";
        $prepare4= $conn->prepare("UPDATE rooms SET room_status=? WHERE room_id=?");
        $prepare4->bind_param("si",$room_status, $_SESSION['room_id']);
        $prepare4->execute();

    //insert data in records
            $record_type="STAYING";
            $prepare5 = $conn->prepare("INSERT INTO records(record_type,record_date,record_time,guest_id) VALUES (?,?,?,?)");
            $prepare5->bind_param("sssi",$record_type,$_SESSION['checkin'],$time,$_SESSION['guest_id']);
            $prepare5->execute();

         header("location:receptionist_ameneties.php");
    }


ob_end_flush();
?>

                
        </div>
    </body>
