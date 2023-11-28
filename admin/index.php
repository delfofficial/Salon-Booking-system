<?php
session_start();
include('../connect.php');
if (!isset($_SESSION['id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
  }
  //check if user has admin role
  if ($_SESSION['role'] !== 1) {
    // Redirect to a non-authorized page or display an error
    echo '<div style="background-color: #ffebee; color: #d32f2f; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: center;">';
      echo '<h1 style="color: #d32f2f;">Access Denied</h1>';
      echo '<p>You are not allowed to access this page.</p>';
      echo '</div>';
      exit();
  }
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('../css.php'); ?>
    <style>
        .navbar{
            display:space-between;
            padding-right:40px;
            /*border: 1px solid #e0e0e0;*/
            /*box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); */



        }
        .navbar ul li{
            list-style: none;

        }
        .welcome{
        height: 400px;
       /* margin:20px; */
        border-radius:15px;
        padding:30px;
        }

    </style>
</head>

<body>
    <div class="navbar d-flex">
        <h2>Home</h2>
        <ul>
            <li>Today's date</li>
            <li>

                <?php 
date_default_timezone_set('Africa/Nairobi');
        
                                $today = date('Y-m-d');
                                echo $today;

                                ?>

            </li>
        </ul>
    </div>
    <div class="welcome bg-warning">
        <h4>Welcome</h4>
        <h2><b>username</b></h2>
        <p>Haven't any idea about doctors? no problem let's jumping to "All Doctors" section or "Sessions"
Track your past and future appointments history.
Also find out the expected arrival time of your doctor or medical consultant.</p>
    </div>
    <?php include('../js.php'); ?>
</body>

</html>