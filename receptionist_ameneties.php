<?php
   session_start();
   ob_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BookIT</title>
        <link rel="stylesheet" href="ameneties.css">
<style type="text/css">
.grid-container {
  display: grid;
  grid-template-columns: 20% 20% 20% 20%;
  grid-gap: 10px;
  padding: 10px;
}

</style>
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
error_reporting(0);

?>



        <p>Hygiene</p>
        <div class="amty">
            <?php
                $sql1 = "SELECT * FROM amenities WHERE amenity_type = 'Hygiene' AND image IS NOT NULL AND stock>0";
                $hygiene = $conn->query($sql1);
                $hygiene_id = array();
                $hygiene_name = array();
                $hygiene_price = array();
                $hygiene_stock = array();
                $hygiene_image = array();
                while($row1 = $hygiene->fetch_assoc()){
                   $hygiene_id[] = $row1['amenity_id'];
                   $hygiene_name[] = $row1['amenity_name'];
                   $hygiene_price[] = $row1['amenity_price'];
                   $hygiene_stock[] = $row1['stock'];
                   $hygiene_image[] = $row1['image'];
                    }?>

    <?php  if(!empty($hygiene_image[0]))
echo "
    <div class='amty-box'>
        <img src='assets/".$hygiene_image[0]."'>
            <p class='name'>".$hygiene_name[0]."<br>Price:".$hygiene_price[0]."</p>
                <div class='counter'>
                    <form action=".$_SERVER['PHP_SELF']." method='post'>
                    <input type='submit' name='h_minus0' value='-' class='button'>
                    
                    ".$_SESSION['h_num0']."

                    <input type='submit' name='h_plus0' value='+' class='button'>
                    <br>stock:".$_SESSION['h_stock0']."
                    <input type='hidden' name='amenity_id_h0' value='".$hygiene_id[0]."'>
                    <input type='hidden' name='amenity_price' value='".$hygiene_price[0]."'><br>
                
                </div>
    </div>";?>



<?php  if(!empty($hygiene_image[1]))
echo "
    <div class='amty-box'>
        <img src='assets/".$hygiene_image[1]."'>
            <p class='name'>".$hygiene_name[1]."<br>Price:".$hygiene_price[1]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='h_minus1' value='-' class='button'>
                    
                    ".$_SESSION['h_num1']."

                    <input type='submit' name='h_plus1' value='+' class='button'>
                    <br>stock:".$_SESSION['h_stock1']."
                    <input type='hidden' name='amenity_id_h1' value='".$hygiene_id[1]."'>
                    <input type='hidden' name='amenity_price' value='".$hygiene_price[1]."'><br>
                
                </div>
    </div>";?>


    <?php  if(!empty($hygiene_stock[2]))
echo "
    <div class='amty-box'>
        <img src='assets/".$hygiene_image[2]."'>
            <p class='name'>".$hygiene_name[2]."<br>Price:".$hygiene_price[2]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='h_minus2' value='-' class='button'>
                    
                    ".$_SESSION['h_num2']."

                    <input type='submit' name='h_plus2' value='+' class='button'>
                    <br>stock:".$_SESSION['h_stock2']."
                    <input type='hidden' name='amenity_id_h2' value='".$hygiene_id[2]."'>
                    <input type='hidden' name='amenity_price' value='".$hygiene_price[2]."'><br>
                
                </div>
    </div>";?>

<?php  if(!empty($hygiene_image[3]))
echo "
    <div class='amty-box'>
        <img src='assets/".$hygiene_image[3]."'>
            <p class='name'>".$hygiene_name[3]."<br>Price:".$hygiene_price[3]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='h_minus3' value='-' class='button'>
                    
                    ".$_SESSION['h_num3']."

                    <input type='submit' name='h_plus3' value='+' class='button'>
                    <br>stock:".$_SESSION['h_stock3']."
                    <input type='hidden' name='amenity_id_h3' value='".$hygiene_id[3]."'>
                    <input type='hidden' name='amenity_price' value='".$hygiene_price[3]."'><br>
                
                </div>
    </div>";?>

<?php  if(!empty($hygiene_image[4]))
echo "
    <div class='amty-box'>
        <img src='assets/".$hygiene_image[4]."'>
            <p class='name'>".$hygiene_name[4]."<br>Price:".$hygiene_price[4]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='h_minus4' value='-' class='button'>
                    
                    ".$_SESSION['h_num4']."

                    <input type='submit' name='h_plus4' value='+' class='button'>
                    <br>stock:".$_SESSION['h_stock4']."
                    <input type='hidden' name='amenity_id_h4' value='".$hygiene_id[4]."'>
                    <input type='hidden' name='amenity_price' value='".$hygiene_price[4]."'><br>
                
                </div>
    </div>";?>

<?php  if(!empty($hygiene_image[5]))
echo "
    <div class='amty-box'>
        <img src='assets/".$hygiene_image[5]."'>
            <p class='name'>".$hygiene_name[5]."<br>Price:".$hygiene_price[5]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='h_minus5' value='-' class='button'>
                    
                    ".$_SESSION['h_num5']."

                    <input type='submit' name='h_plus5' value='+' class='button'>
                    <br>stock:".$_SESSION['h_stock5']."
                    <input type='hidden' name='amenity_id_h5' value='".$hygiene_id[5]."'>
                    <input type='hidden' name='amenity_price' value='".$hygiene_price[5]."'><br>
                
                </div>
    </div>";?>


            </div>
        <hr>

        <p>Food</p>
            <div class="amty">
            <?php
                $sql2 = "SELECT * FROM amenities WHERE amenity_type = 'Foods' AND image IS NOT NULL AND stock>0";
                $food = $conn->query($sql2);
                $food_id = array();
                $food_name = array();
                $food_price = array();
                $food_stock = array();
                $food_image = array();
                while($row2 = $food->fetch_assoc()){
                   $food_id[] = $row2['amenity_id'];
                   $food_name[] = $row2['amenity_name'];
                   $food_price[] = $row2['amenity_price'];
                   $food_stock[] = $row2['stock'];
                   $food_image[] = $row2['image'];
                    }?>

    <?php  if(!empty($food_image[0]))
