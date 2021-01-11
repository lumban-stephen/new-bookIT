<?php
   session_start();
   ob_start();
   include 'connection.php';
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
                <li><a class="navli" href="manager_dashboard.php">Dashboard</a></li>
                <li><a class="navli" href="manager_revenue.php">Revenue</a></li>
                <li><a class="navli" href="manager_records.php">Records</a></li>
                <li><a class="navli" href="manager_guests.php">Guests</a></li>
                <li><a class="navli" href="manager_room-mgt.php">Room Management</a></li>
                <li><a class="navli" href="manager_staff.php">Staff Management</a></li>
                <li><a class="navli" href="#">Restock Amenities</a></li>
            </ul>
        </nav>
        <div id="content">
        <form method="post" action="">
            <button type="submit" class="Greenbutton" name="add_new" >ADD NEW ITEM</button>
        </form>


<?php
//edit
    if(isset($_SESSION['edit'])){
    unset($_SESSION['edit']); 
    
    echo "<div>
        <form method='post' action='' enctype='multipart/form-data'>
        <label class='Labelform'>Name</label><input type='text' class='mngt' name='name' value='{$_SESSION['name']}'>
        <label class='Labelform'>PRICE</label><input type='number' class='mngt' style='width:20%;' name='price'value='{$_SESSION['price']}'><br>
        <label class='Labelform'>TYPE</label>
        <select name='type' class='mngt' value='{$_SESSION['type']}' style='height:10%;'>
        <option value='Hygiene'>Hygiene</option>
        <option value='Foods'>Foods</option>
        <option value='Drinks'>Drinks</option>
        <option value='Extras'>Extras</option>
        </select>
        <label class='Labelform'>File Upload</label><input type='file' id='file' class='mngt' style='width:40%;' name='file'>
        <input type='hidden' name='id' value='{$_SESSION['id']}'>
        <button type='submit' class='Greenbutton' name='new_edit'>SAVE</button>
        
        </form> 
    </div>";}else if(isset($_POST['add_new'])){

//add new items
        echo "<div>
        <form method='post' action='' enctype='multipart/form-data' >
        <label class='Labelform-Rev'>Name</label><input type='text' class='input-Rev' name='name' required>
        <label class='Labelform-Rev'>PRICE</label><input type='number' class='input-Rev' style='width:20%;' name='price' required><br>
        <label class='Labelform-Rev'>TYPE</label><select name='type' class='input-Rev' required>
            <option value='Hygiene'>Hygiene</option>
            <option value='Foods'>Foods</option>
            <option value='Drinks'>Drinks</option>
            <option value='Extras'>Extras</option>
            </select>
        <label class='Labelform-Rev'>STOCK</label><input type='number' class='input-Rev' name='stock' required><br>
        <label class='Labelform'>File Upload</label><input type='file' id='file' class='mngt' style='width:40%;' name='file' required>
        <button type='submit' class='Greenbutton' name='save' >SAVE</button>
        
        </form> 
    </div>";
    }

