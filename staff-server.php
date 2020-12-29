<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'bookit_db';

    $conn = new mysqli($servername,$username,$password,$dbname) or die(mysqli_error($conn));

    $fname = "";
    $mi = "";
    $lname = "";
    $email = "";
    $jobs = "";
    $salary = "";
    $id = 0;

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