echo "
    <div class='amty-box'>
        <img src='assets/".$food_image[0]."'>
            <p class='name'>".$food_name[0]."<br>Price:".$food_price[0]."</p>
                <div class='counter'>
                  
                    <input type='submit' name='f_minus0' value='-' class='button'>
                    
                    ".$_SESSION['f_num0']."

                    <input type='submit' name='f_plus0' value='+' class='button'>
                    <br>stock:".$_SESSION['f_stock0']."
                    <input type='hidden' name='amenity_id_f0' value='".$food_id[0]."'>
                    <input type='hidden' name='amenity_price' value='".$food_price[0]."'><br>
                
                </div>
    </div>";?>



<?php  if(!empty($food_image[1]))
echo "
    <div class='amty-box'>
        <img src='assets/".$food_image[1]."'>
            <p class='name'>".$food_name[1]."<br>Price:".$food_price[1]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='f_minus1' value='-' class='button'>
                    
                    ".$_SESSION['f_num1']."

                    <input type='submit' name='f_plus1' value='+' class='button'>
                    <br>stock:".$_SESSION['f_stock1']."
                    <input type='hidden' name='amenity_id_f1' value='".$food_id[1]."'>
                    <input type='hidden' name='amenity_price' value='".$food_price[1]."'><br>
                
                </div>
    </div>";?>


    <?php  if(!empty($food_stock[2]))
echo "
    <div class='amty-box'>
        <img src='assets/".$food_image[2]."'>
            <p class='name'>".$food_name[2]."<br>Price:".$food_price[2]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='f_minus2' value='-' class='button'>
                    
                    ".$_SESSION['f_num2']."

                    <input type='submit' name='f_plus2' value='+' class='button'>
                    <br>stock:".$_SESSION['f_stock2']."
                    <input type='hidden' name='amenity_id_f2' value='".$food_id[2]."'>
                    <input type='hidden' name='amenity_price' value='".$food_price[2]."'><br>
                
                </div>
    </div>";?>

<?php  if(!empty($food_image[3]))
echo "
    <div class='amty-box'>
        <img src='assets/".$food_image[3]."'>
            <p class='name'>".$food_name[3]."<br>Price:".$food_price[3]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='f_minus3' value='-' class='button'>
                    
                    ".$_SESSION['f_num3']."

                    <input type='submit' name='f_plus3' value='+' class='button'>
                    <br>stock:".$_SESSION['f_stock3']."
                    <input type='hidden' name='amenity_id_f3' value='".$food_id[3]."'>
                    <input type='hidden' name='amenity_price' value='".$food_price[3]."'><br>
                
                </div>
    </div>";?>

<?php  if(!empty($food_image[4]))
echo "
    <div class='amty-box'>
        <img src='assets/".$food_image[4]."'>
            <p class='name'>".$food_name[4]."<br>Price:".$food_price[4]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='f_minus4' value='-' class='button'>
                    
                    ".$_SESSION['f_num4']."

                    <input type='submit' name='f_plus4' value='+' class='button'>
                    <br>stock:".$_SESSION['f_stock4']."
                    <input type='hidden' name='amenity_id_f4' value='".$food_id[4]."'>
                    <input type='hidden' name='amenity_price' value='".$food_price[4]."'><br>
                
                </div>
    </div>";?>

<?php  if(!empty($food_image[5]))
echo "
    <div class='amty-box'>
        <img src='assets/".$food_image[5]."'>
            <p class='name'>".$food_name[5]."<br>Price:".$food_price[5]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='f_minus5' value='-' class='button'>
                    
                    ".$_SESSION['f_num5']."

                    <input type='submit' name='f_plus5' value='+' class='button'>
                    <br>stock:".$_SESSION['f_stock5']."
                    <input type='hidden' name='amenity_id_f5' value='".$food_id[5]."'>
                    <input type='hidden' name='amenity_price' value='".$food_price[5]."'><br>
                
                </div>
    </div>";?>


            </div>
        <hr>


    <p>Drinks</p>
           <div class="amty">
            <?php
                $sql4 = "SELECT * FROM amenities WHERE amenity_type = 'Drinks' AND image IS NOT NULL AND stock>0";
                $drink = $conn->query($sql4);
                $drink_id = array();
                $drink_name = array();
                $drink_price = array();
                $drink_stock = array();
                $drink_image = array();
                while($row4 = $drink->fetch_assoc()){
                   $drink_id[] = $row4['amenity_id'];
                   $drink_name[] = $row4['amenity_name'];
                   $drink_price[] = $row4['amenity_price'];
                   $drink_stock[] = $row4['stock'];
                   $drink_image[] = $row4['image'];
                    }?>

    <?php  if(!empty($drink_image[0]))
echo "
    <div class='amty-box'>
        <img src='assets/".$drink_image[0]."'>
            <p class='name'>".$drink_name[0]."<br>Price:".$drink_price[0]."</p>
                <div class='counter'>
                  
                    <input type='submit' name='d_minus0' value='-' class='button'>
                    
                    ".$_SESSION['d_num0']."

                    <input type='submit' name='d_plus0' value='+' class='button'>
                    <br>stock:".$_SESSION['d_stock0']."
                    <input type='hidden' name='amenity_id_d0' value='".$drink_id[0]."'>
                    <input type='hidden' name='amenity_price' value='".$drink_price[0]."'><br>
                
                </div>
    </div>";?>



<?php  if(!empty($drink_image[1]))
echo "
    <div class='amty-box'>
        <img src='assets/".$drink_image[1]."'>
            <p class='name'>".$drink_name[1]."<br>Price:".$drink_price[1]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='d_minus1' value='-' class='button'>
                    
                    ".$_SESSION['d_num1']."

                    <input type='submit' name='d_plus1' value='+' class='button'>
                    <br>stock:".$_SESSION['d_stock1']."
                    <input type='hidden' name='amenity_id_d1' value='".$drink_id[1]."'>
                    <input type='hidden' name='amenity_price' value='".$drink_price[1]."'><br>
                
                </div>
    </div>";?>


    <?php  if(!empty($drink_stock[2]))
