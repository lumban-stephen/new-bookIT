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
                <p>Welcome,</p>
            </div>
            <div class="right-float">
                <a><img></img></a>
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
ob_start();
//if this page is from reservation and booking
            
            echo "<form method='post' action='' enctype='multipart/form-data'>  
                <label>First Name</label><br>".$_SESSION['fname']."
                <input type='text' name='fname' class='button'>
                <button type='submit' name='upfname'  style='background-color: #81B1D5; padding: 5px; ' class='button'>Update</button>
                <br><br>

                <label>Last Name</label><br>".$_SESSION['lname']."<input type='text' name='lname' class='button'>
                <button type='submit' name='uplname'  style='background-color: #81B1D5; padding: 5px; ' class='button'>Update</button>
                <br><br>
                <label>Middle Name</label><br>".$_SESSION['mname']."<input type='text' name='mname' class='button'>
                <button type='submit' name='upmname'  style='background-color: #81B1D5; padding: 5px; ' class='button'>Update</button>
                <br><br>
                <label>Check-in</label><br>".$_SESSION['checkin']."<input type='date' name='upcheckin'>
                <br><br>
                <label>Check-out</label><br>".$_SESSION['checkout']."<input type='date' name='upcheckout'>
                <br><br>
                <label>Number of Guests</label><br>".$_SESSION['numguest']."<select name='numguest'>
    <option value='Select'>Select</option>
    <option value='1'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>  
    </select> 
    <button type='submit' name='upnumguest'  style='background-color: #81B1D5; padding: 5px; ' class='button'>Update</button>
                <br><br>
                <label>Room Selected</label><br>".$_SESSION['room_id']."
                <br><br>
                <label>Phone Number</label><br>".$_SESSION['phone']."<input type='number' name='phone' class='button'>
                <button type='submit' name='upphone'  style='background-color: #81B1D5; padding: 5px; ' class='button'>Update</button>
                <br><br>
                <label>E-mail</label><br>".$_SESSION['email']."<input type='email' name='email' class='button'>
                <button type='submit' name='upemail'  style='background-color: #81B1D5; padding: 5px; ' class='button'>Update</button>
                <br><br>

                <label>Address</label><br>".$_SESSION['address']."<input type='address' name='address' class='button'>
                <button type='submit' name='upaddress'  style='background-color: #81B1D5; padding: 5px; ' class='button'>Update</button>
                <br><br>
             
                <input type='submit' name='update' value='UPDATE' class='submit'>
                <br><br>
            </form>";

if(isset($_POST['upfname'])){
    $fname=$_POST['fname'];
    $prepare= $conn->prepare("UPDATE customers SET fname =? WHERE customer_id=?");
        $prepare->bind_param("si", $fname, $_SESSION['customer_id']);
        $prepare->execute();
    $_SESSION['fname']=$fname;
    header("location:receptionist_update.php");
}

if(isset($_POST['uplname'])){
    $lname=$_POST['lname'];
    $prepare= $conn->prepare("UPDATE customers SET lname =? WHERE customer_id=?");
        $prepare->bind_param("si", $lname, $_SESSION['customer_id']);
        $prepare->execute();
    $_SESSION['lname']=$lname;
    header("location:receptionist_update.php");
}

if(isset($_POST['upmname'])){
    $mname=$_POST['mname'];
    $prepare= $conn->prepare("UPDATE customers SET MI =? WHERE customer_id=?");
        $prepare->bind_param("si", $mname, $_SESSION['customer_id']);
        $prepare->execute();
    $_SESSION['mname']=$mname;
    header("location:receptionist_update.php");
}

if(isset($_POST['upphone'])){
    $phone=$_POST['phone'];
    $prepare= $conn->prepare("UPDATE customers SET phone =? WHERE customer_id=?");
        $prepare->bind_param("ii", $phone, $_SESSION['customer_id']);
        $prepare->execute();
    $_SESSION['phone']=$phone;
    header("location:receptionist_update.php");
}



if(isset($_POST['upemail'])){
    $email=$_POST['email'];
    $prepare= $conn->prepare("UPDATE customers SET email =? WHERE customer_id=?");
        $prepare->bind_param("si", $email, $_SESSION['customer_id']);
        $prepare->execute();
    $_SESSION['email']=$email;
    header("location:receptionist_update.php");
}

if(isset($_POST['upaddress'])){
    $address=$_POST['address'];
    $prepare= $conn->prepare("UPDATE customers SET address =? WHERE customer_id=?");
        $prepare->bind_param("si", $address, $_SESSION['customer_id']);
        $prepare->execute();
    $_SESSION['address']=$address;
    header("location:receptionist_update.php");
}

    if(isset($_POST['update'])){
     
        //insert address to cuctomers table
        $prepare1= $conn->prepare("UPDATE customers SET address =? WHERE customer_id=?");
        $prepare1->bind_param("si", $address, $_SESSION['customer_id']);
        $prepare1->execute();

        //insert ID details to guests table
        $prepare2= $conn->prepare("UPDATE guests SET ID_type =?, ID_number=?, files=? WHERE customer_id=?");
        $prepare2->bind_param("sssi", $id_type,$ID_number, $filename, $_SESSION['customer_id']);
        $prepare2->execute();

        //create data in checked-in-guests
        $prepare3= $conn->prepare("INSERT INTO checked_in_guests(guest_id) VALUES (?)");
        $prepare3->bind_param("i", $_SESSION['guest_id']);
        $prepare3->execute();

        //insert guest_id rooms
        $room_status="Used by guest";
        $prepare4= $conn->prepare("UPDATE rooms SET room_status=? WHERE room_id=?");
        $prepare4->bind_param("si",$room_status, $_SESSION['room_id']);
        $prepare4->execute();

    //insert data in records
            $record_type="STAYING";
            $prepare5 = $conn->prepare("INSERT INTO records(record_type,record_date,record_time,guest_id) VALUES (?,?,?,?)");
            $prepare5->bind_param("sssi",$record_type,$_SESSION['checkin'],$time,$guest_id);
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
