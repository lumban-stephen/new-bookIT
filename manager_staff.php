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
        <nav><ul>
                <li><a href="manager_dashboard.php">Dashboard</a></li>
                <li><a href="manager_revenue.php">Revenue</a></li>
                <li><a href="manager_records.php">Records</a></li>
                <li><a href="manager_guests.php">Guests</a></li>
                <li><a href="manager_room-mgt.php">Room Management</a></li>
                <li><a href="#">Staff Management</a></li>
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
            <form method="post" action="staff-server.php" >
                <div>
                    <label class='Labelform'>First Name</label><input type="text" class='mngt' name="fname" value="<?php echo $fname;?>">
                    <label class='Labelform'>Middle Initial</label><input type="text" class='mngt' name="mi"value="<?php echo $mi;?>">
                    <label class='Labelform'>Last Name</label><input type="text" class='mngt' name="lname" value="<?php echo $lname;?>">
                </div>
                <div>
                    <label class='Labelform'>Email</label><input type="email" class='mngt' name="email" value="<?php echo $email;?>"required>
                    <label class='Labelform'>Password</label><input type="password" class='mngt' name="password" value=""required>
                </div>
                <div>
                    <label class='Labelform'>Job</label><select name="jobs" class='mngt' id="jobs">
                        <option value="Receptionist">Receptionist</option>
                        <option value="Admin">Manager</option>
                    </select>
                <label class='Labelform'>Salary Per Day</label><input type="text" class='mngt' name="salary" value="<?php echo $salary;?>">
                </div>
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