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
  

if (isset($_GET['service_detail_edit'])) {
    $service_detail_id = $_GET['service_detail_edit'];

    $select_query = "select * from service_details where detail_id='$service_detail_id'";
    $result_query=mysqli_query($conn,$select_query);
    $row_query = mysqli_fetch_assoc($result_query);

    
    $detail_name = $row_query['image3'];
    $image3 = $row_query['detail_name'];
    $image1 = $row_query['image1'];
    $image2 = $row_query['image2'];
    $description = $row_query['description'];
    # code...

    if (isset($_POST['update_service'])) {
        $update_id = $service_detail_id;
        $image3 = $_POST['detail_name'];
        $image1 = $_POST['image1'];
        $image2 = $_POST['image2'];
        $description = $_POST['description'];
        // Handling user image upload
        $image3=$_FILES['detail_name']['name'];
        $image1=$_FILES['image1']['name'];
        $image2=$_FILES['image2']['name'];
    
        $temp_image3 = $_FILES['detail_name']['tmp_name'];
        $temp_image1 = $_FILES['image1']['tmp_name'];
        $temp_image2 = $_FILES['image2']['tmp_name'];
    
    
        move_uploaded_file($temp_image3,"../images/$image3");
        move_uploaded_file( $temp_image1,"../images/$image1");
        move_uploaded_file( $temp_image2,"../images/$image2");
    
        $update_query="UPDATE  service_details SET detail_name='$image3',image1='$image1',image2='$image2',image3='$detail_name',description='$description'";
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
    <h2 class="text-center"> Edit Service</h2>
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">
                       
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label  class="form-label">Service detail name</label>
                                <input type="text" class="form-control"  placeholder="User name" name="image3" value="<?php echo $detail_name; ?>">
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
                                <label  class="form-label">Third image</label>
                                <input type="file" class="form-control" name="detail_name" accept="image/*">
                                    <img src="../images/<?php echo $image3; ?>" alt="User Image" class="mt-2" style="max-width: 100px;">
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