echo "
    <div class='amty-box'>
        <img src='assets/".$drink_image[2]."'>
            <p class='name'>".$drink_name[2]."<br>Price:".$drink_price[2]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='d_minus2' value='-' class='button'>
                    
                    ".$_SESSION['d_num2']."

                    <input type='submit' name='d_plus2' value='+' class='button'>
                    <br>stock:".$_SESSION['d_stock2']."
                    <input type='hidden' name='amenity_id_d2' value='".$drink_id[2]."'>
                    <input type='hidden' name='amenity_price' value='".$drink_price[2]."'><br>
                
                </div>
    </div>";?>

<?php  if(!empty($drink_image[3]))
echo "
    <div class='amty-box'>
        <img src='assets/".$drink_image[3]."'>
            <p class='name'>".$drink_name[3]."<br>Price:".$drink_price[3]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='d_minus3' value='-' class='button'>
                    
                    ".$_SESSION['d_num3']."

                    <input type='submit' name='d_plus3' value='+' class='button'>
                    <br>stock:".$_SESSION['d_stock3']."
                    <input type='hidden' name='amenity_id_d3' value='".$drink_id[3]."'>
                    <input type='hidden' name='amenity_price' value='".$drink_price[3]."'><br>
                
                </div>
    </div>";?>

<?php  if(!empty($drink_image[4]))
echo "
    <div class='amty-box'>
        <img src='assets/".$drink_image[4]."'>
            <p class='name'>".$drink_name[4]."<br>Price:".$drink_price[4]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='d_minus4' value='-' class='button'>
                    
                    ".$_SESSION['d_num4']."

                    <input type='submit' name='d_plus4' value='+' class='button'>
                    <br>stock:".$_SESSION['d_stock4']."
                    <input type='hidden' name='amenity_id_d4' value='".$drink_id[4]."'>
                    <input type='hidden' name='amenity_price' value='".$drink_price[4]."'><br>
                
                </div>
    </div>";?>

<?php  if(!empty($drink_image[5]))
echo "
    <div class='amty-box'>
        <img src='assets/".$drink_image[5]."'>
            <p class='name'>".$drink_name[5]."<br>Price:".$drink_price[5]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='d_minus5' value='-' class='button'>
                    
                    ".$_SESSION['d_num5']."

                    <input type='submit' name='d_plus5' value='+' class='button'>
                    <br>stock:".$_SESSION['d_stock5']."
                    <input type='hidden' name='amenity_id_d5' value='".$drink_id[5]."'>
                    <input type='hidden' name='amenity_price' value='".$drink_price[5]."'><br>
                
                </div>
    </div>";?>


            </div>
        <hr>



            <p>Extras</p>
           <div class="amty">
            <?php
                $sql3 = "SELECT * FROM amenities WHERE amenity_type = 'Extras' AND image IS NOT NULL AND stock>0";
                $extra = $conn->query($sql3);
                $extra_id = array();
                $extra_name = array();
                $extra_price = array();
                $extra_stock = array();
                $extra_image = array();
                while($row3 = $extra->fetch_assoc()){
                   $extra_id[] = $row3['amenity_id'];
                   $extra_name[] = $row3['amenity_name'];
                   $extra_price[] = $row3['amenity_price'];
                   $extra_stock[] = $row3['stock'];
                   $extra_image[] = $row3['image'];
                    }?>

    <?php  if(!empty($extra_image[0]))
echo "
    <div class='amty-box'>
        <img src='assets/".$extra_image[0]."'>
            <p class='name'>".$extra_name[0]."<br>Price:".$extra_price[0]."</p>
                <div class='counter'>
                  
                    <input type='submit' name='e_minus0' value='-' class='button'>
                    
                    ".$_SESSION['e_num0']."

                    <input type='submit' name='e_plus0' value='+' class='button'>
                    <br>stock:".$_SESSION['e_stock0']."
                    <input type='hidden' name='amenity_id_e0' value='".$extra_id[0]."'>
                    <input type='hidden' name='amenity_price' value='".$extra_price[0]."'><br>
                
                </div>
    </div>";?>



<?php  if(!empty($extra_image[1]))
echo "
    <div class='amty-box'>
        <img src='assets/".$extra_image[1]."'>
            <p class='name'>".$extra_name[1]."<br>Price:".$extra_price[1]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='e_minus1' value='-' class='button'>
                    
                    ".$_SESSION['e_num1']."

                    <input type='submit' name='e_plus1' value='+' class='button'>
                    <br>stock:".$_SESSION['e_stock1']."
                    <input type='hidden' name='amenity_id_e1' value='".$extra_id[1]."'>
                    <input type='hidden' name='amenity_price' value='".$extra_price[1]."'><br>
                
                </div>
    </div>";?>


    <?php  if(!empty($extra_stock[2]))
echo "
    <div class='amty-box'>
        <img src='assets/".$extra_image[2]."'>
            <p class='name'>".$extra_name[2]."<br>Price:".$extra_price[2]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='e_minus2' value='-' class='button'>
                    
                    ".$_SESSION['e_num2']."

                    <input type='submit' name='e_plus2' value='+' class='button'>
                    <br>stock:".$_SESSION['e_stock2']."
                    <input type='hidden' name='amenity_id_e2' value='".$extra_id[2]."'>
                    <input type='hidden' name='amenity_price' value='".$extra_price[2]."'><br>
                
                </div>
    </div>";?>

<?php  if(!empty($extra_image[3]))
echo "
    <div class='amty-box'>
        <img src='assets/".$extra_image[3]."'>
            <p class='name'>".$extra_name[3]."<br>Price:".$extra_price[3]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='e_minus3' value='-' class='button'>
                    
                    ".$_SESSION['e_num3']."

                    <input type='submit' name='e_plus3' value='+' class='button'>
                    <br>stock:".$_SESSION['e_stock3']."
                    <input type='hidden' name='amenity_id_e3' value='".$extra_id[3]."'>
                    <input type='hidden' name='amenity_price' value='".$extra_price[3]."'><br>
                
                </div>
    </div>";?>

