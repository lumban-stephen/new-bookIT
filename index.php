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
        <title>Log In</title>
        <link rel="stylesheet" href="style.css"> 
    </style>
    </head>
    <body class="loginbody">
    <div class="box-head"></div>
    <div class="login_container">
    <div class="login_flex">
    <div class="content-image">
        <img src="assets/bookIT_Logo.png">
    </div>
    </div>
    <div class="login_flex1">
            <div id="login-form">
                <h1>Log-in</h1>
                <!--Creates a form with a post method for email login and password login -->
                <form action="" method="post">
                    <input type="email" class="field" name="email" placeholder="Enter email" required>
                    <input type="password" class="field" name="password" placeholder="Enter password" required><br><br>
                    <button class="Greenbutton"name="login">Log in</button>   
                </form>
            </div>
            <?php
                    /*if the login button from the form above is set, it'll take the post values into its assigned variables
                    $user for email and $pwd for password*/
                    if(isset($_POST['login'])){
                    $user=$_POST['email'];
                    $pwd=$_POST['password'];

                    $sql = "SELECT * FROM users WHERE email = '$user' AND Password = '$pwd'";
                    /*This is the query that makes sure that the email and password are within the users table. */
                    $result = $conn->query($sql);
                    /*This is an OOP approach to get the query we created into the $result variable. */


                        if($row = $result->fetch_assoc()){
                        /*We then use the $result variable and turn it into an associative array that is then placed in
                        $row variable. */

                            $_SESSION['user_id']=$row['user_id'];
                            $_SESSION['username']=$row['Username'];
                        /* We place each of this row values into session variables with the same name so we may be able to
                        use the specific user for future references to the session. */

                        if($row['user_type'] === "Receptionist"){
                                header('location:receptionist_dashboard.php');
                                /* From the $row associative array, we check the user_type if it is receptionist.
                                If the user type is a "Receptionist" it is then sent to the receptionist dashboard. */
                        }else if($row['user_type'] === "Admin"){ 
                            header("location:manager_dashboard.php");
                            /* From the $row associative array, we check the user_type if it is a manager.
                                If the user type is an "Admin" it is then sent to the manager dashboard. */
                        }
                    }
                }
                $conn->close();
          ?>
        </div>
    </div>
    <div class="box-foot"></div>
    </body>