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
            <table>
                
                    <tr>
                        <td>Staff Name<td>
                        <td>Email<td>
                        <td>Salary<td>
                        <td>Work<td>
                        <td>Actions<td>
                    </tr>
                
                    <?php
                    
                        include 'connection.php';
                          
                            $sql = "SELECT user_id AS 'UID', 
                            CONCAT(fname, ' ', MI, ' ', lname) AS 'Staff Name', 
                            email AS 'Email', salary AS 'Salary', 
                            user_type AS 'Job' FROM users;"; 
                  
                            $display = $conn->query($sql);
                  
                      
                            if($rows = $display != NULL){
                                while($rows = $display->fetch_assoc()){
                                    echo
                                        "<tr><td>". $rows['Staff Name']. "</td>
                                        <td>". $rows['Email']. "</td><td>". $rows['Salary']. "</td><td>". $rows['Job']. 
                                        "</td>
                                        <td><button class='Offerbutton'><a href='staff-server.php'>Edit Information</a></button>
                                        <button class='Checkoutbutton'><a>Terminate</a></button></td></tr>"; 
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
                <div class="input-group">
                    <label>Name</label>
                    <input type="text" name="name" value="">
                </div>
                <div class="input-group">
                    <label>Address</label>
                    <input type="text" name="address" value="">
                </div>
                <div class="input-group">
                    <button class="btn" type="submit" name="save" >Save</button>
                </div>
	        </form>
        </div>
    </body>