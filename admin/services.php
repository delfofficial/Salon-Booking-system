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

$sql = "SELECT * FROM services";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('../css.php');?>

    <style>
        td {
            padding: 20px;
        }
        img {
            height: 50px;
            width: 50px;
            object-fit: contain;
        }
    </style>
</head>
<body>

    <table>
        <thead class="px-20 mx-20">
            <tr class="bg-warning text-dark px-30">
                <th>Name</th>
                <th>Banner</th>
                <th>First Image</th>
                <th>Second Image</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $service_id = $row['service_id'];
            $service_name = $row['service_name'];
            $banner = $row['banner'];
            $image1 = $row['image1'];
            $image2 = $row['image2'];
            $description = $row['description'];
            ?>
            <tr class="bg-light text-dark px-20 mx-20">
                <td><?php echo $service_name; ?></td>
                <td><img src="../images/<?php echo $banner; ?>" alt=""></td>
                <td><img src="../images/<?php echo $image1; ?>" alt=""></td>
                <td><img src="../images/<?php echo $image2; ?>" alt=""></td>
                <td><?php echo $description; ?></td>
                <td>
                    <button class="btn btn-success"><a href="edit_services.php?service_edit=<?php echo $service_id  ?>">Edit</a></button>
                    
                    <button class="btn btn-danger"><a href="edit_services.php?service_delete=<?php echo $service_id  ?>">Delete</a></button>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>

    <?php include('../js.php');?>

</body>
</html>
