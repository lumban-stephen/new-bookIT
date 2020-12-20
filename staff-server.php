<?php
    session_start();

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'bookit_db';

    $conn = new mysqli($servername,$username,$password,$dbname) or die(mysqli_error($conn));

    $fname = "";
    $mi = "";
    $lname = "";
    $email = "";
    $password = "";
    $jobs = "";
    $salary = "";
    $id = 0;
	$update = false;

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
        $_SESSION['message'] = "Address saved"; 
        header('location: manager_staff.php');
    }

    if(isset($_POST['edit'])){
        $id = $_POST['id'];
        $fname = $_POST['id'];
        $mi = $_POST['id'];
        $lname = $_POST['id'];
        $email = $_POST['id'];
        $password = $_POST['id'];
        $jobs = $_POST['id'];
        $salary = $_POST['id'];
        $update = true;

        $editQuery = "UPDATE users SET fname='$fname', lname='$lname', mi='$mi', email='$email',
                      password='$password', user_type='$jobs', salary='$salary' WHERE user_id=$id";

        $conn->query($deleteQuery) or die($conn->error);
        $_SESSION['message'] = "Address updated!"; 
        header('location: index.php');
    }

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        
        $deleteQuery = "DELETE FROM users WHERE user_id=$id";

        $conn->query($deleteQuery) or die($conn->error);

        header('location: manager_staff.php');
    }  
?>