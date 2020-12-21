<?php
session_start();
include("connection.php");

if(isset($_GET['enable'])){
    $id = $_GET['enable'];

    $enableQuery = "UPDATE FROM rooms SET room_status = 'Available' WHERE room_id=$id";
    
}  
?>

?>