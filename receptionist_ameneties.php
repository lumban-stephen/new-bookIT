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
        <link rel="stylesheet" href="ameneties.css">
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
//echo "<link rel='stylesheet' href='ameneties.css'>";

?>



        <p>Hygiene</p>
            <div class="amty">
                <?php
                $Hygiene="Hygiene";
                $sql1 = "SELECT * FROM amenities WHERE amenity_type = 'Hygiene'";
$result1 = $conn->query($sql1);
$result1_id = array();
$result1_name = array();
$result1_price = array();
                while($row1 = $result1->fetch_assoc()){
                   $result1_id[] = $row1['amenity_id'];
                   $result1_name[] = $row1['amenity_name'];
                   $result1_price[] = $row1['amenity_price'];
                    }?>

    <div class="amty-box">
        <img src="assets/img-dummy.jpg">
            <p class="name"><?php echo $result1_name[0]; ?></p>
                <div class="counter">
                    <button id="plus" class="button">+</button>
                    <p id="demo" value="num"></p>
                <button id="minus" class="button">-</button>
                    <input type="hidden" name="amenity_id" value="<?php echo $result1_id[0]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result1_price[0]; ?>">
                </div>
    </div>

    <div class="amty-box">
        <img src="assets/img-dummy.jpg">
            <p class="name"><?php echo $result1_name[1]; ?></p>
                <div class="counter">
                    <button id="plus" class="button">+</button>
                    <p id="demo" value="num"></p>
                <button id="minus" class="button">-</button>
                    <input type="hidden" name="amenity_id" value="<?php echo $result1_id[1]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result1_price[1]; ?>">
                </div>
    </div>

    <div class="amty-box">
        <img src="assets/img-dummy.jpg">
            <p class="name"><?php echo $result1_name[2]; ?></p>
                <div class="counter">
                    <button id="plus" class="button">+</button>
                    <p id="demo" value="num"></p>
                <button id="minus" class="button">-</button>
                    <input type="hidden" name="amenity_id" value="<?php echo $result1_id[2]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result1_price[2]; ?>">
                </div>
    </div>

    <div class="amty-box">
        <img src="assets/img-dummy.jpg">
            <p class="name"><?php echo $result1_name[3]; ?></p>
                <div class="counter">
                    <button id="plus" class="button">+</button>
                    <p id="demo" value="num"></p>
                <button id="minus" class="button">-</button>
                    <input type="hidden" name="amenity_id" value="<?php echo $result1_id[3]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result1_price[3]; ?>">
                </div>
    </div>           
          


            
<script type="text/JavaScript">
document.getElementById("plus").addEventListener("click", displayPlus);
var i=0;
function displayPlus() {
  document.getElementById("demo").innerHTML = i++;
}
document.getElementById("minus").addEventListener("click", displayMinus);
var i=0;
function displayMinus() {
  document.getElementById("demo").innerHTML = i--;
}
</script>


            </div>
        <hr>

        <p>Food</p>
            <div class="amty">
                
                <?php
                $sql2 = "SELECT * FROM amenities WHERE amenity_type = 'Foods'";
    $result2 = $conn->query($sql2);
                while($row2 = $result2->fetch_assoc()){

    echo "<div class='amty-box'>
            <img src='assets/img-dummy.jpg'>
                <p class='name'>".$row2['amenity_name']."</p>
                <div class='counter'>
                    <img src='assets/minus.png' class='minus' style='width:20px;height:20px;'>
                    <!--Insert php number-->5
                    <img src='assets/plus.png' class='plus' style='width:20px;height:20px;'>
                </div>
            </div>"; }
            ?>
                
            </div>
        <hr>

    <p>Drinks</p>
            <div class="amty">
                
                <?php
                $sql3 = "SELECT * FROM amenities WHERE amenity_type = 'Drinks'";
$result3 = $conn->query($sql3);
                while($row3 = $result3->fetch_assoc()){

    echo "<div class='amty-box'>
            <img src='assets/img-dummy.jpg'>
                <p class='name'>".$row3['amenity_name']."</p>
                <div class='counter'>
                    <img src='assets/minus.png' class='minus' style='width:20px;height:20px;'>
                    <!--Insert php number-->5
                    <img src='assets/plus.png' class='plus' style='width:20px;height:20px;'>
                </div>
            </div>"; }
            ?>
            </div>
        <hr>



        <p>Extras</p>
            <div class="amty">
            <?php
                $sql4 = "SELECT * FROM amenities WHERE amenity_type = 'Extras'";
$result4 = $conn->query($sql4);
                while($row4 = $result4->fetch_assoc()){

    echo "<div class='amty-box'>
            <img src='assets/img-dummy.jpg'>
                <p class='name'>".$row4['amenity_name']."</p>
                <div class='counter'>
                    <img src='assets/minus.png' class='minus' style='width:20px;height:20px;'>
                    <!--Insert php number-->5
                    <img src='assets/plus.png' class='plus' style='width:20px;height:20px;'>
                </div>
            </div>"; }
            ?>

            </div>
        <hr>

            <div class="amty">
                <p>Guest Details</p>
                <div class="amty-desc">
                    <?php
echo "<p>Guest Name:".$_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname']." </p>
    <p>Bill ID: ".$_SESSION['bill_id']."</p>
";


                      ?>
                    <p>Total Amount: </p>
                    <div class="amty-btn bluegray">Process Order</div>
                    <div class="amty-btn green">Check In</div>
                </div>
            </div>
        </div>
    </body>
