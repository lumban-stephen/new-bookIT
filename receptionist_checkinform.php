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
//if this page is from reservation list
            if(isset($_SESSION['list'])){
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
                <input type='submit' name='cancel' value='Cancel Check-in' class='Checkoutbutton'>
                <br><br>
            </form>";
            unset($_SESSION['list']);
        }

//if this is from check in
        else if(isset($_SESSION['from_checkin'])){
            echo "<form method='post' action='' enctype='multipart/form-data' class='checkingrid'>  
            <span class='checkinbox1'>
                <label class='Labelform'>First Name</label><input type='text' class='booking' id='fname' name='fname' required></span>
            <span class='checkinbox2'>
                <label class='Labelform'>Last Name</label><input type='text' class='booking' id='lname' name='lname' required></span>
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
             <label class='Labelform'>ID Type</label><select class='booking' id='id_type' name='id_type' required>
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
                <label class='Labelform'>ID_number</label><input type='text' class='booking' id='id_num' name='ID_number' class='button'  required></span>
            <span class='checkinbox12'>
                <label class='Labelform'>File Upload</label><input type='file' id='file' class='booking' name='file'></span>
            <span class='checkinbox13'>
                <label class='Labelform'>Address</label><input type='text' class='booking' id='address' name='address' class='button' required></span>
                <br>
                <input type='submit'  name='amenities2' value='Proceed to Amenities' class='Greenbutton'>
                <input type='submit' name='cancel' value='Cancel Check-in' class='Checkoutbutton'></span>
                <br>
            </form>";                
        unset($_SESSION['from_checkin']);

            }
//if this is from reservation list
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
        $prepare2->bind_param("sssi", $id_type,$ID_number, $filename, $_SESSION['customer_id'], $status);
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



        unset($_SESSION['customer_id']);
        //unset($_SESSION['fname']);
        unset($_SESSION['room_code']);
        //unset($_SESSION['lname']);
        //unset($_SESSION['mname']);
        unset($_SESSION['phone']);
        unset($_SESSION['email']);
        unset($_SESSION['checkin']);
        unset($_SESSION['checkout']);
        unset($_SESSION['numguest']);
        unset($_SESSION['room_code']);
        //unset($_SESSION['guest_id']);
        unset($_SESSION['room_id']);
        unset($_SESSION['roomtype_id']);
        //unset($_SESSION['payment_id']);

         header("location:receptionist_ameneties.php");
    }

