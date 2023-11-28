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
  
function addSlot($day_of_week, $start_time, $end_time, $is_available, $is_day_off, $service_id, $stylist_id)
{
    global $conn;

    // Check if service_id and stylist_id exist in their respective tables
    $serviceCheck = "SELECT * FROM services WHERE service_id = $service_id";
    $stylistCheck = "SELECT * FROM stylists WHERE id = $stylist_id";

    $serviceResult = mysqli_query($conn,$serviceCheck);
    $stylistResult = mysqli_query($conn,$stylistCheck);
    

    if ($serviceResult->num_rows > 0 && $stylistResult->num_rows > 0) {
        $query = "INSERT INTO slots (day_of_week, start_time, end_time, isAvailable, is_day_off, service_id, stylist_id) 
                  VALUES ('$day_of_week', '$start_time', '$end_time', '$is_available', '$is_day_off',' $service_id', '$stylist_id')";

       $conn->query($query);

    } else {
        // Handle case where service_id or stylist_id does not exist
        // This could be due to invalid session data or unauthorized access
         //$message = "Invalid service or stylist.";
         echo "<div class='alert alert-success'>Invalid service or stylist.</div>";


    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add_slot"])) {
        // Add new slot from admin interface
        $day_of_week = $_POST["day_of_week"];
        $start_time = $_POST["start_time"];
        $end_time = $_POST["end_time"];
        $is_available = isset($_POST["isAvailable"]) ? 1 : 0;
        $is_day_off = isset($_POST["is_day_off"]) ? 1 : 0;
        $service_id = $_POST["service_id"];
        $stylist_id = $_POST["stylist_id"];

        addSlot($day_of_week, $start_time, $end_time, $is_available, $is_day_off, $service_id, $stylist_id);
        $message = "Slot added successfully.";

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('../css.php'); ?>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 400px;
        margin:auto;
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    select,
    input[type="time"],
    input[type="checkbox"],
    button {
        width: 100%;
        padding: 10px;
        margin-bottom: 16px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        background-color: #ffc107;
        color: #fff;
        cursor: pointer;
    }

    button:hover {
        background-color: #e0a800;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Admin Interface</h1>

        <h2>Add Time Slot</h2>
        <?php //echo isset($message) ? "<alert class='text-success'>$message</alert>" : ""; //this is also correct
        
        ?> 
        <h2>Add Time Slot</h2>
<?php if (!empty($message)) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>



        <form action="" method="post" style="display:inline-block;">

            <label for="service_id">Service:</label>
            <select name="service_id" required>
                <option value="">
                    <?php
  $sql = "SELECT * FROM service_details";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($result)) {
    $service_id = $row['detail_id'];
    $service_name = $row['image3'];
    echo "<option value=\"$service_id\">$service_name</option>";
  }
  ?>
                </option>

            </select>
            <label for="stylist_id">Stylist:</label>
            <select name="stylist_id" required>
                <option value="">
                    <?php
  $sql = "SELECT * FROM stylists";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($result)) {
    $stylist_id = $row['id'];
    $stylist_name = $row['stylist_name'];
    echo "<option value=\"$stylist_id\">$stylist_name</option>";
  }
  ?>
                </option>

            </select>
            <label for="day_of_week">Day of Week:</label>
            <select name="day_of_week" required>
                <option value="1">Sunday</option>
                <option value="2">Monday</option>
                <option value="3">Tuesday</option>
                <option value="4">Wednesday</option>
                <option value="5">Thursday</option>
                <option value="6">Friday</option>
                <option value="7">Saturday</option>

                <!-- Add options for other days -->
            </select>
            <label for="start_time">Start Time:</label>
            <input type="time" name="start_time" required>

            <label for="end_time">End Time:</label>
            <input type="time" name="end_time" required>

            <label for="is_available">Is Available:</label>
            <input type="checkbox" name="isAvailable" checked>

            <label for="is_day_off">Is Day Off:</label>
            <input type="checkbox" name="is_day_off">

            <button type="submit" name="add_slot">Add Slot</button>

        </form>
    </div>

    <?php include('../js.php'); ?>

</body>

</html>