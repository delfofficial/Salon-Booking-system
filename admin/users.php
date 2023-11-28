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

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// Check if there are orders for this user

// ... (previous code) 
/*
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $date = $row['date'];
    $slot_id = $row['slot_id'];
    $service_id = $row['service_id'];
    $stylist_id = $row['stylist_id'];
    
    //get the slot time start_time
    $sql2="SELECT * FROM slots WHERE slot_id='$slot_id'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $start_time = $row2['start_time'];
}
*/
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
    </style>
</head>
<body>

    <table>
        <thead class="px-20 mx-20">
            <tr class="bg-warning text-dark px-30">
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $address = $row['address'];
            $role = $row['role'];
            ?>
            <tr class="bg-light text-dark px-20 mx-20">
                <td><?php echo $name; ?></td>
                <td><?php echo $email; ?></td>
                <td><?php echo $phone; ?></td>
                <td><?php echo $address ?></td>
                <td>
                    <button class="btn btn-success">Edit</button>
                    <button class="btn btn-danger" <?php if ($role == 1) echo 'disabled'; ?>>Delete</button>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>

    <?php include('../js.php');?>

</body>
</html>
