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
?>