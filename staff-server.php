<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'bookit_db';

    $conn = new mysqli($servername,$username,$password,$dbname) or die(mysqli_error($conn));

    $fname = '';
    $mi = "";
    $lname = "";
    $email = "";
    $job = "";
    $salary = "";
    $update = false;
    
    session_start();

    if(isset($_POST['save'])){
        $fname = $_POST['fname'];
        $mi = $_POST['mi'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $jobs = $_POST['jobs'];
        $salary = $_POST['salary'];

        $insert = "INSERT INTO users(fname, lname, MI, email, password, user_type, salary) 
                VALUES('$fname','$lname', '$mi', '$email', '$password', '$jobs', '$salary')"; 
                  
        $conn->query($insert) or die($conn->error);

        header('location: manager_staff.php');
    }

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        
        $deleteQuery = "DELETE FROM users WHERE user_id=$id";

        $conn->query($deleteQuery) or die($conn->error);

        header('location: manager_staff.php');
    }

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;
        $deleteQuery = "SELECT * FROM users WHERE user_id=$id";

        $result = $conn->query($deleteQuery) or die($conn->error);
        if(count($result)!=NULL){
            $row = $result->fetch_array();
            $fname = $row['fname'];
            $mi = $row['mi'];
            $lname = $row['lname'];
            $email = $row['email'];
            $job = $row['job'];
            $salary = $row['salary'];
        }
        header('location: manager_staff.php');
    }
?>