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
        
        <link rel="stylesheet" href="style.css">
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
        
        <table id="Table">
            <tr>
                <th>NAME</th>
                <th>PRICE</th>
                <th>TYPE</th>
                <th>STOCK</th>
                <th>RESTOCK</th>
                <th>ACTION</th>
            </tr>
<?php
include 'connection.php';
    $sql = "SELECT * FROM amenities;"; 
                  
    $display = $conn->query($sql);
    
        if($rows = $display != NULL){
        while($rows = $display->fetch_assoc()){


            echo "<tr><form action='' method='post'>
            <td>". $rows['amenity_name']. "</td>
            <td>". $rows['amenity_price']. "</td>
            <td>". $rows['amenity_type']. "</td>
            <td>". $rows['stock']. "</td>
            <td>
            <input type='number' name='number'>
            <button type='submit' name='add'class='Greenbutton'>Add</button>
            <input type='hidden' name='amenity_id' value='{$rows['amenity_id']}'>
            <input type='hidden' name='stock' value='{$rows['stock']}'>
            </td>


            <td>
            <button type='submit' name='edit'class='Offerbutton'>Edit Information</button>
            <button type='submit' name='delete'class='Checkoutbutton'>DELETE</button>

            
            </td></form>
            </tr>"; 
                                        }
            echo "</table>";
                            }else{
                                echo "No data here. ";
                            }

    if(isset($_POST['add'])){
        $number=$_POST['number'];
        $amenity_id=$_POST['amenity_id'];
        $stock=$_POST['stock'];
        $stock=$stock+$number;

        $prepare= $conn->prepare("UPDATE amenities SET stock =?
            WHERE amenity_id=?");
        $prepare->bind_param("ii", $stock,$amenity_id);
        $prepare->execute();
    }

    if(isset($_POST['delete'])){
        $amenity_id=$_POST['amenity_id'];
    
        $sql2 = "DELETE FROM amenities WHERE amenity_id = $amenity_id";
    }



                            $conn->close();        
                          
                    ?>
            </table>




                </div>

    </body>
