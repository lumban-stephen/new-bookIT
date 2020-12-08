<?php
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
          <form action="" method="post">
              <div>Log In</div>
              <input type = "text" name = "username" placeholder = "Username" required>
              <input type = "password" name = "password" placeholder = "Password" required>
              <button type = "submit" class="submitlogin" name = "login">Login</button>
        </form>
            <?php
                include("connection.php");

                if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
                    $user=$_POST['username'];
                    $pwd=$_POST['password'];

                    $sql = "SELECT * FROM users WHERE Username = '$user' AND Password = '$pwd'";
                    $result = $conn->query($sql);
                    $count=mysqli_num_rows($result);
                    if($count>0){
                        if($usertype == 'Receptionist'){
                            
                        }else{
                            
                        }
                    }else {
                        echo "Invalid credentials.";
                    }
                } 
            
                $conn->close();
            ?>
        
    </body>