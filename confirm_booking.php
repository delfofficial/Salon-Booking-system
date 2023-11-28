<?php
session_start();
include('connect.php');

// Retrieve parameters from the second page //add_booking
if (isset($_POST['add_booking'])) {
    # code...
    $service_id = isset($_SESSION['service_name']) ? $_SESSION['service_name'] : '';
$stylist_id = isset($_SESSION['stylist_name']) ? $_SESSION['stylist_name'] : '';
$day_of_week = isset($_SESSION['day_of_week']) ? $_SESSION['day_of_week'] : '';
$date = isset($_SESSION['date']) ? $_SESSION['date'] : '';
$slot_id = isset($_POST['slot_id']) ? $_POST['slot_id'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';


//$slot_id = isset($_SESSION['start_time']) ? $_SESSION['start_time'] : '';
// Assuming you have retrieved the user ID and stored it in $user_id
$user_id = $_SESSION['id'];

//check if date is past$current_date = date('Y-m-d');
$current_date = date('Y-m-d');
if ($date < $current_date) {
    $_SESSION['error_message'] = 'Sorry, you cannot select a past date. Please choose a future date.';
    header("Location: booking.php");
    exit();
}



//check if slot is already booked
$sql6="SELECT * FROM bookings where date='$date' and slot_id='$slot_id'";
    $rsl6=mysqli_query($conn,$sql6);
    $rsl_row6 =mysqli_num_rows($rsl6);
    if ($rsl_row6>0) {

        $_SESSION['error_message'] = "The selected slot is not available.";      
        header("Location: booking.php");
exit();


      # code...
    }
    else{
        

// Insert the booking into the database
$query = "INSERT INTO bookings (date, user_id, slot_id, service_id, stylist_id, price) 
VALUES ('$date', '{$_SESSION["id"]}', '$slot_id', '$service_id', '$stylist_id','$price')";

// Perform the query
$result = mysqli_query($conn, $query);

// Check for errors in the query
if (!$result) {
die("Error in SQL query: " . mysqli_error($conn));
} else {
echo "Booking successful $price ";
}

// Get the last inserted ID (if auto-increment is used)
$last_inserted_id = mysqli_insert_id($conn);

if ($last_inserted_id) {
echo "Last inserted ID: " . $last_inserted_id;
} else {
echo "Error getting last inserted ID: " . mysqli_error($conn);
}
        
    }


}
// Close the database connection
mysqli_close($conn);
?>
<!-- ... (no changes in the HTML structure)
 // Check if the selected slot is available
   6t7} else {
        if ($day_of_week == 1) {
            $message = "Sunday is an off-day";
        } else {
            if ($slotResult && $slotResult->num_rows === 0) {
                // If the slot is available, add the booking
                $query = "INSERT INTO bookings (date, user_id, slot_id, service_id, stylist_id) 
                          VALUES ('$start_date', '$user_id', '$slot_id', '$service_id', '$stylist_id')";

                // Perform the query
                $result = mysqli_query($conn, $query);

                if ($result) {
                    $message = "Booking successful!";
                } else {
                    // Handle the SQL error
                    $message = "Error in the SQL query: " . mysqli_error($conn);
                }
            } else {
                $message = "The selected slot is not available.";
            }
        }
    }
} else {
    // Handle case where user_id, service_id, or stylist_id does not exist
    // This could be due to invalid session data or unauthorized access
    $message = "Invalid user, service, or stylist.";
}

 ... -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Booking - Confirmation</title>
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

        div {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #4caf50;
        }

        p {
            margin: 0;
        }
    </style>
</head>

<body>
    <div>
        
    </div>
</body>

</html>
