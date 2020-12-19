<?php
    include 'connection.php';

    if(isset($_POST['save'])){
        $fname = $_POST['fname'];
        $mi = $_POST['mi'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $jobs = $_POST['jobs'];
        $salary = $_POST['salary'];

        $insert = "INSERT INTO users(fname, lname, MI, email, password, user_type, salary) 
                VALUES('$fname','$lname', '$mi', '$password', '$jobs', '$salary')"; 
                  
        $conn = $conn->query($insert);

        $prepare = $conn->prepare("INSERT INTO users(fname, lname, MI, email, password, user_type, salary) 
        VALUES(?,?,?,?,?,?,?)");
        $prepare->bind_param("ssssssf",$fname,$lname,$mi,$email,$password,$jobs,$salary);
        $prepare->execute();

        header('location: manager_staff.php');
    }
?>