//from checkin to amenities
    if(isset($_POST['amenities2'])){
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $mname=$_POST['mname'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $address = $_POST['address'];

        $_SESSION['fname']=$fname;
        $_SESSION['lname']=$lname;
        $_SESSION['mname']=$mname;

        $id_type = $_POST['id_type'];
        $ID_number = $_POST['ID_number'];
                
        $files = $_FILES['file'];
        $filename = $files['name'];
        $tmp = $files['tmp_name'];
        $location = 'assets/'.$filename;

        move_uploaded_file($tmp,$location);

        $stays=(strtotime($_SESSION['checkout'])-strtotime($_SESSION['checkin']))/60/60/24; //number of stays

        //get data in room_type
        $sql = "SELECT t.room_cost as room_cost
                FROM rooms r,room_type t
                WHERE r.roomtype_id = t.roomtype_id AND 
                r.room_id='{$_SESSION['room_id']}'";
                $result = $conn->query($sql);

                while($row = $result->fetch_assoc()){
                        $room_cost = $row['room_cost'];
                }

                $payment = $stays*$room_cost;  //total cost

            //create data in customers
                $prepare1 = $conn->prepare("INSERT INTO customers(fname,lname,MI,email,phone,address) VALUES (?,?,?,?,?,?)");
            $prepare1->bind_param("ssssss",$fname,$lname,$mname,$email,$phone,$address);
            $prepare1->execute();

            //get customer_id ($conn->insert_id : get the last generated id)
            $customer_id = $conn->insert_id;
            
            
            //create data in guests
            $prepare2 = $conn->prepare("INSERT INTO guests(date_in,date_out,guests_count,room_id,customer_id,ID_type , ID_number, files) VALUES (?,?,?,?,?,?,?,?)");
            $prepare2->bind_param("ssiiisss",$_SESSION['checkin'],$_SESSION['checkout'],$_SESSION['numguest'],$_SESSION['room_id'],$customer_id,$id_type,$ID_number, $filename,);
            $prepare2->execute();
            //get guest_id ($conn->insert_id : get the last generated id)
            $guest_id = $conn->insert_id;
            $_SESSION['guest_id']=$guest_id;


            //create data in schedule
            $prepare3 = $conn->prepare("INSERT INTO schedule(guest_id,room_id) VALUES (?,?)");
            $prepare3->bind_param("ii",$guest_id,$_SESSION['room_id']);
            $prepare3->execute();


            //create data in payments
            $prepare4 = $conn->prepare("INSERT INTO payments(payment_amount) VALUES (?)");
            $prepare4->bind_param("i",$payment);
            $prepare4->execute();

            //get payment_id ($conn->insert_id : get the last generated id)
            $payment_id= $conn->insert_id;

            //insert payment_id to guests
            $prepare5= $conn->prepare("UPDATE guests SET payment_id =? WHERE guest_id=?");
            $prepare5->bind_param("ii", $payment_id, $guest_id);
            $prepare5->execute();

            //create data in bill
            $prepare6 = $conn->prepare("INSERT INTO bill(bill_date,guest_id) VALUES (?,?)");
            $prepare6->bind_param("si",$_SESSION['checkin'],$guest_id);
            $prepare6->execute();

            //get bill_id ($conn->insert_id : get the last generated id)
            $bill_id= $conn->insert_id;
            $_SESSION['bill_id']=$bill_id;

            //insert bill_id to payments
            $prepare12= $conn->prepare("UPDATE payments SET bill_id =? WHERE payment_id=?");
            $prepare12->bind_param("ii", $bill_id, $payment_id);
            $prepare12->execute();

            //create data in bill_items
            $q=1;
            $amenity=100;
            $prepare7 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $prepare7->bind_param("iisi",$q,$bill_id,$_SESSION['checkin'],$amenity);
            $prepare7->execute();
                        

        //create data in checked-in-guests
        $prepare9= $conn->prepare("INSERT INTO checked_in_guests(guest_id) VALUES (?)");
        $prepare9->bind_param("i", $guest_id);
        $prepare9->execute();

        $room_status="Used by guest";
    //change room_status rooms
        $prepare10= $conn->prepare("UPDATE rooms SET room_status=? WHERE room_id=?");
        $prepare10->bind_param("si",$room_status, $_SESSION['room_id']);
        $prepare10->execute();

    //insert data in records
        $time=date("h:i:s");
        $record_type="STAYING";
        $prepare11 = $conn->prepare("INSERT INTO records(record_type,record_date,record_time,guest_id) VALUES (?,?,?,?)");
        $prepare11->bind_param("sssi",$record_type,$_SESSION['checkin'],$time,$guest_id);
        $prepare11->execute();
        
            header("location:receptionist_ameneties.php");

        //unset($_SESSION['customer_id']);
        //unset($_SESSION['fname']);
        //unset($_SESSION['lname']);
        //unset($_SESSION['mname']);
        //unset($_SESSION['phone']);
        //unset($_SESSION['email']);
        unset($_SESSION['checkin']);
        unset($_SESSION['checkout']);
        unset($_SESSION['numguest']);
        unset($_SESSION['room_code']);
        //unset($_SESSION['guest_id']);
        unset($_SESSION['room_id']);
        //unset($_SESSION['roomtype_id']);
        //unset($_SESSION['payment_id']);

            }

//cancel check in
    if(isset($_POST['cancel'])){
        unset($_SESSION['customer_id']);
        unset($_SESSION['fname']);
        unset($_SESSION['room_code']);
        unset($_SESSION['lname']);
        unset($_SESSION['mname']);
        unset($_SESSION['phone']);
        unset($_SESSION['email']);
        unset($_SESSION['checkin']);
        unset($_SESSION['checkout']);
        unset($_SESSION['numguest']);
        unset($_SESSION['room_code']);
        header("location:receptionist_dashboard.php");}

ob_end_flush();
?>

                
        </div>
    </body>
