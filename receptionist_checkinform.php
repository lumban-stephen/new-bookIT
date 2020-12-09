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

//if this page is from reservation and booking
            if(isset($_SESSION['fname'])){
            echo "<form method='post' action='' enctype='multipart/form-data'>  
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
                <select name='id_type' class='button'>
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
                <input type='submit' name='amenities1' value='Proceed to Amenities' class='submit'>

                <input type='submit' name='cancel' value='Cancel Check-in' class='submit'>
                <br><br>

            </form>";}

//if this is from check in
        else{
        echo "<form method='post' action='' enctype='multipart/form-data'>  
                <label>First Name</label>
                <input type='text' name='fname' class='button' required>
                <br><br>

                <label>Last Name</label>
                <input type='text' name='lname' class='button' required>
                <br><br>

                <label>Middle Name</label>
                <input type='text' name='mname' class='button' >
                <br><br>

                <label>Check-in</label><br>".$_SESSION['checkin']."
                <br><br>

                <label>Check-out</label><br>".$_SESSION['checkout']."
                <br><br>

                <label>Number of Guests</label><br>".$_SESSION['numguest']."
                <br><br>

                <label>Room Selected</label><br>".$_SESSION['room_code']."
                <br><br>

                <label>Phone Number</label><input type='number' name='phone' class='button'>
                <br><br>

                <label>E-mail</label><input type='email' name='email' class='button'>
                <br><br>

             <label>ID Type</label>
                <select name='id_type' class='button'>
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
                <input type='submit' name='amenities2' value='Proceed to Amenities' class='submit'>

                <input type='submit' name='cancel' value='Cancel Check-in' class='submit'>
                <br><br>

            </form>";                


            }

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
        $prepare2= $conn->prepare("UPDATE guests SET ID_type =?, ID_number=?, files=? WHERE customer_id=?");
        $prepare2->bind_param("sssi", $id_type,$ID_number, $filename, $_SESSION['customer_id']);
        $prepare2->execute();

        //create data in checked-in-guests
        $prepare3= $conn->prepare("INSERT INTO checked_in_guests(guest_id,room_id,roomtype_id,payment_id) VALUES (?,?,?,?)");
        $prepare3->bind_param("iiii", $_SESSION['guest_id'], $_SESSION['room_id'], $_SESSION['roomtype_id'], $_SESSION['payment_id']);
        $prepare3->execute();

        //insert guest_id rooms
        $room_status="Used by guest";
        $prepare4= $conn->prepare("UPDATE rooms SET guest_id =?,room_status=? WHERE room_id=?");
        $prepare4->bind_param("isi", $guest_id,$room_status, $_SESSION['room_id']);
        $prepare4->execute();

        //unset($_SESSION['customer_id']);
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
        unset($_SESSION['guest_id']);
        unset($_SESSION['room_id']);
        unset($_SESSION['roomtype_id']);
        unset($_SESSION['payment_id']);

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

        $id_type = $_POST['id_type'];
        $ID_number = $_POST['ID_number'];
                
        $files = $_FILES['file'];
        $filename = $files['name'];
        $tmp = $files['tmp_name'];
        $location = 'assets/'.$filename;

        move_uploaded_file($tmp,$location);

        $stays=(strtotime($_SESSION['checkout'])-strtotime($_SESSION['checkin']))/60/60/24; //number of stays

        //get room_id
        $sql = "SELECT r.room_id AS room_id, t.room_cost AS room_cost,t.roomtype_id AS roomtype_id
                FROM rooms r,room_type t
                WHERE r.roomtype_id = t.roomtype_id AND 
                t.room_code='{$_SESSION['room_code']}'";
                $result = $conn->query($sql);

                while($row = $result->fetch_assoc()){
                        $room_id = $row['room_id'];
                        $room_cost = $row['room_cost'];
                        $roomtype_id = $row['roomtype_id'];
                }

                $payment = $stays*$room_cost;  //total cost

            //create data in customers
                $prepare1 = $conn->prepare("INSERT INTO customers(fname,lname,MI,email,phone,address) VALUES (?,?,?,?,?,?)");
            $prepare1->bind_param("ssssss",$fname,$lname,$mname,$email,$phone,$address);
            $prepare1->execute();

            //get customer_id ($conn->insert_id : get the last generated id)
            $customer_id = $conn->insert_id;
            
            
            //create data in guests
            $prepare2 = $conn->prepare("INSERT INTO guests(date_in,date_out,guests_count,room_id,customer_id,roomtype_id,ID_type , ID_number, files) VALUES (?,?,?,?,?,?,?,?,?)");
            $prepare2->bind_param("ssiiiisss",$_SESSION['checkin'],$_SESSION['checkout'],$_SESSION['numguest'],$room_id,$customer_id,$roomtype_id,$id_type,$ID_number, $filename,);
            $prepare2->execute();

            //get guest_id ($conn->insert_id : get the last generated id)
            $guest_id = $conn->insert_id;


            //create data in schedule
            $prepare3 = $conn->prepare("INSERT INTO schedule(guest_id,customer_id,room_id,roomtype_id) VALUES (?,?,?,?)");
            $prepare3->bind_param("iiii",$guest_id,$customer_id,$room_id,$roomtype_id);
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
            $prepare6 = $conn->prepare("INSERT INTO bill(bill_date,subtotal,payment_id,guest_id) VALUES (?,?,?,?)");
            $prepare6->bind_param("siii",$_SESSION['checkin'],$payment,$payment_id,$guest_id);
            $prepare6->execute();

            //get bill_id ($conn->insert_id : get the last generated id)
            $bill_id= $conn->insert_id;

            //create data in bill_items
            $prepare7 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,roomtype_id) VALUES (?,?,?,?)");
            $prepare7->bind_param("iisi",$stays,$bill_id,$_SESSION['checkin'],$roomtype_id);
            $prepare7->execute();


            //create data in checked-in-guests
            $prepare8= $conn->prepare("INSERT INTO checked_in_guests(guest_id,room_id,roomtype_id,payment_id) VALUES (?,?,?,?)");
            $prepare8->bind_param("iiii", $_SESSION['guest_id'], $_SESSION['room_id'], $_SESSION['roomtype_id'], $_SESSION['payment_id']);
           $prepare8->execute();

        //create data in checked-in-guests
        $prepare9= $conn->prepare("INSERT INTO checked_in_guests(guest_id,room_id,roomtype_id,payment_id) VALUES (?,?,?,?)");
        $prepare9->bind_param("iiii", $guest_id, $room_id, $roomtype_id, $payment_id);
        $prepare9->execute();

        $room_status="Used by guest";
            //insert guest_id rooms
        $prepare10= $conn->prepare("UPDATE rooms SET guest_id =?,room_status=? WHERE room_id=?");
        $prepare10->bind_param("isi", $guest_id,$room_status, $room_id);
        $prepare10->execute();
        
            header("location:receptionist_ameneties.php");

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


?>

                
        </div>
    </body>