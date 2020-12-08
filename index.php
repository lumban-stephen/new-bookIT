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
    <body>
          <!-- <form action="" method="post">
              <div>Log In</div>
              <input type = "text" name = "username" placeholder = "Username" required>
              <input type = "password" name = "password" placeholder = "Password" required>
              <button type = "submit" class="submitlogin" name = "login">Login</button>
        </form> -->
            <div id="login-form">
                <form action="" method="post">
                    <input type="email" name="email" placeholder="Enter email" required>
                    <input type="password" name="password" placeholder="Enter password" required>
                    <button name="login">Log in</button>
                </form>
            </div>
            <?php
                    if(isset($_POST['login'])){
                    $user=$_POST['email'];
                    $pwd=$_POST['password'];

                    $sql = "SELECT * FROM users WHERE email = '$user' AND Password = '$pwd'";
                    $result = $conn->query($sql);

                    if($row = $result->fetch_assoc()){
                        $_SESSION['user_id']=$row['user_id'];
                        $_SESSION['username']=$row['Username'];
                    
                    if($row['user_type'] === "Receptionist"){
                            header('location:receptionist_dashboard.php');
                    }else if($row['user_type'] === "Admin"){ 
                        header("location:manager_dashboard.php");
                    }
                    else{
                        header("location:not-yet-working.php");
                    }
                    
                    }}
                
                $conn->close();
          ?>
    </body>