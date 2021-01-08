<?php
    include 'connection.php'; //ensures connection with the database.
    include 'staff-server.php'; //creates a server file for the functions in this page.
    error_reporting(0);
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
        <br>
        <h2>Staff</h2>
            <table id="Table">
        <?php       
                echo "
                    <tr>
                    <th>Staff Name</th>
                    <th>Email</th>
                    <th>Salary</th>
                    <th>Work</th>
                    <th>Actions</th>
                    </tr>
                    "; 
                    $sql = "SELECT user_id AS 'UID', 
                    CONCAT(fname, ' ', MI, ' ', lname) AS 'Staff Name', 
                    email AS 'Email', salary AS 'Salary', 
                    user_type AS 'Job' FROM users;"; 
                    /*Query is created for all of the data from the users table*/


                    $display = $conn->query($sql);
                    /*Query is called and the contents is placed into $display variable.*/

                    /*Using fetch_assoc() on $display variable, it is turned into an associative array 
                    and placed inside $rows variable. */
                    while($rows = $display->fetch_assoc()){
                        /*The contents of the table is echoed using the $rows variable. It also uses $_SERVER['PHP_SELF'] 
                        as the form action. While there are still rows to fetch it will continuously put out into the table. */
                        echo "<tr><td>". $rows['Staff Name']. "</td>
                              <td>". $rows['Email']. "</td>
                              <td>". $rows['Salary']. "</td>
                              <td>". $rows['Job']. "</td>
                              <td>
                              <form action='".$_SERVER['PHP_SELF']."' method='POST'>
                              <input type='hidden' name='user_id' value= '".$rows['UID']."'>
                              <button class='Offerbutton' name='update' type='submit'>Edit Information</button>
                              </form>
                              <button class='Checkoutbutton'><a href='staff-server.php?delete=".$rows['UID']."'>Terminate</a></button></td>
                              </tr>"; 
                            /*Inside this table are the actions button that contains edit info and the terminate function. */  
                    }
                    echo "</table>
                        </table>
                        <br>
                        <hr>
                        <br>
                        ";
          
                if(isset($_POST['update'])){
                    /* Gets the specific row of data in the table according to post data in form. */  

                    $update = "SELECT user_id, 
                            fname, MI, lname, 
                            email AS 'Email', salary AS 'Salary', 
                            user_type AS 'Job' FROM users WHERE user_id='".$_POST['user_id']."'";

                    $updateQuery = $conn->query($update);
                    /* Contents of the query is placed in $updateQuery variable. */
                    $updateResult = $updateQuery->fetch_assoc();
                    /* The query is turned into an assoc array placed in $updateResult variable. */
                
              
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
                        /* This is the new form, that is created when you edit info. */
                }

                //Update Data from table
                if(isset($_POST['updateData'])){
                    $edit = "UPDATE users SET fname='".$_POST['fname']."', lname='".$_POST['lname']."', mi='".$_POST['mi']."', email='".$_POST['email']."',
                    password='".$_POST['password']."', user_type='".$_POST['jobs']."', salary='".$_POST['salary']."' WHERE user_id='".$_POST['user_id']."'";

                if ($conn->query($edit) === TRUE) {
                    echo "Query updated successfully";
                    header("Refresh:0");
                    }else {
                    echo "Error: " . $edit . "<br>" . $conn->error;
                    }
                }
        ?>                
            <form method="post" action="staff-server.php" class="staffgrid">
                <span class="staffbox1">
                    <label class='Labelform-staff'>First Name</label><input type="text" class='input-staff' id="fname" name="fname" value=""></span>
                <span class="staffbox2">
                    <label class='Labelform-staff'>Middle Initial</label><input type="text" class='input-staff' id="mi" name="mi"value=""></span>
                <span class="staffbox3">
                    <label class='Labelform-staff'>Last Name</label><input type="text" class='input-staff' id="lname" name="lname" value=""></span>
                <span class="staffbox4">
                    <label class='Labelform-staff'>Email</label><input type="email" class='input-staff' id="email" name="email" value=""required></span>
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
                <!--This is the form when you want to add a new staff -->
	        </form>
        </div>
    </body>