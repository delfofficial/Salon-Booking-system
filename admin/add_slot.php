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
  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add_slot"])) {
        // Add new slot from admin interface
        $day_of_week = $_POST["day_of_week"];
        $start_time = $_POST["start_time"];
        $end_time = $_POST["end_time"];
        $is_available = isset($_POST["is_available"]) ? 1 : 0;
        $is_day_off = isset($_POST["is_day_off"]) ? 1 : 0;
        $service_id = $_POST["service_id"];
        $stylist_id = $_POST["stylist_id"];

        addSlot($day_of_week, $start_time, $end_time, $is_available, $is_day_off, $service_id, $stylist_id);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Interface</title>
</head>
<body>
    <h1>Admin Interface</h1>

    <h2>Add Time Slot</h2>
    <form method="post" action="">
        <label for="service_id">Service:</label>
        <input type="text" name="service_id" required>

        <label for="stylist_id">Stylist:</label>
        <select name="stylist_id" required>
            <?php
            $allStylists = getAllStylists();
            foreach ($allStylists as $stylist) {
                echo "<option value='{$stylist['id']}'>{$stylist['name']}</option>";
            }
            ?>
        </select>

        <label for="day_of_week">Day of Week:</label>
        <select name="day_of_week" required>
            <option value="1">Sunday</option>
            <option value="2">Monday</option>
            <!-- Add options for other days -->
        </select>

        <label for="start_time">Start Time:</label>
        <input type="time" name="start_time" required>

        <label for="end_time">End Time:</label>
        <input type="time" name="end_time" required>

        <label for="is_available">Is Available:</label>
        <input type="checkbox" name="is_available" checked>

        <label for="is_day_off">Is Day Off:</label>
        <input type="checkbox" name="is_day_off">

        <button type="submit" name="add_slot">Add Slot</button>
    </form>

    <h2>Manage Time Slots</h2>
    <table>
        <thead>
            <tr>
                <th>Service</th>
                <th>Stylist</th>
                <th>Day of Week</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Is Available</th>
                <th>Is Day Off</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $allSlots = getAllSlots();
            foreach ($allSlots as $slot) {
                echo "<tr>
                        <td>{$slot['service_id']}</td>
                        <td>{$slot['stylist_id']}</td>
                        <td>{$slot['day_of_week']}</td>
                        <td>{$slot['start_time']}</td>
                        <td>{$slot['end_time']}</td>
                        <td>{$slot['is_available']}</td>
                        <td>{$slot['is_day_off']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