//input edited data in amenities
    if(isset($_POST['new_edit'])){
        unset($_SESSION['edit']);
        $name = $_POST['name'];
        $price = $_POST['price'];
        $type = $_POST['type'];
        $id=$_POST['id'];

        $files = $_FILES['file'];
        $filename = $files['name'];
        $tmp = $files['tmp_name'];
        $location = 'assets/'.$filename;
        move_uploaded_file($tmp,$location);

        if(empty($filename)){
            $filename=$_SESSION['image'];
        }

        $prepare= $conn->prepare("UPDATE amenities SET amenity_name =?,amenity_price=?,amenity_type=?,image=?
            WHERE amenity_id=?");
        $prepare->bind_param("sissi", $name,$price,$type,$filename,$id);
        $prepare->execute();
        header("location:manager_restock.php");

    }

//add new amenities
    if(isset($_POST['save'])){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $type = $_POST['type'];
        $stock = $_POST['stock'];

        $files = $_FILES['file'];
        $filename = $files['name'];
        $tmp = $files['tmp_name'];
        $location = 'assets/'.$filename;
        move_uploaded_file($tmp,$location);

    $save = $conn->prepare("INSERT INTO amenities(amenity_name, amenity_price, amenity_type, stock,image) 
        VALUES(?,?,?,?,?)"); 
    $save->bind_param("sisis",$name,$price,$type,$stock,$filename);
    $save->execute();
}       
         

?>
 


        
        <table id="Table">
            <tr>
                <th>IMAGE</th>
                <th>NAME</th>
                <th>PRICE</th>
                <th>TYPE</th>
                <th>STOCK</th>
                <th>RESTOCK</th>
                <th>ACTION</th>
            </tr>
<?php

    $sql = "SELECT * FROM amenities WHERE image IS NOT NULL ORDER BY amenity_type ASC;"; 
                  
    $display = $conn->query($sql);
    
        if($rows = $display != NULL){
//get rid of extra amenities
        while($rows = $display->fetch_assoc()){
            
//if it is not available
            if($rows['stock']<0){
                $rows['stock']="Not Available";
            echo "<tr><form action='' method='post'>
            <td><img src='assets/".$rows['image']."' width=100px height=100px></td>
            <td>". $rows['amenity_name']. "</td>
            <td>". $rows['amenity_price']. "</td>
            <td>". $rows['amenity_type']. "</td>
            <td>". $rows['stock']. "</td>
            <td>
            <input type='hidden' name='amenity_id' value='{$rows['amenity_id']}'>
            </td>


            <td>
            <button type='submit' name='edit'class='Offerbutton'>Edit Information</button>

            <button type='submit' name='activate' class='Greenbutton'>ACTIVATE</button>

            
            </td></form>
            </tr>"; }else{
//if available            
            echo "<tr><form action='' method='post'>
            <td><img src='assets/".$rows['image']."' width=100px height=100px></td>
            <td>". $rows['amenity_name']. "</td>
            <td>". $rows['amenity_price']. "</td>
            <td>". $rows['amenity_type']. "</td>
            <td>". $rows['stock']. "</td>
            <td>
            <input type='number' class='restocknum' name='number'>
            <button type='submit' name='add' class='Greenbutton'>Add</button>
            <input type='hidden' name='amenity_id' value='{$rows['amenity_id']}'>
            </td>


            <td>
            <button type='submit' name='edit'class='Offerbutton'>Edit Information</button>

            <button type='submit' name='deactivate' class='Checkoutbutton' style='width: 80%;'>DEACTIVATE</button>
            <button type='submit' name='delete' class='Graybutton' style='width: 80%;'>DELETE</button>

            
            </td></form>
            </tr>";

            }
                                        }
            echo "</table>";
                            }else{
                                echo "No data here. ";
                            }



//add stocks
    if(isset($_POST['add'])){
        $number=$_POST['number'];
        $amenity_id=$_POST['amenity_id'];
        $stock=$_POST['stock'];
        $stock=$stock+$number;

        $prepare= $conn->prepare("UPDATE amenities SET stock =?
            WHERE amenity_id=?");
        $prepare->bind_param("ii", $stock,$amenity_id);
        $prepare->execute();
        header("location:manager_restock.php");
    }
//when it is DEactivated. stock will be -1
    if(isset($_POST['deactivate'])){
        $number=$_POST['number'];
        $amenity_id=$_POST['amenity_id'];
        $stock=-1;

        $prepare= $conn->prepare("UPDATE amenities SET stock =?
            WHERE amenity_id=?");
        $prepare->bind_param("ii", $stock,$amenity_id);
        $prepare->execute();
        header("location:manager_restock.php");
    }

//when it is DEactivated. image will be deleted
    if(isset($_POST['delete'])){
        $amenity_id=$_POST['amenity_id'];
        $image=NULL;

        $prepare= $conn->prepare("UPDATE amenities SET image =?
            WHERE amenity_id=?");
        $prepare->bind_param("si", $image,$amenity_id);
        $prepare->execute();
        header("location:manager_restock.php");
    }

//when it is Activated. stock will be 0
    if(isset($_POST['activate'])){
        $amenity_id=$_POST['amenity_id'];
        $stock=0;

        $prepare= $conn->prepare("UPDATE amenities SET stock =?
            WHERE amenity_id=?");
        $prepare->bind_param("ii", $stock,$amenity_id);
        $prepare->execute();
        header("location:manager_restock.php");
    }

//after clicking edit. get info about the amenity and input them into SESSION
    if(isset($_POST['edit'])){
        $id = $_POST['amenity_id'];
        $deleteQuery = "SELECT * FROM amenities WHERE amenity_id=$id";

        $result = $conn->query($deleteQuery) or die($conn->error);
        if(count($result)!=NULL){
            $row = $result->fetch_array();
            $price = $row['amenity_price'];
            $type = $row['amenity_type'];
            $name=$row['amenity_name'];
            $image=$row['image'];
        }
        $_SESSION['edit']="edit";
        $_SESSION['price']=$price;
        $_SESSION['type']=$type;
        $_SESSION['name']=$name;
        $_SESSION['id']=$id;
        $_SESSION['image']=$image;
        header("location:manager_restock.php");
    }



           ?>
            </table>




                </div>

    </body>
