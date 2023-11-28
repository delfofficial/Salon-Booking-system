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

if (isset($_POST['insert_stylist'])) {
    $stylist_name=$_POST['name'];
    $title=$_POST['title'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $description=$_POST['description'];
    $services=$_POST['services'];
    $address=$_POST['address'];
    $password=$_POST['password'];

    $stylist_image=$_FILES['stylist_image']['name'];
    $temp_stylist_image=$_FILES['stylist_image']['tmp_name'];

    move_uploaded_file( $temp_stylist_image,"../images/$stylist_image");

}
$sql="INSERT into stylists (name, title, email, phone, description, services, address, password, stylist_image) VALUES ('$stylist_name','$title','$email','$phone','$description','$services','$address','$password',$stylist_image')";
$result=mysqli_query($conn,$sql);
if ($result) {
    echo "stylist added sucessfully";
}
else{
    echo "problem adding stylist";
}
?>
<h2>Add Stylist</h2>
<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter name">
    </div>
    <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control" name="title" placeholder="Enter name">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" class="form-control" name="email" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label>Phone</label>
        <input type="text" class="form-control" name="phone" placeholder="Enter phone numbe">
    </div>
    <div class="form-group">
        <label>Description</label>
        <input type="text" class="form-control" name="description" placeholder="Enter phone numbe">
    </div>

    <label for="services">Choose Services:</label>
    <div>
        <input type="checkbox" id="haircut" name="services" value="Haircut">
        <label for="haircut">Haircut</label>

        <input type="checkbox" id="coloring" name="services" value="Coloring">
        <label for="coloring">Coloring</label>

        <input type="checkbox" id="styling" name="services" value="Styling">
        <label for="styling">Styling</label>

        <!-- Add more services as needed -->
    </div>
    <div class="form-group">
        <label>Address</label>
        <input type="text" class="form-control" name="address" placeholder="description">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password" placeholder="Enter password">
    </div>
    <div>
        <label>image</label>
        <input type="file" name="stylist_image" required>
    </div>
    <br> <br>

    <button type="submit" class="btn btn-primary" name="insert_stylist">Save</button>
    <?php include("../js.php"); ?>

</form>