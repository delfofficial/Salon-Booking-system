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
//include('./functions/common_functions.php');


$user_id = $_SESSION["id"];
$sql = "SELECT * FROM bookings WHERE user_id='$user_id'";
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
    $start_time = $row2['start_time']; */
    
//}//else {
    // No orders found for this user
   // $amount = "N/A";
    //$invoice_number = "N/A";
    //$total_products = "N/A";
    //$order_id = "N/A"; // Corrected variable name
    //$order_date = "N/A";
    //$order_status = "N/A";
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td{
            padding:20px;
        }
    </style>
</head>
<body>
<?php
    // Check if there are orders for this user
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $date = $row['date'];
        $slot_id = $row['slot_id'];
        $service_id = $row['service_id'];
        $stylist_id = $row['stylist_id'];
        $price = $row['price'];
        $sql2="SELECT * FROM slots WHERE id='$slot_id'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $start_time = $row2['start_time'];
    
        ?>
        <table>
            <thead class="px-20 mx-20">
                <tr class="bg-warning text-dark px-30">
                    <th>Date</th>
                    <th>slot_id</th>
                    <th>Service_id</th>
                    <th>stylist_id</th>
                    <th>Price</th>
                    <th>Time</th>

                </tr>
            </thead>
            <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $date = $row['date'];
                    $slot_id = $row['slot_id'];
                    $service_id = $row['service_id'];
                    $stylist_id = $row['stylist_id'];
                    $price = $row['price'];
                    $sql2="SELECT * FROM slots WHERE id='$slot_id'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $start_time = $row2['start_time'];
                    ?>
                    <tr class="bg-light text-dark px-20 mx-20">
                        <td><?php echo $date; ?></td>
                        <td><?php echo $slot_id; ?></td>
                        <td><?php echo $service_id; ?></td>
                        <td><?php echo $stylist_id; ?></td>
                        <td><?php echo $price; ?></td> 
                        <td><?php echo $start_time; ?></td>
                    </tr>
                    <?php
                }
                ?>
        </table>
        <?php
    } else {
        // No orders found for this user
        echo "<h2 class='text-danger'> No pending orders</h2>";
    }
    ?>
</body>
</html>