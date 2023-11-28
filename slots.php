<?php
 session_start();
 include('connect.php');

if (!isset($_SESSION['id'])) {
    $_SESSION['error_message'] = 'You have to be logged in to be able to book a slot.';

    header("Location: users/login.php");
}
else{
   

// Retrieve parameters from the first page //booking1
if (isset($_POST['booking1'])) {
    # code...
    $service_id = isset($_POST['service_id']) ? $_POST['service_id'] : '';
$stylist_id = isset($_POST['stylist_id']) ? $_POST['stylist_id'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$day_of_week = isset($_POST['day_of_week']) ? $_POST['day_of_week'] : '';
$slot_id = isset($_POST['slot_id']) ? $_POST['slot_id'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';


}
$current_date = date('Y-m-d');
if ($date < $current_date) {
    $_SESSION['error_message'] = 'Sorry, you cannot select a past date. Please choose a future date.';
    header("Location: booking.php");
    exit();
}



// Check if the selected day is Sunday
if ($day_of_week === 1) {
    // Display an error message
    $_SESSION['error_message'] = 'Sorry, we are closed on Sundays. Please select a different day.';
    
    // Redirect back to the first page or display the error message as appropriate
    header("Location: booking.php");
    exit();
}

// Check if the selected slot is available
$sql_check_slot = "SELECT id FROM bookings WHERE stylist_id = '$stylist_id' AND date = '$date'";
$result_check_slot = mysqli_query($conn, $sql_check_slot);

// Check for errors in the query
if (!$result_check_slot) {
    die("Error in SQL query: " . mysqli_error($conn));
}

// If there are bookings for the selected stylist on the chosen date, handle it accordingly
if (mysqli_num_rows($result_check_slot) > 0) {
    // Handle the case where the slot is already booked by the stylist
    $_SESSION['error_message'] = 'Sorry, the selected stylist is already booked on this date. Please choose a different time or stylist.';
    header("Location: booking.php");
    exit();
}

// Fetch stylist and service names
$stylist_query = "SELECT stylist_name FROM stylists WHERE id = '$stylist_id'";
$service_query = "SELECT image3 FROM service_details WHERE detail_id = '$service_id'";

$stylist_result = mysqli_query($conn, $stylist_query);
$service_result = mysqli_query($conn, $service_query);

// Check for errors in the queries
if (!$stylist_result || !$service_result) {
    die("Error in SQL query: " . mysqli_error($conn));
}

// Fetch stylist and service names from the results
$stylist_name = mysqli_fetch_assoc($stylist_result)['stylist_name'];
$service_name = mysqli_fetch_assoc($service_result)['image3'];

// Fetch available slots based on the selected parameters
$sql = "SELECT * FROM slots WHERE service_id = '$service_id' AND stylist_id = '$stylist_id' AND day_of_week='$day_of_week'";
$result = mysqli_query($conn, $sql);

//fetch servic price
$sql1 = "SELECT * FROM service_details WHERE detail_id = '$service_id'";
$result1 = mysqli_query($conn, $sql1);

// Check for errors in the query
if (!$result) {
    die("Error in SQL query: " . mysqli_error($conn));
}

// Set parameters in the session
$_SESSION['service_id'] = $service_id;
$_SESSION['stylist_id'] = $stylist_id;
$_SESSION['service_name'] = $service_name;
$_SESSION['stylist_name'] = $stylist_name;
$_SESSION['date'] = $date;
$_SESSION['day_of_week'] = $day_of_week;
$_SESSION['slot_id'] = $slot_id; //$start_time
$_SESSION['price'] = $price; 

//$_SESSION['start_time'] = $start_time;

// Process booking logic if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_booking"])) {
    // ... (your booking logic)
    // Redirect to a confirmation page or display a success message
    header("Location: confirm_booking.php");
    exit();
}

}
?>
<!-- ... (rest of the HTML structure) ... -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Booking - Step 2</title>
    <?php include('css.php'); ?>
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
            margin-top: 20px; /* Add margin to separate form from the text */
            margin-left:auto;
            margin-right:auto;

        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        select,
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            color: #ff0000;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">User Booking - Step 2</h1>

        <form method="post" action="confirm_booking.php">
            <label for="selected_service">Selected Service:</label>
            <input type="number" name="service_id" id="selected_service" value="<?php echo $service_id; ?>" readonly>

            <label for="selected_stylist">Selected Stylist:</label>
            <input type="number" name="stylist_id" id="selected_stylist" value="<?php echo $stylist_id; ?>" readonly>
            

            <label for="selected_date">Selected Date:</label>
            <input type="date" name="date" id="selected_date" value="<?php echo $date; ?>" readonly>

            <label for="slot_id">Available Slots:</label>
            <select name="slot_id" required>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $slot_id = $row['id'];
                    $start_time = $row['start_time'];
                    echo "<option value=\"$slot_id\">$start_time</option>";
                }
                ?>
            </select>
            <label for="price">Price:</label>
            
                <?php
                while ($row1 = mysqli_fetch_assoc($result1)) {
                    $price = $row1['price'];
                }
                ?>
                <input type="number" step="0.01" name="price" id="price" value="<?php echo $price; ?>" readonly>

            </select>

            <button type="submit" name="add_booking" class="btn btn-warning">Book Slot</button>
        </form>
    </div>
    <?php include('js.php'); ?>

</body>

</html>
