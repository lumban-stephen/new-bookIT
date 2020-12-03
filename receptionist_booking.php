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
                <p>Welcome, </p>
                <a><img></img></a>
            </div>
        </div>
        </header>
        <nav><ul>
                <li><a>Dashboard</a></li>
                <li><a>Check In</a></li>
                <li><a>Check Out</a></li>
                <li><a>Reservation</a></li>
                <li><a>Records</a></li>
                <li><a>To Do List</a></li>
                <li><a>Guests</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code Here only-->
            <!--Booking page code in here-->

    <?php
    if(isset($_SESSION['checkin'])){

    echo "<form method='post' action=''>  
        <label>First Name</label>
        <input type='text' name='fname' class='button' required>
        <br><br>

        <label>Last Name</label>
        <input type='text' name='lname' class='button' required>
        <br><br>

        <label>Middle Name</label>
        <input type='text' name='mname' class='button' >
        <br><br>

        <label>Address</label>
        <input type='text' name='address' class='button' >
        <br><br>


        <label>Phone Number</label>
        <input type='number' name='phone' class='button' required>
        <br><br>

        <label>E-mail</label>
        <input type='email' name='email' class='button' required>
        <br><br>

        <label>Number of Guests</label><br>".$_SESSION['numguest']."
        <br><br>

        <label>Room Type</label>
        <select name='roomtype' class='button'>
            <option value='Select'>Select</option>
            <option value='1'>101</option>
            <option value='2'>102</option>
            <option value='3'>103</option>
            <option value='4'>104</option>
        </select>
        <br><br>

        <label>Check-in</label><br>".$_SESSION['checkin']."
        <br><br>

        <label>Check-out</label><br>".$_SESSION['checkout']."
        <br><br>

        <input type='submit' name='submit' value='SUBMIT' class='submit'>
        <br><br>
    </form>";


    }else{
  echo "<form method='post' action=''>  
        <label>First Name</label>
        <input type='text' name='fname' class='button' required>
        <br><br>

        <label>Last Name</label>
        <input type='text' name='lname' class='button' required>
        <br><br>

        <label>Middle Name</label>
        <input type='text' name='mname' class='button' >
        <br><br>

        <label>Address</label>
        <input type='text' name='address' class='button' >
        <br><br>


        <label>Phone Number</label>
        <input type='number' name='phone' class='button' required>
        <br><br>

        <label>E-mail</label>
        <input type='email' name='email' class='button' required>
        <br><br>

        <label>Number of Guests</label>
        <select name='numguest' class='button'>
            <option value='Select'>Select</option>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>  
        </select> 
        <br><br>

        <label>Room Type</label>
        <select name='roomtype' class='button'>
            <option value='Select'>Select</option>
            <option value='1'>101</option>
            <option value='2'>102</option>
            <option value='3'>103</option>
            <option value='4'>104</option>
        </select>
        <br><br>

        <label>Check-in</label><br>
        <input type='date' name='checkin' class='button'>
        <br><br>

        <label>Check-out</label><br>
        <input type='date' name='checkout' class='button'>
        <br><br>

        <input type='submit' name='submit' value='SUBMIT' class='submit'>
        <br><br>
    </form>";


    }

      ?>
    


    <?php 
    include 'connection.php';
        if(isset($_POST['submit'])){
        echo "<link rel='stylesheet' href='css.css'>";
        echo "<div class='content'>Successfully submitted!!</div>";

        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $mname=$_POST['mname'];
        $address=$_POST['address'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $room_type=$_POST['roomtype'];
        
        $checkin=$_POST['checkin'];
        $checkout=$_POST['checkout'];
        $numguest=$_POST['numguest'];
        $stays=(strtotime($checkout)-strtotime($checkin))/60/60/24; //number of stays

        //get room_id
        $sql = "SELECT r.room_id AS room_id, r.room_status AS room_status, rt.room_cost AS room_cost
        FROM rooms r,room_type rt
        WHERE r.roomtype_id = rt.roomtype_id AND r.roomtype_id='$room_type'";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()){
            if($row['room_status']==="Vacant"){
                $room_id = $row['room_id'];
                $room_cost = $row['room_cost'];
            }
        }

        $payment = $stays*$room_cost;  //total cost

        //create data in customers
        $prepare = $conn->prepare("INSERT INTO customers(fname,lname,MI,Address,email,phone) VALUES (?,?,?,?,?,?)");
    $prepare->bind_param("ssssss",$fname,$lname,$mname,$address,$email,$phone);
    $prepare->execute();

    //get customer_id ($conn->insert_id : get the last generated id)
    $customer_id = $conn->insert_id;
    
    //create data in guests
    $prepare2 = $conn->prepare("INSERT INTO guests(date_in,date_out,guests_count,room_id,customer_id,roomtype_id) VALUES (?,?,?,?,?,?)");
    $prepare2->bind_param("ssiiii",$checkin,$checkout,$numguest,$room_id,$customer_id,$room_type);
    $prepare2->execute();

    //get guest_id ($conn->insert_id : get the last generated id)
    $guest_id = $conn->insert_id;

    //create data in schedule
    $prepare3 = $conn->prepare("INSERT INTO schedule(guest_id,customer_id,room_id,roomtype_id) VALUES (?,?,?,?)");
    $prepare3->bind_param("iiii",$guest_id,$customer_id,$room_id,$room_type);
    $prepare3->execute();


    //create data in payments
    $prepare4 = $conn->prepare("INSERT INTO payments(payment_amount,roomtype_id) VALUES (?,?)");
    $prepare4->bind_param("ii",$payment,$room_type);
    $prepare4->execute();

    //get payment_id ($conn->insert_id : get the last generated id)
    $payment_id= $conn->insert_id;

    //insert payment_id to guests
    $prepare5= $conn->prepare("UPDATE guests SET payment_id =? WHERE guest_id=?");
    $prepare5->bind_param("ii", $payment_id, $guest_id);
    $prepare5->execute();
    }
    ?>
    <br>
    <br>
    <br>


    <?php
    echo $_SESSION['room_code'];
    echo $_SESSION['numguest']; 
              ?>






        </div>
    </body>