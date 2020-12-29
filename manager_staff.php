<?php
    include 'connection.php';
    include 'staff-server.php';
?>
<?php 

$sql = "SELECT user_id AS 'UID', 
CONCAT(fname, ' ', MI, ' ', lname) AS 'Staff Name', 
email AS 'Email', salary AS 'Salary', 
user_type AS 'Job' FROM users;"; 

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($conn, $sql);

    if (count($record) != 1 ) {
        $arr = mysqli_fetch_array($record);
        $fname = $arr['fname'];
        $mi = $arr['mi'];
        $lname = $arr['lname'];
        $email = $arr['email'];
        $password = $arr['password'];
        $jobs = $arr['jobs'];
        $salary = $arr['salary'];
    }
}
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
        <?php if (isset($_SESSION['message'])): ?>
            <div class="msg">
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                ?>
            </div>
        <?php endif ?>
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
        <nav>
            <ul>
                <li id="logoli"><img src="assets/bookIT_Logo.png"></li>
                <li><a class="navli" href="manager_dashboard.php">Dashboard</a></li>
                <li><a class="navli" href="manager_revenue.php">Revenue</a></li>
                <li><a class="navli" href="manager_records.php">Records</a></li>
                <li><a class="navli" href="manager_guests.php">Guests</a></li>
                <li><a class="navli" href="manager_room-mgt.php">Room Management</a></li>
                <li><a class="navli" href="manager_staff.php">Staff Management</a></li>
                <li><a class="navli" href="manager_restock.php">Restock Amenities</a></li>
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
                    $display = $conn->query($sql);
                    print_r($display);
                    while($rows = mysqli_fetch_array($display)){
                        echo "<tr><td>". $rows['Staff Name']. "</td>
                              <td>". $rows['Email']. "</td>
                              <td>". $rows['Salary']. "</td>
                              <td>". $rows['Job']. "</td>
                              <td>
                              <form action='".$_SERVER['PHP_SELF']."' method='post'>
                              <input type='hidden' name='user_id' value='' ".$rows["UID"].">
                              <button class='Offerbutton' name='update' type='submit'>Edit Information</button>
                              </form>
                              <button class='Checkoutbutton'><a href='staff-server.php?delete=".$rows['UID']."'>Terminate</a></button></td>
                              </tr>"; 
                    }
                    echo "</table>";
            ?>
            </table>
            <br>
            <hr>
            <br>
            <?php
                if(isset($_POST['update'])){

                    $update = "SELECT user_id, 
                            fname, MI, lname, 
                            email AS 'Email', salary AS 'Salary', 
                            user_type AS 'Job' FROM users;"; 

                    $updateQuery = $conn->query($update);
                    $updateResult = $updateQuery->fetch_assoc();

                echo '
                <div>
                <form method="post" action="'.$_SERVER["PHP_SELF"].'" class="staffgrid">
                <span class="staffbox1">
                    <label class="Labelform-staff">First Name</label><input type="text" class="input-staff" id="fname" name="fname" value="'.$updateResult["fname"].'"></span>
                <span class="staffbox2">
                    <label class="Labelform-staff">Middle Initial</label><input type="text" class="input-staff" id="mi" name="mi"value="'.$updateResult["MI"].'"></span>
                <span class="staffbox3">
                    <label class="Labelform-staff">Last Name</label><input type="text" class="input-staff" id="lname" name="lname" value="'.$updateResult["lname"].'"></span>
                <span class="staffbox4">
                    <label class="Labelform-staff">Email</label><input type="email" class="input-staff" id="email" name="email" value="'.$updateResult["Email"].'"required></span>
                <span class="staffbox5">        
                    <label class="Labelform-staff">Password</label><input type="password" class="input-staff" id="password" name="password" value=""required></span>
                <span class="staffbox6">
                    <label class="Labelform-staff">Job</label><select name="jobs" class="input-staff" id="jobs">
                        <option value="Receptionist">Receptionist</option>
                        <option value="Admin">Manager</option>
                    </select></span>
                <span class="staffbox7">
                <label class="Labelform-staff">Salary Per Day</label><input type="text" class="input-staffsal" id="salary" name="salary" value="'.$updateResult["Salary"].'"></span>
                <input type="hidden" name="user_id" value="'.$updateResult["user_id"].'">
                <span class="staffbox8">
                
                
                <button type="submit" class="Greenbutton" name="updateData" >Update</button>
                <a class="Checkoutbutton" href="manager_staff.php">Cancel</a>
	        </form>
                    </div><br><br><hr><br><br>
                ';
                }

                //Update Data from table
                if(isset($_POST['updateData'])){
                    $edit = "UPDATE users SET fname='".$_POST['fname']."', lname='".$_POST['lname']."', mi='".$_POST['mi']."', email='".$_POST['email']."',
                    password='".$_POST['password']."', user_type='".$_POST['jobs']."', salary='".$_POST['salary']."' WHERE user_id='".$_POST['user_id']."'";

                if ($conn->query($edit) === TRUE) {
                    echo $_POST['user_id']." updated successfully";
                    }else {
                    echo "Error: " . $edit . "<br>" . $conn->error;
                    }
                }
                ?>                
            <form method="post" action="staff-server.php" class="staffgrid">
                <span class="staffbox1">
                    <label class='Labelform-staff'>First Name</label><input type="text" class='input-staff' id="fname" name="fname" value="<?php echo $fname;?>"></span>
                <span class="staffbox2">
                    <label class='Labelform-staff'>Middle Initial</label><input type="text" class='input-staff' id="mi" name="mi"value="<?php echo $mi;?>"></span>
                <span class="staffbox3">
                    <label class='Labelform-staff'>Last Name</label><input type="text" class='input-staff' id="lname" name="lname" value="<?php echo $lname;?>"></span>
                <span class="staffbox4">
                    <label class='Labelform-staff'>Email</label><input type="email" class='input-staff' id="email" name="email" value="<?php echo $email;?>"required></span>
                <span class="staffbox5">        
                    <label class='Labelform-staff'>Password</label><input type="password" class='input-staff' id="password" name="password" value=""required></span>
                <span class="staffbox6">
                    <label class='Labelform-staff'>Job</label><select name="jobs" class='input-staff' id="jobs">
                        <option value="Receptionist">Receptionist</option>
                        <option value="Admin">Manager</option>
                    </select></span>
                <span class="staffbox7">
                <label class='Labelform-staff'>Salary Per Day</label><input type="text" class='input-staffsal' id="salary" name="salary" value="<?php echo $salary;?>"></span>
                <span class="staffbox8">
                <button type="submit" class="Greenbutton" name="save" >Save</button>
                
	        </form>
        </div>
    </body>