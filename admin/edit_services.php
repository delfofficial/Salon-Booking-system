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
  

if (isset($_GET['service_edit'])) {
    $service_id = $_GET['service_edit'];
    $select_query = "select * from services where service_id='$service_id'";
    $result_query=mysqli_query($conn,$select_query);
    $row_query = mysqli_fetch_assoc($result_query);
    $service_id = $row_query['service_id'];
    $service_name = $row_query['service_name'];
    $banner = $row_query['banner'];
    $image1 = $row_query['image1'];
    $image2 = $row_query['image2'];
    $description = $row_query['description'];
    # code...

    if (isset($_POST['update_service'])) {
        $update_id = $service_id;
        $service_name = $_POST['service_name'];
        $banner = $_POST['banner'];
        $image1 = $_POST['image1'];
        $image2 = $_POST['image2'];
        $description = $_POST['description'];
        // Handling user image upload
        $banner=$_FILES['banner']['name'];
        $image1=$_FILES['image1']['name'];
        $image2=$_FILES['image2']['name'];
    
        $temp_banner = $_FILES['banner']['tmp_name'];
        $temp_image1 = $_FILES['image1']['tmp_name'];
        $temp_image2 = $_FILES['image2']['tmp_name'];
    
    
        move_uploaded_file($temp_banner,"../images/$banner");
        move_uploaded_file( $temp_image1,"../images/$image1");
        move_uploaded_file( $temp_image2,"../images/$image2");
    
        $update_query="UPDATE  services SET service_name='$service_name', banner='$banner', image1='$image1', image2='$image2'";
            if (mysqli_query($conn, $update_query)) {
                echo "<script>alert('User details updated successfully');</script>";
                echo "<script>window.open('../index.php', '_self');</script>";
            } else {
                echo "<script>alert('Failed to update user details');</script>";
            }
        }
       
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</head>
<body>
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Edit Service
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label  class="form-label">Service name</label>
                                <input type="text" class="form-control"  placeholder="User name" name="service_name" value="<?php echo $service_name; ?>">
                            </div>

                            <div class="mb-3">
                                <label  class="form-label">Banner image</label>
                                <input type="file" class="form-control" name="banner" accept="image/*">
                                    <img src="../images/<?php echo $banner; ?>" alt="User Image" class="mt-2" style="max-width: 100px;">
                            </div>

                            <div class="mb-3">
                                <label  class="form-label">First image</label>
                                <input type="file" class="form-control" name="image1" accept="image/*">
                                    <img src="../images/<?php echo $image1; ?>" alt="User Image" class="mt-2" style="max-width: 100px;">
                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Second image</label>
                                <input type="file" class="form-control" name="image2" accept="image/*">
                                    <img src="../images/<?php echo $image2; ?>" alt="User Image" class="mt-2" style="max-width: 100px;">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="" cols="30" rows="10"  value="<?php echo $description; ?>"></textarea>
                            </div>

                            <input type="submit" class="btn btn-info" name="update_service" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    

</body>
</html>