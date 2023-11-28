<?php
session_start();
include('../connect.php');
include('../css.php');
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
  

if (isset($_POST['insert_service_detail'])) {
    $service_name = $_POST['service_name'];
    $detail_name = $_POST['detail_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $image1 = $_FILES['image1']['name'];
    $image2 = $_FILES['image2']['name'];
    $image3 = $_FILES['image3']['name'];

    $temp_image1 = $_FILES['image1']['tmp_name'];
    $temp_image2 = $_FILES['image2']['tmp_name'];
    $temp_image3 = $_FILES['image3']['tmp_name'];

    move_uploaded_file($temp_image1, "../images/$image1");
    move_uploaded_file($temp_image2, "../images/$image2");
    move_uploaded_file($temp_image3, "../images/$image3");

    $sql = "INSERT INTO service_details (service_name, detail_name, image1, image2, image3,price, description) VALUES ('$service_name', '$image1', '$image2', '$image3', '$detail_name','$price','$description')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo 'Service detail added successfully';
    } else {
        echo 'Error adding service detail';
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

    <h2>Add Service Detail</h2>

    <form action="" method="post" enctype="multipart/form-data" class="form-group">
        <div class="form-group">
            <label>Service name</label>
            <select name="service_name" class="form-select w-50 ">
                <?php
                $sql1 = "SELECT * FROM services";
                $result1 = mysqli_query($conn, $sql1);

                while ($rsl1 = mysqli_fetch_assoc($result1)) {
                    $service_name = $rsl1['service_name'];
                    $service_id = $rsl1['service_id'];
                    echo "<option value=\"$service_id\">$service_name</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Service detail name</label>
            <input type="text" name="detail_name" required>
        </div>
        <div class="form-group">
            <label>Image1</label>
            <input type="file" name="image1" required>
        </div>

        <br> <br>
        <div class="form-group">
            <label>Image2</label>
            <input type="file" name="image2" required>

        </div>
        <div class="form-group">
            <label>Image3</label>
            <input type="file" name="image3" required>
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="number" step="0.01" name="price" required>
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Example textarea</label>
            <textarea class="form-control" name="description" rows="3"></textarea>
        </div>
        <input type="submit" name="insert_service_detail" value="Insert service detail">

    </form>
    <?php include('../js.php') ;?>
</body>

</html>