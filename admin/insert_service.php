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
  

include('../connect.php');
if (isset($_POST['insert_service'])) {
    $service_name=$_POST['service_name'];

    $banner=$_FILES['banner']['name'];
    $image1=$_FILES['image1']['name'];
    $image2=$_FILES['image2']['name'];

    $temp_banner = $_FILES['banner']['tmp_name'];
    $temp_image1 = $_FILES['image1']['tmp_name'];
    $temp_image2 = $_FILES['image2']['tmp_name'];


    move_uploaded_file($temp_banner,"../images/$banner");
    move_uploaded_file( $temp_image1,"../images/$image1");
    move_uploaded_file( $temp_image2,"../images/$image2");

    $sql="insert into services (service_name, banner, image1, image2) values('$service_name','$banner',' $image1',' $image2')";
    $result=mysqli_query($conn, $sql);
    if ($result) {
        echo 'service nserted successfully';
    }
    else
    echo 'error inserting service';
} 

mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Add Service</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="input-group">
        <label>Service name</label>

            <input type="text" placeholder="insert service" name="service_name">
        </div>
        <div>
            <label>Banner image</label>
            <input type="file" name="banner" required>
        </div>
        <div>
            <label>Image1</label>
            <input type="file" name="image1" required>
        </div>
        <div>
            <label>Image2</label>
            <input type="file" name="image2" required>
        </div>
        
        <div>
            <label for="description">Description</label>
            <textarea name="description" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="input-group">
            <input type="submit" name="insert_service" value="insert service">

        </div>
    </form>


</body>

</html>