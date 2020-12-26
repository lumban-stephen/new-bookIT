<?php
    include 'connection.php';
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
                <p>Welcome Manager,</p>
            </div>
        </div>
        </header>
        <?php
            if(isset($_POST['logout'])){
                session_destroy();
                header("location:index.php");
            }
        ?>
        <nav><ul>
                <li id="logoli"><img src="assets/bookIT_Logo.png"></li>
                <li><a href="manager_dashboard.php">Dashboard</a></li>
                <li><a href="manager_revenue.php">Revenue</a></li>
                <li><a href="manager_records.php">Records</a></li>
                <li><a href="manager_guests.php">Guests</a></li>
                <li><a href="manager_room-mgt.php">Room Management</a></li>
                <li><a href="#">Staff Management</a></li>
                <li><a href="manager_restock.php">Restock Amenities</a></li>
            </ul>
        </nav>
        <div id="content">
            <table id="Table">
                
                    <tr>
                        <th>Staff Name</th>
                        <th>Email</th>
                        <th>Salary</th>
                        <th>Work</th>
                        <th>Actions</th>
                    </tr>
                
                    <?php                                                     
                            $sql = "SELECT user_id AS 'UID', 
                            CONCAT(fname, ' ', MI, ' ', lname) AS 'Staff Name', 
                            email AS 'Email', salary AS 'Salary', 
                            user_type AS 'Job' FROM users;"; 
                  
                            $display = $conn->query($sql);
                  
                      
                            if($rows = $display != NULL){
                                while($rows = $display->fetch_assoc()){
                                    echo
                                        "<tr><td>". $rows['Staff Name']. "</td>
                                             <td>". $rows['Email']. "</td>
                                             <td>". $rows['Salary']. "</td>
                                             <td>". $rows['Job']. "</td>
                                             <td><button class='Offerbutton'><a href='manager_staff.php?edit=".$rows['UID']."'>Edit Information</a></button>
                                                 <button class='Checkoutbutton'><a href='staff-server.php?delete=".$rows['UID']."'>Terminate</a></button></td>
                                        </tr>"; 
                                        }
                                    echo "</table>";
                            }else{
                                echo "No staff here. ";
                            }
                            $conn->close();        
                          
                    ?>
            </table>
            <br>
            <hr>
            <br>                
            <form method="post" action="staff-server.php" class="staffgrid">
                <span class="staffbox1">
                    <label class='Labelform-staff'>First Name</label><input type="text" class='input-staff' name="fname" value="<?php echo $fname;?>"></span>
                <span class="staffbox2">
                    <label class='Labelform-staff'>Middle Initial</label><input type="text" class='input-staff' name="mi"value="<?php echo $mi;?>"></span>
                <span class="staffbox3">
                    <label class='Labelform-staff'>Last Name</label><input type="text" class='input-staff' name="lname" value="<?php echo $lname;?>"></span>
                <span class="staffbox4">
                    <label class='Labelform-staff'>Email</label><input type="email" class='input-staff' name="email" value="<?php echo $email;?>"required></span>
                <span class="staffbox5">        
                    <label class='Labelform-staff'>Password</label><input type="password" class='input-staff' name="password" value=""required></span>
                <span class="staffbox6">
                    <label class='Labelform-staff'>Job</label><select name="jobs" class='input-staff' id="jobs">
                        <option value="Receptionist">Receptionist</option>
                        <option value="Admin">Manager</option>
                    </select></span>
                <span class="staffbox7">
                <label class='Labelform-staff'>Salary Per Day</label><input type="text" class='input-staff' name="salary" value="<?php echo $salary;?>"></span>
                
                <?php 
                    if($update == true):
                ?>
                <button type="submit" class="Greenbutton" name="update" >Update</button>
                <?php else: ?>
                <button type="submit" class="Greenbutton" name="save" >Save</button>
                <?php endif; ?>
	        </form>
        </div>
    </body>