<?php  if(!empty($extra_image[4]))
echo "
    <div class='amty-box'>
        <img src='assets/".$extra_image[4]."'>
            <p class='name'>".$extra_name[4]."<br>Price:".$extra_price[4]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='e_minus4' value='-' class='button'>
                    
                    ".$_SESSION['e_num4']."

                    <input type='submit' name='e_plus4' value='+' class='button'>
                    <br>stock:".$_SESSION['e_stock4']."
                    <input type='hidden' name='amenity_id_e4' value='".$extra_id[4]."'>
                    <input type='hidden' name='amenity_price' value='".$extra_price[4]."'><br>
                
                </div>
    </div>";?>

<?php  if(!empty($extra_image[5]))
echo "
    <div class='amty-box'>
        <img src='assets/".$extra_image[5]."'>
            <p class='name'>".$extra_name[5]."<br>Price:".$extra_price[5]."</p>
                <div class='counter'>
                    
                    <input type='submit' name='e_minus5' value='-' class='button'>
                    
                    ".$_SESSION['e_num5']."

                    <input type='submit' name='e_plus5' value='+' class='button'>
                    <br>stock:".$_SESSION['e_stock5']."
                    <input type='hidden' name='amenity_id_e5' value='".$extra_id[5]."'>
                    <input type='hidden' name='amenity_price' value='".$extra_price[5]."'><br>
                
                </div>
    </div>";?>


            </div>
        <hr>

            <div class="amty">
                <p>Guest Details</p>
                <div class="amty-desc">
                    <?php

                    $_SESSION['total_amenity']=$_SESSION['h_price0']+$_SESSION['h_price1']+$_SESSION['h_price1']+$_SESSION['h_price3']+$_SESSION['h_price4']+$_SESSION['h_price5']+
                    $_SESSION['f_price0']+$_SESSION['f_price1']+$_SESSION['f_price2']+$_SESSION['f_price3']+$_SESSION['f_price4']+$_SESSION['f_price5']+
                    $_SESSION['d_price0']+$_SESSION['d_price1']+$_SESSION['d_price2']+$_SESSION['d_price3']+$_SESSION['d_price4']+$_SESSION['d_price5']+
                    $_SESSION['e_price0']+$_SESSION['e_price1']+$_SESSION['e_price2']+$_SESSION['e_price3']+$_SESSION['e_price4']+$_SESSION['e_price5'];
                    ;

                    $sql2 = "SELECT p.payment_amount as room_fee, p.payment_id as payment_id FROM guests g, payments p WHERE g.payment_id=p.payment_id AND g.guest_id='{$_SESSION['guest_id']}'";
                    $result2 = $conn->query($sql2);
                    while($row= $result2->fetch_assoc()){
                        $room_fee=$row['room_fee'];
                        $payment_id=$row['payment_id'];
                    }

                    $sql3 = "SELECT SUM(bi.quantity*a.amenity_price) as 'total_amenty' 
                    FROM bill b, bill_items bi, amenities a
                    WHERE bi.bill_id=b.bill_id AND bi.amenity_id=a.amenity_id AND b.guest_id='{$_SESSION['guest_id']}'";
                    $result3 = $conn->query($sql3);
                    while($row= $result3->fetch_assoc()){
                        $total_amenty=$row['total_amenty'];
                    }
                    $pre_total=$room_fee+$total_amenty;

                    $_SESSION['total']=$_SESSION['total_amenity']+$pre_total;

                    echo "<p>Guest Name:".$_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname']." </p>
                     <p>Bill ID: ".$_SESSION['bill_id']."</p>
                     <p>Total Amount: ".$_SESSION['total']."(previous total: ".$pre_total.")</p>";
                    

                      ?>
                    
                    <button type='submit' name='process'class="amty-btn bluegray">Process Order</button>
                    </form>

    <?php
    if(isset($_POST['process'])){
        unset($_SERVER['PHP_SELF']);

        header("location:receptionist_guests.php");
        $today=date("Y-m-d");


        //insert date in bull_items 
//hygiene 1
        if($_SESSION['h_num0']!=0){
            $amenity_id=$_POST['amenity_id_h0'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bind_param("iisi",$_SESSION['h_num0'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bind_param("ii",$_SESSION['h_stock0'], $amenity_id);
            $hStock ->execute();      
        }

/////////////////////////////REPEAT//////////////////////////
        if($_SESSION['h_num1']!=0){
            $amenity_id=$_POST['amenity_id_h1'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bind_param("iisi",$_SESSION['h_num1'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bind_param("ii",$_SESSION['h_stock1'], $amenity_id);
            $hStock ->execute();      
        }


      if($_SESSION['h_num2']!=0){
            $amenity_id=$_POST['amenity_id_h2'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bind_param("iisi",$_SESSION['h_num2'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bind_param("ii",$_SESSION['h_stock2'], $amenity_id);
            $hStock ->execute();      
        }

        if($_SESSION['h_num3']!=0){
            $amenity_id=$_POST['amenity_id_h3'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bind_param("iisi",$_SESSION['h_num3'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bind_param("ii",$_SESSION['h_stock3'], $amenity_id);
            $hStock ->execute();      
        }

      if($_SESSION['h_num4']!=0){
            $amenity_id=$_POST['amenity_id_h4'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bind_param("iisi",$_SESSION['h_num4'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bind_param("ii",$_SESSION['h_stock4'], $amenity_id);
            $hStock ->execute();      
        }


      if($_SESSION['h_num5']!=0){
            $amenity_id=$_POST['amenity_id_h5'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bind_param("iisi",$_SESSION['h_num5'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bind_param("ii",$_SESSION['h_stock5'], $amenity_id);
            $hStock ->execute();      
        }



//drink
        if($_SESSION['d_num0']!=0){
            $amenity_id=$_POST['amenity_id_d0'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bind_param("iisi",$_SESSION['d_num0'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bind_param("ii",$_SESSION['d_stock0'], $amenity_id);
            $hStock ->execute();      
        }

/////////////////////////////REPEAT//////////////////////////
        if($_SESSION['d_num1']!=0){
            $amenity_id=$_POST['amenity_id_d1'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bind_param("iisi",$_SESSION['d_num1'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bind_param("ii",$_SESSION['d_stock1'], $amenity_id);
            $hStock ->execute();      
        }


      if($_SESSION['d_num2']!=0){
            $amenity_id=$_POST['amenity_id_d2'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bind_param("iisi",$_SESSION['d_num2'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bind_param("ii",$_SESSION['d_stock2'], $amenity_id);
            $hStock ->execute();      
        }

        if($_SESSION['d_num3']!=0){
            $amenity_id=$_POST['amenity_id_d3'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bind_param("iisi",$_SESSION['d_num3'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bind_param("ii",$_SESSION['d_stock3'], $amenity_id);
            $hStock ->execute();      
        }

      if($_SESSION['d_num4']!=0){
            $amenity_id=$_POST['amenity_id_d4'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bind_param("iisi",$_SESSION['d_num4'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bind_param("ii",$_SESSION['d_stock4'], $amenity_id);
            $hStock ->execute();      
        }


      if($_SESSION['d_num5']!=0){
            $amenity_id=$_POST['amenity_id_d5'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bind_param("iisi",$_SESSION['d_num5'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bind_param("ii",$_SESSION['d_stock5'], $amenity_id);
            $hStock ->execute();      
        }



//food
                if($_SESSION['f_num0']!=0){
            $amenity_id=$_POST['amenity_if_f0'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_fate,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->binf_param("iisi",$_SESSION['f_num0'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->binf_param("ii",$_SESSION['f_stock0'], $amenity_id);
            $hStock ->execute();      
        }

/////////////////////////////REPEAT//////////////////////////
        if($_SESSION['f_num1']!=0){
            $amenity_id=$_POST['amenity_if_f1'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_fate,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->binf_param("iisi",$_SESSION['f_num1'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->binf_param("ii",$_SESSION['f_stock1'], $amenity_id);
            $hStock ->execute();      
        }


      if($_SESSION['f_num2']!=0){
            $amenity_id=$_POST['amenity_if_f2'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_fate,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->binf_param("iisi",$_SESSION['f_num2'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->binf_param("ii",$_SESSION['f_stock2'], $amenity_id);
            $hStock ->execute();      
        }

        if($_SESSION['f_num3']!=0){
            $amenity_id=$_POST['amenity_if_f3'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_fate,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->binf_param("iisi",$_SESSION['f_num3'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->binf_param("ii",$_SESSION['f_stock3'], $amenity_id);
            $hStock ->execute();      
        }

      if($_SESSION['f_num4']!=0){
            $amenity_id=$_POST['amenity_if_f4'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_fate,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->binf_param("iisi",$_SESSION['f_num4'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->binf_param("ii",$_SESSION['f_stock4'], $amenity_id);
            $hStock ->execute();      
        }


      if($_SESSION['f_num5']!=0){
            $amenity_id=$_POST['amenity_if_f5'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_fate,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->binf_param("iisi",$_SESSION['f_num5'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->binf_param("ii",$_SESSION['f_stock5'], $amenity_id);
            $hStock ->execute();      
        }


//extras
                if($_SESSION['e_num0']!=0){
            $amenity_id=$_POST['amenity_ie_e0'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_eate,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bine_param("iisi",$_SESSION['e_num0'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bine_param("ii",$_SESSION['e_stock0'], $amenity_id);
            $hStock ->execute();      
        }

/////////////////////////////REPEAT//////////////////////////
        if($_SESSION['e_num1']!=0){
            $amenity_id=$_POST['amenity_ie_e1'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_eate,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bine_param("iisi",$_SESSION['e_num1'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bine_param("ii",$_SESSION['e_stock1'], $amenity_id);
            $hStock ->execute();      
        }


      if($_SESSION['e_num2']!=0){
            $amenity_id=$_POST['amenity_ie_e2'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_eate,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bine_param("iisi",$_SESSION['e_num2'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bine_param("ii",$_SESSION['e_stock2'], $amenity_id);
            $hStock ->execute();      
        }

        if($_SESSION['e_num3']!=0){
            $amenity_id=$_POST['amenity_ie_e3'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_eate,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bine_param("iisi",$_SESSION['e_num3'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bine_param("ii",$_SESSION['e_stock3'], $amenity_id);
            $hStock ->execute();      
        }

      if($_SESSION['e_num4']!=0){
            $amenity_id=$_POST['amenity_ie_e4'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_eate,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bine_param("iisi",$_SESSION['e_num4'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bine_param("ii",$_SESSION['e_stock4'], $amenity_id);
            $hStock ->execute();      
        }


      if($_SESSION['e_num5']!=0){
            $amenity_id=$_POST['amenity_ie_e5'];
            $hBillItem = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_eate,amenity_id) VALUES (?,?,?,?)");
            $hBillItem->bine_param("iisi",$_SESSION['e_num5'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $hBillItem->execute();

            $hStock= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $hStock ->bine_param("ii",$_SESSION['e_stock5'], $amenity_id);
            $hStock ->execute();      
        }

        ob_end_flush();
        unset($_SERVER['PHP_SELF']);
        session_destroy();
        

    }


      ?>

                </div>
            </div>
        </div>
    </body>




<?php
//////////////////////calculation REPEAT BELOW////////////////////////////
//first HYGIENE item
$_SESSION['h_num0']=((isset($_SESSION['h_num0']))?$_SESSION['h_num0']:0);
$_SESSION['h_price0']=((isset($_SESSION['h_num0']))?$_SESSION['h_num0']:0);
        
if(isset($_POST['h_minus0'])){
    if($_SESSION['h_num0']<=0){
        $_SESSION['h_num0']=0;
    }else{
        $_SESSION['h_num0']--;}
    }

if(isset($_POST['h_plus0'])){
    if($_SESSION['h_stock0']>0){
        $_SESSION['h_num0']++;}
    }
                        
    $_SESSION['h_price0']=$hygiene_price[0]*$_SESSION['h_num0'];
    $_SESSION['h_stock0']=$hygiene_stock[0]-$_SESSION['h_num0'];
?>


<?php
//REPEAT
//2 hygiene item
$_SESSION['h_num1']=((isset($_SESSION['h_num1']))?$_SESSION['h_num1']:0);
$_SESSION['h_price1']=((isset($_SESSION['h_num1']))?$_SESSION['h_num1']:0);
        
if(isset($_POST['h_minus1'])){
    if($_SESSION['h_num1']<=0){
        $_SESSION['h_num1']=0;
    }else{
        $_SESSION['h_num1']--;}
    }

if(isset($_POST['h_plus1'])){
    if($_SESSION['h_stock1']>0){
        $_SESSION['h_num1']++;}
    }
                        
    $_SESSION['h_price1']=$hygiene_price[1]*$_SESSION['h_num1'];
    $_SESSION['h_stock1']=$hygiene_stock[1]-$_SESSION['h_num1'];
?>

<?php
//3 hygiene item
$_SESSION['h_num2']=((isset($_SESSION['h_num2']))?$_SESSION['h_num2']:0);
$_SESSION['h_price2']=((isset($_SESSION['h_num2']))?$_SESSION['h_num2']:0);
        
if(isset($_POST['h_minus2'])){
    if($_SESSION['h_num2']<=0){
        $_SESSION['h_num2']=0;
    }else{
        $_SESSION['h_num2']--;}
    }

if(isset($_POST['h_plus2'])){
    if($_SESSION['h_stock2']>0){
        $_SESSION['h_num2']++;}
    }
                        
    $_SESSION['h_price2']=$hygiene_price[2]*$_SESSION['h_num2'];
    $_SESSION['h_stock2']=$hygiene_stock[2]-$_SESSION['h_num2'];
?>

<?php
//4 hygiene item
$_SESSION['h_num3']=((isset($_SESSION['h_num3']))?$_SESSION['h_num3']:0);
$_SESSION['h_price3']=((isset($_SESSION['h_num3']))?$_SESSION['h_num3']:0);
        
if(isset($_POST['h_minus3'])){
    if($_SESSION['h_num3']<=0){
        $_SESSION['h_num3']=0;
    }else{
        $_SESSION['h_num3']--;}
    }

if(isset($_POST['h_plus3'])){
    if($_SESSION['h_stock3']>0){
        $_SESSION['h_num3']++;}
    }
                        
    $_SESSION['h_price3']=$hygiene_price[3]*$_SESSION['h_num3'];
    $_SESSION['h_stock3']=$hygiene_stock[3]-$_SESSION['h_num3'];
?>

<?php
//5 hygiene item
$_SESSION['h_num4']=((isset($_SESSION['h_num4']))?$_SESSION['h_num4']:0);
$_SESSION['h_price4']=((isset($_SESSION['h_num4']))?$_SESSION['h_num4']:0);
        
if(isset($_POST['h_minus4'])){
    if($_SESSION['h_num4']<=0){
        $_SESSION['h_num4']=0;
    }else{
        $_SESSION['h_num4']--;}
    }

if(isset($_POST['h_plus4'])){
    if($_SESSION['h_stock4']>0){
        $_SESSION['h_num4']++;}
    }
                        
    $_SESSION['h_price4']=$hygiene_price[4]*$_SESSION['h_num4'];
    $_SESSION['h_stock4']=$hygiene_stock[4]-$_SESSION['h_num4'];
?>

<?php
//6 hygiene item
$_SESSION['h_num5']=((isset($_SESSION['h_num5']))?$_SESSION['h_num5']:0);
$_SESSION['h_price5']=((isset($_SESSION['h_num5']))?$_SESSION['h_num5']:0);
        
if(isset($_POST['h_minus5'])){
    if($_SESSION['h_num5']<=0){
        $_SESSION['h_num5']=0;
    }else{
        $_SESSION['h_num5']--;}
    }

if(isset($_POST['h_plus5'])){
    if($_SESSION['h_stock5']>0){
        $_SESSION['h_num5']++;}
    }
                        
    $_SESSION['h_price5']=$hygiene_price[5]*$_SESSION['h_num5'];
    $_SESSION['h_stock5']=$hygiene_stock[5]-$_SESSION['h_num5'];
?>


<?php
//calculation REPEAT BELOW
///////////////////////////////FOOD//////////////////////////////////
//first FOOD item
$_SESSION['f_num0']=((isset($_SESSION['f_num0']))?$_SESSION['f_num0']:0);
$_SESSION['f_price0']=((isset($_SESSION['f_num0']))?$_SESSION['f_num0']:0);
        
if(isset($_POST['f_minus0'])){
    if($_SESSION['f_num0']<=0){
        $_SESSION['f_num0']=0;
    }else{
        $_SESSION['f_num0']--;}
    }

if(isset($_POST['f_plus0'])){
    if($_SESSION['f_stock0']>0){
        $_SESSION['f_num0']++;}
    }
                        
    $_SESSION['f_price0']=$food_price[0]*$_SESSION['f_num0'];
    $_SESSION['f_stock0']=$food_stock[0]-$_SESSION['f_num0'];
?>


<?php
//REPEAT
//2 FOOD item
$_SESSION['f_num1']=((isset($_SESSION['f_num1']))?$_SESSION['f_num1']:0);
$_SESSION['f_price1']=((isset($_SESSION['f_num1']))?$_SESSION['f_num1']:0);
        
if(isset($_POST['f_minus1'])){
    if($_SESSION['f_num1']<=0){
        $_SESSION['f_num1']=0;
    }else{
        $_SESSION['f_num1']--;}
    }

if(isset($_POST['f_plus1'])){
    if($_SESSION['f_stock1']>0){
        $_SESSION['f_num1']++;}
    }
                        
    $_SESSION['f_price1']=$food_price[1]*$_SESSION['f_num1'];
    $_SESSION['f_stock1']=$food_stock[1]-$_SESSION['f_num1'];
?>

<?php
//3 FOOD item
$_SESSION['f_num2']=((isset($_SESSION['f_num2']))?$_SESSION['f_num2']:0);
$_SESSION['f_price2']=((isset($_SESSION['f_num2']))?$_SESSION['f_num2']:0);
        
if(isset($_POST['f_minus2'])){
    if($_SESSION['f_num2']<=0){
        $_SESSION['f_num2']=0;
    }else{
        $_SESSION['f_num2']--;}
    }

if(isset($_POST['f_plus2'])){
    if($_SESSION['f_stock2']>0){
        $_SESSION['f_num2']++;}
    }
                        
    $_SESSION['f_price2']=$food_price[2]*$_SESSION['f_num2'];
    $_SESSION['f_stock2']=$food_stock[2]-$_SESSION['f_num2'];
?>

<?php
//4 FOOD item
$_SESSION['f_num3']=((isset($_SESSION['f_num3']))?$_SESSION['f_num3']:0);
$_SESSION['f_price3']=((isset($_SESSION['f_num3']))?$_SESSION['f_num3']:0);
        
if(isset($_POST['f_minus3'])){
    if($_SESSION['f_num3']<=0){
        $_SESSION['f_num3']=0;
    }else{
        $_SESSION['f_num3']--;}
    }

if(isset($_POST['f_plus3'])){
    if($_SESSION['f_stock3']>0){
        $_SESSION['f_num3']++;}
    }
                        
    $_SESSION['f_price3']=$food_price[3]*$_SESSION['f_num3'];
    $_SESSION['f_stock3']=$food_stock[3]-$_SESSION['f_num3'];
?>

<?php
//5 FOOD item
$_SESSION['f_num4']=((isset($_SESSION['f_num4']))?$_SESSION['f_num4']:0);
$_SESSION['f_price4']=((isset($_SESSION['f_num4']))?$_SESSION['f_num4']:0);
        
if(isset($_POST['f_minus4'])){
    if($_SESSION['f_num4']<=0){
        $_SESSION['f_num4']=0;
    }else{
        $_SESSION['f_num4']--;}
    }

if(isset($_POST['f_plus4'])){
    if($_SESSION['f_stock4']>0){
        $_SESSION['f_num4']++;}
    }
                        
    $_SESSION['f_price4']=$food_price[4]*$_SESSION['f_num4'];
    $_SESSION['f_stock4']=$food_stock[4]-$_SESSION['f_num4'];
?>

<?php
//6 FOOD item
$_SESSION['f_num5']=((isset($_SESSION['f_num5']))?$_SESSION['f_num5']:0);
$_SESSION['f_price5']=((isset($_SESSION['f_num5']))?$_SESSION['f_num5']:0);
        
if(isset($_POST['f_minus5'])){
    if($_SESSION['f_num5']<=0){
        $_SESSION['f_num5']=0;
    }else{
        $_SESSION['f_num5']--;}
    }

if(isset($_POST['f_plus5'])){
    if($_SESSION['f_stock5']>0){
        $_SESSION['f_num5']++;}
    }
                        
    $_SESSION['f_price5']=$food_price[5]*$_SESSION['f_num5'];
    $_SESSION['f_stock5']=$food_stock[5]-$_SESSION['f_num5'];
?>

<?php
//calculation REPEAT BELOW
///////////////////////////////DRINK//////////////////////////////////
//first DRINK item
$_SESSION['d_num0']=((isset($_SESSION['d_num0']))?$_SESSION['d_num0']:0);
$_SESSION['d_price0']=((isset($_SESSION['d_num0']))?$_SESSION['d_num0']:0);
        
if(isset($_POST['d_minus0'])){
    if($_SESSION['d_num0']<=0){
        $_SESSION['d_num0']=0;
    }else{
        $_SESSION['d_num0']--;}
    }

if(isset($_POST['d_plus0'])){
    if($_SESSION['d_stock0']>0){
        $_SESSION['d_num0']++;}
    }
                        
    $_SESSION['d_price0']=$food_price[0]*$_SESSION['d_num0'];
    $_SESSION['d_stock0']=$food_stock[0]-$_SESSION['d_num0'];
?>


<?php
//REPEAT
//2 DRINK item
$_SESSION['d_num1']=((isset($_SESSION['d_num1']))?$_SESSION['d_num1']:0);
$_SESSION['d_price1']=((isset($_SESSION['d_num1']))?$_SESSION['d_num1']:0);
        
if(isset($_POST['d_minus1'])){
    if($_SESSION['d_num1']<=0){
        $_SESSION['d_num1']=0;
    }else{
        $_SESSION['d_num1']--;}
    }

if(isset($_POST['d_plus1'])){
    if($_SESSION['d_stock1']>0){
        $_SESSION['d_num1']++;}
    }
                        
    $_SESSION['d_price1']=$food_price[1]*$_SESSION['d_num1'];
    $_SESSION['d_stock1']=$food_stock[1]-$_SESSION['d_num1'];
?>

<?php
//3 DRINK item
$_SESSION['d_num2']=((isset($_SESSION['d_num2']))?$_SESSION['d_num2']:0);
$_SESSION['d_price2']=((isset($_SESSION['d_num2']))?$_SESSION['d_num2']:0);
        
if(isset($_POST['d_minus2'])){
    if($_SESSION['d_num2']<=0){
        $_SESSION['d_num2']=0;
    }else{
        $_SESSION['d_num2']--;}
    }

if(isset($_POST['d_plus2'])){
    if($_SESSION['d_stock2']>0){
        $_SESSION['d_num2']++;}
    }
                        
    $_SESSION['d_price2']=$food_price[2]*$_SESSION['d_num2'];
    $_SESSION['d_stock2']=$food_stock[2]-$_SESSION['d_num2'];
?>

<?php
//4 DRINK item
$_SESSION['d_num3']=((isset($_SESSION['d_num3']))?$_SESSION['d_num3']:0);
$_SESSION['d_price3']=((isset($_SESSION['d_num3']))?$_SESSION['d_num3']:0);
        
if(isset($_POST['d_minus3'])){
    if($_SESSION['d_num3']<=0){
        $_SESSION['d_num3']=0;
    }else{
        $_SESSION['d_num3']--;}
    }

if(isset($_POST['d_plus3'])){
    if($_SESSION['d_stock3']>0){
        $_SESSION['d_num3']++;}
    }
                        
    $_SESSION['d_price3']=$food_price[3]*$_SESSION['d_num3'];
    $_SESSION['d_stock3']=$food_stock[3]-$_SESSION['d_num3'];
?>

<?php
//5 DRINK item
$_SESSION['d_num4']=((isset($_SESSION['d_num4']))?$_SESSION['d_num4']:0);
$_SESSION['d_price4']=((isset($_SESSION['d_num4']))?$_SESSION['d_num4']:0);
        
if(isset($_POST['d_minus4'])){
    if($_SESSION['d_num4']<=0){
        $_SESSION['d_num4']=0;
    }else{
        $_SESSION['d_num4']--;}
    }

if(isset($_POST['d_plus4'])){
    if($_SESSION['d_stock4']>0){
        $_SESSION['d_num4']++;}
    }
                        
    $_SESSION['d_price4']=$food_price[4]*$_SESSION['d_num4'];
    $_SESSION['d_stock4']=$food_stock[4]-$_SESSION['d_num4'];
?>

<?php
//6 DRINK item
$_SESSION['d_num5']=((isset($_SESSION['d_num5']))?$_SESSION['d_num5']:0);
$_SESSION['d_price5']=((isset($_SESSION['d_num5']))?$_SESSION['d_num5']:0);
        
if(isset($_POST['d_minus5'])){
    if($_SESSION['d_num5']<=0){
        $_SESSION['d_num5']=0;
    }else{
        $_SESSION['d_num5']--;}
    }

if(isset($_POST['d_plus5'])){
    if($_SESSION['d_stock5']>0){
        $_SESSION['d_num5']++;}
    }
                        
    $_SESSION['d_price5']=$food_price[5]*$_SESSION['d_num5'];
    $_SESSION['d_stock5']=$food_stock[5]-$_SESSION['d_num5'];
?>

<?php
//calculation REPEAT BELOW
/////////////////////////////// EXTRAS //////////////////////////////////
//first DRINK item
$_SESSION['e_num0']=((isset($_SESSION['e_num0']))?$_SESSION['e_num0']:0);
$_SESSION['e_price0']=((isset($_SESSION['e_num0']))?$_SESSION['e_num0']:0);
        
if(isset($_POST['e_minus0'])){
    if($_SESSION['e_num0']<=0){
        $_SESSION['e_num0']=0;
    }else{
        $_SESSION['e_num0']--;}
    }

if(isset($_POST['e_plus0'])){
    if($_SESSION['e_stock0']>0){
        $_SESSION['e_num0']++;}
    }
                        
    $_SESSION['e_price0']=$extra_price[0]*$_SESSION['e_num0'];
    $_SESSION['e_stock0']=$extra_stock[0]-$_SESSION['e_num0'];
?>


<?php
//REPEAT
//2 EXTRAS item
$_SESSION['e_num1']=((isset($_SESSION['e_num1']))?$_SESSION['e_num1']:0);
$_SESSION['e_price1']=((isset($_SESSION['e_num1']))?$_SESSION['e_num1']:0);
        
if(isset($_POST['e_minus1'])){
    if($_SESSION['e_num1']<=0){
        $_SESSION['e_num1']=0;
    }else{
        $_SESSION['e_num1']--;}
    }

if(isset($_POST['e_plus1'])){
    if($_SESSION['e_stock1']>0){
        $_SESSION['e_num1']++;}
    }
                        
    $_SESSION['e_price1']=$extra_price[1]*$_SESSION['e_num1'];
    $_SESSION['e_stock1']=$extra_stock[1]-$_SESSION['e_num1'];
?>

<?php
//3 EXTRASitem
$_SESSION['e_num2']=((isset($_SESSION['e_num2']))?$_SESSION['e_num2']:0);
$_SESSION['e_price2']=((isset($_SESSION['e_num2']))?$_SESSION['e_num2']:0);
        
if(isset($_POST['e_minus2'])){
    if($_SESSION['e_num2']<=0){
        $_SESSION['e_num2']=0;
    }else{
        $_SESSION['e_num2']--;}
    }

if(isset($_POST['e_plus2'])){
    if($_SESSION['e_stock2']>0){
        $_SESSION['e_num2']++;}
    }
                        
    $_SESSION['e_price2']=$extra_price[2]*$_SESSION['e_num2'];
    $_SESSION['e_stock2']=$extra_stock[2]-$_SESSION['e_num2'];
?>

<?php
//4 EXTRASitem
$_SESSION['e_num3']=((isset($_SESSION['e_num3']))?$_SESSION['e_num3']:0);
$_SESSION['e_price3']=((isset($_SESSION['e_num3']))?$_SESSION['e_num3']:0);
        
if(isset($_POST['e_minus3'])){
    if($_SESSION['e_num3']<=0){
        $_SESSION['e_num3']=0;
    }else{
        $_SESSION['e_num3']--;}
    }

if(isset($_POST['e_plus3'])){
    if($_SESSION['e_stock3']>0){
        $_SESSION['e_num3']++;}
    }
                        
    $_SESSION['e_price3']=$extra_price[3]*$_SESSION['e_num3'];
    $_SESSION['e_stock3']=$extra_stock[3]-$_SESSION['e_num3'];
?>

<?php
//5 EXTRASitem
$_SESSION['e_num4']=((isset($_SESSION['e_num4']))?$_SESSION['e_num4']:0);
$_SESSION['e_price4']=((isset($_SESSION['e_num4']))?$_SESSION['e_num4']:0);
        
if(isset($_POST['e_minus4'])){
    if($_SESSION['e_num4']<=0){
        $_SESSION['e_num4']=0;
    }else{
        $_SESSION['e_num4']--;}
    }

if(isset($_POST['e_plus4'])){
    if($_SESSION['e_stock4']>0){
        $_SESSION['e_num4']++;}
    }
                        
    $_SESSION['e_price4']=$extra_price[4]*$_SESSION['e_num4'];
    $_SESSION['e_stock4']=$extra_stock[4]-$_SESSION['e_num4'];
?>

<?php
//6 EXTRASitem
$_SESSION['e_num5']=((isset($_SESSION['e_num5']))?$_SESSION['e_num5']:0);
$_SESSION['e_price5']=((isset($_SESSION['e_num5']))?$_SESSION['e_num5']:0);
        
if(isset($_POST['e_minus5'])){
    if($_SESSION['e_num5']<=0){
        $_SESSION['e_num5']=0;
    }else{
        $_SESSION['e_num5']--;}
    }

if(isset($_POST['e_plus5'])){
    if($_SESSION['e_stock5']>0){
        $_SESSION['e_num5']++;}
    }
                        
    $_SESSION['e_price5']=$extra_price[5]*$_SESSION['e_num5'];
    $_SESSION['e_stock5']=$extra_stock[5]-$_SESSION['e_num5'];

        
    ?>

