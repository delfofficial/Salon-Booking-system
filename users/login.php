<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
include('../navbar.php');
include('../css.php');
include('../connect.php');
if (isset($_POST['login'])) {
    $email=$_POST['email'];
    $password=$_POST['password'];

    // Check against the stylist table
$stylist_query = "SELECT * FROM stylists WHERE email='$email' AND password = '$password'";
$stylist_result = mysqli_query($conn, $stylist_query);

// Check against the users table
    $sql="select * from users where email='$email' AND password='$password'";
    $result=mysqli_query($conn,$sql);

    $row=mysqli_num_rows($result);
    $rsl=mysqli_fetch_assoc($result);

    $row1=mysqli_num_rows($stylist_result);
    $rsl1=mysqli_fetch_assoc($stylist_result);

    $name=$rsl['name'];
    $_SESSION['name'] = $name;
    $_SESSION['id'] = $rsl['id'];
    $_SESSION['role'] = $rsl['role'];

    if ($row>0) {
      if ($role == 1) {
        // Admin login
        // Redirect to admin page
        echo "logged in successfully";
      echo "<script>window.location.href = '../admin/adminNavbar.php';</script>";
    } else {
        // Ordinary user login
        // Redirect to user page
        echo "logged in successfully";
      echo "<script>window.location.href = '../index.php';</script>";

    }
      
    }
    elseif (mysqli_num_rows($stylist_result) > 0) {
    // Stylist found in the stylist table
    // Redirect to stylist page
    echo "logged in successfully";
      echo "<script>window.location.href = '..stylists/index.php';</script>";
    }else{
        echo "invalid credentials";
    }
}
?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>
 <form action="" method="POST" enctype="multipart/form-data" style="width:400px;  margin:auto;  align-items:center; text-align:center; margin-bottom:20px;">
        
        <input type="hidden" name="_method" value="POST">

        <div class="form-group mb-20">
            <label >Email</label>
            <input type="email" name="email" class="form-control"   required="">
          </div>

          <div class="form-group mb-20">
            <label>Password</label>
            <input type="number" name="password" class="form-control"  required="">
          </div>

        <button type="submit" class="btn btn-warning my-20" name="login">Login</button> <br>
        <label for="" class="sub-text" style="font-weight: 280;">Don't have an account&#63; </label>
        <a href="users/register.php" class="hover-link1 non-style-link">Register</a>


      </form>
    <?php

include('../js.php');

?>  
 </body>
 </html>