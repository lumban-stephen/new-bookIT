<?php
    include 'connection.php';
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
?>