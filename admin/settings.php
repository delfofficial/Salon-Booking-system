<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
include('../css.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .set{
            border: 1px solid #e0e0e0;
            box-shadow:0 2px 4px rgba(0, 0, 0, 0.1);

        }
    </style>
</head>
<body>
    <div class="accountSettings my-30 set">
        <h2 class="text-warning">Home settings</h2>
        <p>edit home details</p>
    </div>
    <div class="viewAccount set ">
        <h2 class="text-warning">Services settings</h2>
        <p>Edit service details.</p>

    </div>
    <div class="delete set">
        <h2 class="text-danger">Delete account</h2>
        <p>will permanently delete your account</p>
    </div>
    <?php
include('../js.php');
?>
</body>
</html>