<?php
   session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BookIT</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
        <div id="header">
        <img src="assets/bookIT_Logo.png">
        <div class="right-float">
                <a>
                    <form method="post" action="#">
                        <button class="Logoutbutton" name="logout">Logout</button>
                    </form>
                </a>
            </div>
            <div class="right-float">
                <p>Welcome Receptionist  </p>
            </div>
        </div>
        </header>
        <?php
            if(isset($_POST['logout'])){
                session_destroy();
                header("location:index.php");
            }
        ?>
        <nav>
        <ul>
                <li id="logoli"><a href="receptionist_dashboard.php"><img src="assets/bookIT_Logo.png"></li>
                <li><a class="navli" href="receptionist_dashboard.php">Dashboard</a></li>
                <li><a class="navli" href="receptionist_checkin.php">Check In</a></li>
                <li><a class="navli" href="receptionist_checkout.php">Check Out</a></li>
                <li><a class="navli" href="receptionist_reservation.php">Reservation</a></li>
                <li><a class="navli" href="receptionist_records.php">Records</a></li>
                <li><a class="navli" href="#">To Do List</a></li>
                <li><a class="navli" href="receptionist_guests.php">Guests</a></li>
            </ul>
        </nav>
        <div id="content">
            <!--Code Here only-->
            <!--To Do List page code in here-->

    <?php
        include 'connection.php';
        error_reporting(0);

        $sql = "SELECT task_id,task_name,task_desc
    FROM task 
    WHERE task_status!='COMPLETE'";

    $result = $conn->query($sql);

    if(mysqli_num_rows($result) > 0){
    echo "<table id='Table'>
            <th>Task Name</th>
            <th>Task Description</th>
            <th>Action</th><div style='overflow-y:auto;'>";
    while($row = $result->fetch_assoc()){
        echo "<tr><td><p>".$row['task_name']."</p></td><td><h3>".$row['task_desc']."</td>";
        echo "<form method='post' action=''>
        <input type='hidden' name='task_id' value='{$row['task_id']}'><td>
        <input type='submit' name='done' value='DONE' class='Checkoutbutton'>
        </h3></form></td></tr>";}
    echo "</div>";    
    }else{
        echo 'No Task';
    }

    if(isset($_POST['done'])){
        $task_id=$_POST['task_id'];
        $task_status="COMPLETE";
        $prepare1= $conn->prepare("UPDATE task SET task_status =? WHERE task_id=?");
            $prepare1->bind_param("si", $task_status, $task_id);
            $prepare1->execute();
        header("location:receptionist_toDoList.php");
    }

?>
    
    <form action="" method="POST">
        <label class='Labelform'>Task name</label><input type="text" name="task_name" class="booking" placeholder="task name" required>
        <br>
        <label class='Labelform'>Task description</label><input type="text" name="task_desc" class="booking" placeholder="task description" required>
        <br>
        <input type="submit" name="add" value="add" class="Greenbutton">
    </form>

<?php
if(isset($_POST['add'])){
    $task_name=$_POST['task_name'];
    $task_desc=$_POST['task_desc'];
    $task_status="INCOMPLETE";

    //create data in customers
        $prepare2 = $conn->prepare("INSERT INTO task(task_name,task_desc,task_status) VALUES (?,?,?)");
            $prepare2->bind_param("sss",$task_name,$task_desc,$task_status);
            $prepare2->execute();
        header("location:receptionist_toDoList.php");
}


  ?>

        </div>
    </body>

    </body>
