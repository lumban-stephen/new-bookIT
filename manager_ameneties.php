<?php
   session_start();
   ob_start();
   error_reporting(0);
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
                <p>Welcome Manager</p>
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
                <li id="logoli"><img src="assets/bookIT_Logo.png"></li>
                <li><a href="manager_dashboard.php">Dashboard</a></li>
                <li><a href="manager_revenue.php">Revenue</a></li>
                <li><a href="manager_records.php">Records</a></li>
                <li><a href="manager_guests.php">Guests</a></li>
                <li><a href="manager_room-mgt.php">Room Management</a></li>
                <li><a href="manager_staff.php">Staff Management</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code Here only-->
            <!--receptionist check in form page code in here-->
<?php
include 'connection.php';
//echo "<link rel='stylesheet' href='ameneties.css'>";

?>

<a href="manager_restock.php">RESTOCK AMENITIES</a>>

        <p>Hygiene</p>
            <div class="amty">
                <?php
                $sql1 = "SELECT * FROM amenities WHERE amenity_type = 'Hygiene'";
                $result1 = $conn->query($sql1);
                $result1_id = array();
                $result1_name = array();
                $result1_price = array();
                $result1_stock = array();
                while($row1 = $result1->fetch_assoc()){
                   $result1_id[] = $row1['amenity_id'];
                   $result1_name[] = $row1['amenity_name'];
                   $result1_price[] = $row1['amenity_price'];
                   $result1_stock[] = $row1['stock'];
                    }?>

    <div class="amty-box">
        <img src="assets/dove-shampoo.jpg">
            <p class="name"><?php echo $result1_name[0]."<br>Price:".$result1_price[0]; ?></p>
                <div class="counter">
                    <form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post">
                    
                    <input type="submit" name="h_minus0" value="-" class="button">
                    
                    <?php
                        $_SESSION['h_num0']=((isset($_SESSION['h_num0']))?$_SESSION['h_num0']:0);
                        $_SESSION['h_price0']=((isset($_SESSION['h_num0']))?$_SESSION['h_num0']:0);
                        if(isset($_POST['h_minus0'])){
                            if($_SESSION['h_num0']<=0){
                            $_SESSION['h_num0']=0;
                        }else{
                            $_SESSION['h_num0']--;
                        }
                        }
                        if(isset($_POST['h_plus0'])){
                            $_SESSION['h_num0']++;
                        }
                        echo $_SESSION['h_num0'];
                        $_SESSION['h_price0']=$result1_price[0]*$_SESSION['h_num0'];
                    ?>            
                    <input type="submit" name="h_plus0" value="+" class="button">
                    <?php
                    $_SESSION['h_stock0']=$result1_stock[0]-$_SESSION['h_num0'];
                    echo "<br>stock: ".$_SESSION['h_stock0'];
                      ?>
                
                    <input type="hidden" name="amenity_id_h0" value="<?php echo $result1_id[0]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result1_price[0]; ?>"><br>
                
                </div>
    </div>



    <div class="amty-box">
        <img src="assets/dove-conditioner.jpg">
            <p class="name"><?php echo $result1_name[1]."<br>Price:".$result1_price[1]; ?></p>
                <div class="counter">
                    
                    <input type="submit" name="h_minus1" value="-">
                    
                    <?php
                        $_SESSION['h_num1']=((isset($_SESSION['h_num1']))?$_SESSION['h_num1']:0);
                        $_SESSION['h_price1']=((isset($_SESSION['h_num1']))?$_SESSION['h_num1']:0);
                        if(isset($_POST['h_minus1'])){
                            if($_SESSION['h_num1']<=0){
                            $_SESSION['h_num1']=0;
                        }else{
                            $_SESSION['h_num1']--;
                        }
                        }
                        if(isset($_POST['h_plus1'])){
                            $_SESSION['h_num1']++;
                        }
                        echo $_SESSION['h_num1'];
                        $_SESSION['h_price1']=$result1_price[0]*$_SESSION['h_num1'];
                        
                    ?>            
                    <input type="submit" name="h_plus1" value="+">
                    <?php
                    $_SESSION['h_stock1']=$result1_stock[1]-$_SESSION['h_num1'];
                    echo "<br>stock: ".$_SESSION['h_stock1'];
                      ?>
                
                    <input type="hidden" name="amenity_id_h1" value="<?php echo $result1_id[1]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result1_price[1]; ?>"><br>
                
                </div>
    </div>


    <div class="amty-box">
        <img src="assets/sunsilk-shampoo.png">
            <p class="name"><?php echo $result1_name[2]."<br>Price:".$result1_price[2]; ?></p>
                <div class="counter">
                    
                    <input type="submit" name="h_minus2" value="-">
                    
                    <?php
                        $_SESSION['h_num2']=((isset($_SESSION['h_num2']))?$_SESSION['h_num2']:0);
                        $_SESSION['h_price2']=((isset($_SESSION['h_num2']))?$_SESSION['h_num2']:0);
                        if(isset($_POST['h_minus2'])){
                            if($_SESSION['h_num2']<=0){
                            $_SESSION['h_num2']=0;
                        }else{
                            $_SESSION['h_num2']--;
                        }
                        }
                        if(isset($_POST['h_plus2'])){
                            $_SESSION['h_num2']++;
                        }
                        echo $_SESSION['h_num2'];
                        $_SESSION['h_price2']=$result1_price[2]*$_SESSION['h_num2'];
                        
                    ?>            
                    <input type="submit" name="h_plus2" value="+">
                    <?php
                    $_SESSION['h_stock2']=$result1_stock[2]-$_SESSION['h_num2'];
                    echo "<br>stock: ".$_SESSION['h_stock2'];
                      ?>
                
                    <input type="hidden" name="amenity_id_h2" value="<?php echo $result1_id[2]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result1_price[2]; ?>"><br>
                
                </div>
    </div>

    <div class="amty-box">
        <img src="assets/creamsilk.jpg">
            <p class="name"><?php echo $result1_name[3]."<br>Price:".$result1_price[3]; ?></p>
                <div class="counter">
                    
                    <input type="submit" name="h_minus3" value="-">
                    
                    <?php
                        $_SESSION['h_num3']=((isset($_SESSION['h_num3']))?$_SESSION['h_num3']:0);
                        $_SESSION['h_price3']=((isset($_SESSION['h_num3']))?$_SESSION['h_num3']:0);
                        if(isset($_POST['h_minus3'])){
                            if($_SESSION['h_num3']<=0){
                            $_SESSION['h_num3']=0;
                        }else{
                            $_SESSION['h_num3']--;
                        }
                        }
                        if(isset($_POST['h_plus3'])){
                            $_SESSION['h_num3']++;
                        }
                        echo $_SESSION['h_num3'];
                        $_SESSION['h_price3']=$result1_price[3]*$_SESSION['h_num3'];
                        
                    ?>            
                    <input type="submit" name="h_plus3" value="+">
                    <?php
                    $_SESSION['h_stock3']=$result1_stock[3]-$_SESSION['h_num3'];
                    echo "<br>stock: ".$_SESSION['h_stock3'];
                      ?>
                
                    <input type="hidden" name="amenity_id_h3" value="<?php echo $result1_id[3]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result1_price[3]; ?>"><br>
                
                </div>
    </div>           
            </div>
        <hr>

        <p>Food</p>
            <div class="amty">
                <?php
                $sql1 = "SELECT * FROM amenities WHERE amenity_type = 'Foods'";
                $result2 = $conn->query($sql1);
                $result2_id = array();
                $result2_name = array();
                $result2_price = array();
                $result2_stock = array();
                while($row2 = $result2->fetch_assoc()){
                   $result2_id[] = $row2['amenity_id'];
                   $result2_name[] = $row2['amenity_name'];
                   $result2_price[] = $row2['amenity_price'];
                   $result2_stock[] = $row2['stock'];
                    }?>

    <div class="amty">
                <?php
                $sql1 = "SELECT * FROM amenities WHERE amenity_type = 'Foods'";
                $result2 = $conn->query($sql1);
                $result2_id = array();
                $result2_name = array();
                $result2_price = array();
                $result2_stock = array();
                while($row2 = $result2->fetch_assoc()){
                   $result2_id[] = $row2['amenity_id'];
                   $result2_name[] = $row2['amenity_name'];
                   $result2_price[] = $row2['amenity_price'];
                   $result2_stock[] = $row2['stock'];
                    }?>

    <div class="amty-box">
        <img src="assets/Piattos.JFIF">
            <p class="name"><?php echo $result2_name[0]."<br>Price:".$result2_price[0]; ?></p>
                <div class="counter">
                    
                    <input type="submit" name="f_minus0" value="-">
                    
                    <?php
                        $_SESSION['f_num0']=((isset($_SESSION['f_num0']))?$_SESSION['f_num0']:0);
                        $_SESSION['f_price0']=((isset($_SESSION['f_num0']))?$_SESSION['f_num0']:0);
                        if(isset($_POST['f_minus0'])){
                            if($_SESSION['f_num0']<=0){
                            $_SESSION['f_num0']=0;
                        }else{
                            $_SESSION['f_num0']--;
                        }
                        }
                        if(isset($_POST['f_plus0'])){
                            $_SESSION['f_num0']++;
                        }
                        echo $_SESSION['f_num0'];
                        $_SESSION['f_price0']=$result2_price[0]*$_SESSION['f_num0'];
                    ?>            
                    <input type="submit" name="f_plus0" value="+">
                    <?php
                    $_SESSION['f_stock0']=$result2_stock[0]-$_SESSION['f_num0'];
                    echo "<br>stock: ".$_SESSION['f_stock0'];
                      ?>
                
                    <input type="hidden" name="amenity_id_f0" value="<?php echo $result2_id[0]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result2_price[0]; ?>"><br>
                
                </div>
    </div>



    <div class="amty-box">
        <img src="assets/nova.png">
            <p class="name"><?php echo $result2_name[1]."<br>Price:".$result2_price[1]; ?></p>
                <div class="counter">
                    
                    <input type="submit" name="f_minus1" value="-">
                    
                    <?php
                        $_SESSION['f_num1']=((isset($_SESSION['f_num1']))?$_SESSION['f_num1']:0);
                        $_SESSION['f_price1']=((isset($_SESSION['f_num1']))?$_SESSION['f_num1']:0);
                        if(isset($_POST['f_minus1'])){
                            if($_SESSION['f_num1']<=0){
                            $_SESSION['f_num1']=0;
                        }else{
                            $_SESSION['f_num1']--;
                        }
                        }
                        if(isset($_POST['f_plus1'])){
                            $_SESSION['f_num1']++;
                        }
                        echo $_SESSION['f_num1'];
                        $_SESSION['f_price1']=$result2_price[0]*$_SESSION['f_num1'];
                        
                    ?>            
                    <input type="submit" name="f_plus1" value="+">
                    <?php
                    $_SESSION['f_stock1']=$result2_stock[1]-$_SESSION['f_num1'];
                    echo "<br>stock: ".$_SESSION['f_stock1'];
                      ?>
                
                    <input type="hidden" name="amenity_id_f1" value="<?php echo $result2_id[1]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result2_price[1]; ?>"><br>
                
                </div>
    </div>


    <div class="amty-box">
        <img src="assets/taquitos.jpg">
            <p class="name"><?php echo $result2_name[2]."<br>Price:".$result2_price[2]; ?></p>
                <div class="counter">
                    
                    <input type="submit" name="f_minus2" value="-">
                    
                    <?php
                        $_SESSION['f_num2']=((isset($_SESSION['f_num2']))?$_SESSION['f_num2']:0);
                        $_SESSION['f_price2']=((isset($_SESSION['f_num2']))?$_SESSION['f_num2']:0);
                        if(isset($_POST['f_minus2'])){
                            if($_SESSION['f_num2']<=0){
                            $_SESSION['f_num2']=0;
                        }else{
                            $_SESSION['f_num2']--;
                        }
                        }
                        if(isset($_POST['f_plus2'])){
                            $_SESSION['f_num2']++;
                        }
                        echo $_SESSION['f_num2'];
                        $_SESSION['f_price2']=$result2_price[2]*$_SESSION['f_num2'];
                        
                    ?>            
                    <input type="submit" name="f_plus2" value="+">
                    <?php
                    $_SESSION['f_stock2']=$result2_stock[2]-$_SESSION['f_num2'];
                    echo "<br>stock: ".$_SESSION['f_stock2'];
                      ?>
                
                    <input type="hidden" name="amenity_id_f2" value="<?php echo $result2_id[2]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result2_price[2]; ?>"><br>
                
                </div>
    </div>

    <div class="amty-box">
        <img src="assets/vcut.jpg">
            <p class="name"><?php echo $result2_name[3]."<br>Price:".$result2_price[3]; ?></p>
                <div class="counter">
                    
                    <input type="submit" name="f_minus3" value="-">
                    
                    <?php
                        $_SESSION['f_num3']=((isset($_SESSION['f_num3']))?$_SESSION['f_num3']:0);
                        $_SESSION['f_price3']=((isset($_SESSION['f_num3']))?$_SESSION['f_num3']:0);
                        if(isset($_POST['f_minus3'])){
                            if($_SESSION['f_num3']<=0){
                            $_SESSION['f_num3']=0;
                        }else{
                            $_SESSION['f_num3']--;
                        }
                        }
                        if(isset($_POST['f_plus3'])){
                            $_SESSION['f_num3']++;
                        }
                        echo $_SESSION['f_num3'];
                        $_SESSION['f_price3']=$result2_price[3]*$_SESSION['f_num3'];
                        
                    ?>            
                    <input type="submit" name="f_plus3" value="+">
                    <?php
                    $_SESSION['f_stock3']=$result2_stock[3]-$_SESSION['f_num3'];
                    echo "<br>stock: ".$_SESSION['f_stock3'];
                      ?>
                
                    <input type="hidden" name="amenity_id_f3" value="<?php echo $result2_id[3]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result2_price[3]; ?>"><br>
        
                </div>
    </div>           
            </div>

        <hr>

    <p>Drinks</p>
            <div class="amty">
                <?php
                $sql1 = "SELECT * FROM amenities WHERE amenity_type = 'Drinks'";
                $result3 = $conn->query($sql1);
                $result3_id = array();
                $result3_name = array();
                $result3_price = array();
                $result3_stock = array();
                while($row3 = $result3->fetch_assoc()){
                   $result3_id[] = $row3['amenity_id'];
                   $result3_name[] = $row3['amenity_name'];
                   $result3_price[] = $row3['amenity_price'];
                   $result3_stock[] = $row3['stock'];
                    }?>

    <div class="amty-box">
        <img src="assets/naturespring-350.png">
            <p class="name"><?php echo $result3_name[0]."<br>Price:".$result3_price[0]; ?></p>
                <div class="counter">
                    
                    <input type="submit" name="d_minus0" value="-">
                    
                    <?php
                        $_SESSION['d_num0']=((isset($_SESSION['d_num0']))?$_SESSION['d_num0']:0);
                        $_SESSION['d_price0']=((isset($_SESSION['d_num0']))?$_SESSION['d_num0']:0);
                        if(isset($_POST['d_minus0'])){
                            if($_SESSION['d_num0']<=0){
                            $_SESSION['d_num0']=0;
                        }else{
                            $_SESSION['d_num0']--;
                        }
                        }
                        if(isset($_POST['d_plus0'])){
                            $_SESSION['d_num0']++;
                        }
                        echo $_SESSION['d_num0'];
                        $_SESSION['d_price0']=$result3_price[0]*$_SESSION['d_num0'];
                    ?>            
                    <input type="submit" name="d_plus0" value="+">
                    <?php
                    $_SESSION['d_stock0']=$result3_stock[0]-$_SESSION['d_num0'];
                    echo "<br>stock: ".$_SESSION['d_stock0'];
                      ?>
                
                    <input type="hidden" name="amenity_id_d0" value="<?php echo $result3_id[0]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result3_price[0]; ?>"><br>
                
                </div>
    </div>



    <div class="amty-box">
        <img src="assets/naturespring-500.png">
            <p class="name"><?php echo $result3_name[1]."<br>Price:".$result3_price[1]; ?></p>
                <div class="counter">
                    
                    <input type="submit" name="d_minus1" value="-">
                    
                    <?php
                        $_SESSION['d_num1']=((isset($_SESSION['d_num1']))?$_SESSION['d_num1']:0);
                        $_SESSION['d_price1']=((isset($_SESSION['d_num1']))?$_SESSION['d_num1']:0);
                        if(isset($_POST['d_minus1'])){
                            if($_SESSION['d_num1']<=0){
                            $_SESSION['d_num1']=0;
                        }else{
                            $_SESSION['d_num1']--;
                        }
                        }
                        if(isset($_POST['d_plus1'])){
                            $_SESSION['d_num1']++;
                        }
                        echo $_SESSION['d_num1'];
                        $_SESSION['d_price1']=$result3_price[1]*$_SESSION['d_num1'];
                        
                    ?>            
                    <input type="submit" name="d_plus1" value="+">
                    <?php
                    $_SESSION['d_stock1']=$result3_stock[1]-$_SESSION['d_num1'];
                    echo "<br>stock: ".$_SESSION['d_stock1'];
                      ?>
                
                    <input type="hidden" name="amenity_id_d1" value="<?php echo $result3_id[1]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result3_price[1]; ?>"><br>
                
                </div>
    </div>


    <div class="amty-box">
        <img src="assets/pepsi-8oz.jpg">
            <p class="name"><?php echo $result3_name[2]."<br>Price:".$result3_price[2]; ?></p>
                <div class="counter">
                    
                    <input type="submit" name="d_minus2" value="-">
                    
                    <?php
                        $_SESSION['d_num2']=((isset($_SESSION['d_num2']))?$_SESSION['d_num2']:0);
                        $_SESSION['d_price2']=((isset($_SESSION['d_num2']))?$_SESSION['d_num2']:0);
                        if(isset($_POST['d_minus2'])){
                            if($_SESSION['d_num2']<=0){
                            $_SESSION['d_num2']=0;
                        }else{
                            $_SESSION['d_num2']--;
                        }
                        }
                        if(isset($_POST['d_plus2'])){
                            $_SESSION['d_num2']++;
                        }
                        echo $_SESSION['d_num2'];
                        $_SESSION['d_price2']=$result3_price[2]*$_SESSION['d_num2'];
                        
                    ?>            
                    <input type="submit" name="d_plus2" value="+">
                    <?php
                    $_SESSION['d_stock2']=$result3_stock[2]-$_SESSION['d_num2'];
                    echo "<br>stock: ".$_SESSION['d_stock2'];
                      ?>
                
                    <input type="hidden" name="amenity_id_d2" value="<?php echo $result3_id[2]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result3_price[2]; ?>"><br>
                
                </div>
    </div>

    <div class="amty-box">
        <img src="assets/mirinda-8.jpg">
            <p class="name"><?php echo $result3_name[3]."<br>Price:".$result3_price[3]; ?></p>
                <div class="counter">
                    
                    <input type="submit" name="d_minus3" value="-">
                    
                    <?php
                        $_SESSION['d_num3']=((isset($_SESSION['d_num3']))?$_SESSION['d_num3']:0);
                        $_SESSION['d_price3']=((isset($_SESSION['d_num3']))?$_SESSION['d_num3']:0);
                        if(isset($_POST['d_minus3'])){
                            if($_SESSION['d_num3']<=0){
                            $_SESSION['d_num3']=0;
                        }else{
                            $_SESSION['d_num3']--;
                        }
                        }
                        if(isset($_POST['d_plus3'])){
                            $_SESSION['d_num3']++;
                        }
                        echo $_SESSION['d_num3'];
                        $_SESSION['d_price3']=$result3_price[3]*$_SESSION['d_num3'];
                        
                    ?>            
                    <input type="submit" name="d_plus3" value="+">
                    <?php
                    $_SESSION['d_stock3']=$result3_stock[3]-$_SESSION['d_num3'];
                    echo "<br>stock: ".$_SESSION['d_stock3'];
                      ?>
                
                    <input type="hidden" name="amenity_id_d3" value="<?php echo $result3_id[3]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result3_price[3]; ?>"><br>
                
                </div>
    </div>           
            </div>

        <hr>
            <p>Extras</p>
            <div class="amty">
                <?php
                $sql1 = "SELECT * FROM amenities WHERE amenity_type = 'Extras' ";
                $result4 = $conn->query($sql1);
                $result4_id = array();
                $result4_name = array();
                $result4_price = array();
                $result4_stock = array();
                while($row4= $result4->fetch_assoc()){
                   $result4_id[] = $row4['amenity_id'];
                   $result4_name[] = $row4['amenity_name'];
                   $result4_price[] = $row4['amenity_price'];
                   $result4_stock[] = $row4['stock'];
                    }?>

    <div class="amty-box">
        <img src="assets/Pillow.jpg">
            <p class="name"><?php echo $result4_name[0]."<br>Price:".$result4_price[0]; ?></p>
                <div class="counter">
                    
                    <input type="submit" name="e_minus0" value="-">
                    
                    <?php
                        $_SESSION['e_num0']=((isset($_SESSION['e_num0']))?$_SESSION['e_num0']:0);
                        $_SESSION['e_price0']=((isset($_SESSION['e_num0']))?$_SESSION['e_num0']:0);
                        if(isset($_POST['e_minus0'])){
                            if($_SESSION['e_num0']<=0){
                            $_SESSION['e_num0']=0;
                        }else{
                            $_SESSION['e_num0']--;
                        }
                        }
                        if(isset($_POST['e_plus0'])){
                            $_SESSION['e_num0']++;
                        }
                        echo $_SESSION['e_num0'];
                        $_SESSION['e_price0']=$result4_price[0]*$_SESSION['e_num0'];
                    ?>            
                    <input type="submit" name="e_plus0" value="+">
                    <?php
                    $_SESSION['e_stock0']=$result4_stock[0]-$_SESSION['e_num0'];
                    echo "<br>stock: ".$_SESSION['e_stock0'];
                      ?>
                
                    <input type="hidden" name="amenity_id_e0" value="<?php echo $result4_id[0]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result4_price[0]; ?>"><br>
                
                </div>
    </div>



    <div class="amty-box">
        <img src="assets/lights.JFIF">
            <p class="name"><?php echo $result4_name[1]."<br>Price:".$result4_price[1]; ?></p>
                <div class="counter">
                    
                    <input type="submit" name="e_minus1" value="-">
                    
                    <?php
                        $_SESSION['e_num1']=((isset($_SESSION['e_num1']))?$_SESSION['e_num1']:0);
                        $_SESSION['e_price1']=((isset($_SESSION['e_num1']))?$_SESSION['e_num1']:0);
                        if(isset($_POST['e_minus1'])){
                            if($_SESSION['e_num1']<=0){
                            $_SESSION['e_num1']=0;
                        }else{
                            $_SESSION['e_num1']--;
                        }
                        }
                        if(isset($_POST['e_plus1'])){
                            $_SESSION['e_num1']++;
                        }
                        echo $_SESSION['e_num1'];
                        $_SESSION['e_price1']=$result4_price[0]*$_SESSION['e_num1'];
                        
                    ?>            
                    <input type="submit" name="e_plus1" value="+">
                    <?php
                    $_SESSION['e_stock1']=$result4_stock[1]-$_SESSION['e_num1'];
                    echo "<br>stock: ".$_SESSION['e_stock1'];
                      ?>
                
                    <input type="hidden" name="amenity_id_e1" value="<?php echo $result4_id[1]; ?>">
                    <input type="hidden" name="amenity_price" value="<?php echo $result4_price[1]; ?>"><br>
                
                </div>
    </div>

                </div>

        <hr>

            <div class="amty">
                <p>Guest Details</p>
                <div class="amty-desc">
                    <?php

                    $_SESSION['total_amenity']=$_SESSION['h_price0']+$_SESSION['h_price1']+$_SESSION['h_price1']+$_SESSION['h_price3']+
                    $_SESSION['f_price0']+$_SESSION['f_price1']+$_SESSION['f_price2']+$_SESSION['f_price3']+
                    $_SESSION['d_price0']+$_SESSION['d_price1']+$_SESSION['d_price2']+$_SESSION['d_price3']+
                    $_SESSION['e_price0']+$_SESSION['e_price1'];
                    ;

                    $sql2 = "SELECT p.payment_amount as room_fee, p.payment_id as payment_id FROM guests g, payments p WHERE g.payment_id=p.payment_id AND g.guest_id='{$_SESSION['guest_id']}'";
                    $result2 = $conn->query($sql2);
                    while($row= $result2->fetch_assoc()){
                        $room_fee=$row['room_fee'];
                        $payment_id=$row['payment_id'];
                    }

                    $_SESSION['total']=$_SESSION['total_amenity']+$room_fee;

                    echo "<p>Guest Name:".$_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname']." </p>
                     <p>Bill ID: ".$_SESSION['bill_id']."</p>
                     <p>Total Amount: ".$_SESSION['total']."(room fee: ".$room_fee.")</p>";
                     echo "aaa".$_SESSION['guest_id'];

                      ?>
                    
                    <button type='submit' name='process'class="amty-btn bluegray">Process Order</button>
                    <button type='submit' name='checkin' class="amty-btn green">Check in</button>
                    </form>

    <?php
    if(isset($_POST['process'])){
        $today=date("Y-m-d");

        //insert date in bull_items
//hygiene
        if($_SESSION['h_num0']!=0){
            $amenity_id=$_POST['amenity_id_h0'];
            $prepareh10 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $prepareh10->bind_param("iisi",$_SESSION['h_num0'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $prepareh10->execute();

            $prepareh11= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $prepareh11->bind_param("ii",$_SESSION['h_stock0'], $amenity_id);
            $prepareh11->execute();      
        }

        if($_SESSION['h_num1']!=0){
            $amenity_id=$_POST['amenity_id_h1'];
            $prepareh10 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $prepareh10->bind_param("iisi",$_SESSION['h_num1'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $prepareh10->execute();

            $prepareh11= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $prepareh11->bind_param("ii",$_SESSION['h_stock1'], $amenity_id);
            $prepareh11->execute();      
        }


        if($_SESSION['h_num2']!=0){
            $amenity_id=$_POST['amenity_id_h2'];
            $prepareh10 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $prepareh10->bind_param("iisi",$_SESSION['h_num2'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $prepareh10->execute();

            $prepareh11= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $prepareh11->bind_param("ii",$_SESSION['h_stock2'], $amenity_id);
            $prepareh11->execute();      
        }

        if($_SESSION['h_num3']!=0){
            $amenity_id=$_POST['amenity_id_h3'];
            $prepareh10 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $prepareh10->bind_param("iisi",$_SESSION['h_num3'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $prepareh10->execute();

            $prepareh11= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $prepareh11->bind_param("ii",$_SESSION['h_stock3'], $amenity_id);
            $prepareh11->execute();      
        }

//drink
        if($_SESSION['d_num0']!=0){
            $amenity_id=$_POST['amenity_id_d0'];
            $prepareh10 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $prepareh10->bind_param("iisi",$_SESSION['d_num0'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $prepareh10->execute();

            $prepareh11= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $prepareh11->bind_param("ii",$_SESSION['d_stock0'], $amenity_id);
            $prepareh11->execute();      
        }

        if($_SESSION['d_num1']!=0){
            $amenity_id=$_POST['amenity_id_d1'];
            $prepareh10 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $prepareh10->bind_param("iisi",$_SESSION['d_num1'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $prepareh10->execute();

            $prepareh11= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $prepareh11->bind_param("ii",$_SESSION['d_stock1'], $amenity_id);
            $prepareh11->execute();      
        }


        if($_SESSION['d_num2']!=0){
            $amenity_id=$_POST['amenity_id_d2'];
            $prepareh10 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $prepareh10->bind_param("iisi",$_SESSION['d_num2'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $prepareh10->execute();

            $prepareh11= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $prepareh11->bind_param("ii",$_SESSION['d_stock2'], $amenity_id);
            $prepareh11->execute();      
        }

        if($_SESSION['d_num3']!=0){
            $amenity_id=$_POST['amenity_id_d3'];
            $prepareh10 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $prepareh10->bind_param("iisi",$_SESSION['d_num3'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $prepareh10->execute();

            $prepareh11= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $prepareh11->bind_param("ii",$_SESSION['d_stock3'], $amenity_id);
            $prepareh11->execute();      
        }


//food
        if($_SESSION['f_num0']!=0){
            $amenity_id=$_POST['amenity_id_f0'];
            $prepareh10 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $prepareh10->bind_param("iisi",$_SESSION['f_num0'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $prepareh10->execute();

            $prepareh11= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $prepareh11->bind_param("ii",$_SESSION['f_stock0'], $amenity_id);
            $prepareh11->execute();      
        }

        if($_SESSION['f_num1']!=0){
            $amenity_id=$_POST['amenity_id_f1'];
            $prepareh10 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $prepareh10->bind_param("iisi",$_SESSION['f_num1'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $prepareh10->execute();

            $prepareh11= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $prepareh11->bind_param("ii",$_SESSION['f_stock1'], $amenity_id);
            $prepareh11->execute();      
        }


        if($_SESSION['f_num2']!=0){
            $amenity_id=$_POST['amenity_id_f2'];
            $prepareh10 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $prepareh10->bind_param("iisi",$_SESSION['f_num2'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $prepareh10->execute();

            $prepareh11= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $prepareh11->bind_param("ii",$_SESSION['f_stock2'], $amenity_id);
            $prepareh11->execute();      
        }

        if($_SESSION['f_num3']!=0){
            $amenity_id=$_POST['amenity_id_f3'];
            $prepareh10 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $prepareh10->bind_param("iisi",$_SESSION['f_num3'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $prepareh10->execute();

            $prepareh11= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $prepareh11->bind_param("ii",$_SESSION['f_stock3'], $amenity_id);
            $prepareh11->execute();      
        }

//extras
        if($_SESSION['e_num0']!=0){
            $amenity_id=$_POST['amenity_id_e0'];
            $prepareh10 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $prepareh10->bind_param("iisi",$_SESSION['e_num0'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $prepareh10->execute();

            $prepareh11= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $prepareh11->bind_param("ii",$_SESSION['e_stock0'], $amenity_id);
            $prepareh11->execute();      
        }

        if($_SESSION['e_num1']!=0){
            $amenity_id=$_POST['amenity_id_e1'];
            $prepareh10 = $conn->prepare("INSERT INTO bill_items(quantity,bill_id,bill_date,amenity_id) VALUES (?,?,?,?)");
            $prepareh10->bind_param("iisi",$_SESSION['e_num1'],$_SESSION['bill_id'],$today,
                $amenity_id);
            $prepareh10->execute();

            $prepareh11= $conn->prepare("UPDATE amenities SET stock=? WHERE amenity_id=?");
            $prepareh11->bind_param("ii",$_SESSION['e_stock1'], $amenity_id);
            $prepareh11->execute();      
        }

        $prepare= $conn->prepare("UPDATE payments SET payment_amount=? WHERE payment_id=?");
        $prepare->bind_param("ii",$_SESSION['total'], $payment_id);
        $prepare->execute();
        unset($_SERVER['PHP_SELF']);
        session_destroy();
        header("location:manager_dashboard.php");
    }

    if(isset($_POST['checkin'])){
        unset($_SERVER['PHP_SELF']);
        session_destroy();
        header("location:manager_dashboard.php");
    }


ob_end_flush();
      ?>

                </div>
            </div>
        </div>
    </body>
