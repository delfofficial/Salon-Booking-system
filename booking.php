<!-- index.php -->

<?php
session_start();
include('connect.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Booking - Step 1</title>
    <?php include('css.php');?>

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
        h1{
            
        }
    </style>
</head>

<body>
    <div class="container">
    <?php

// Check if there is an error message in the session
if (isset($_SESSION['error_message'])) {
    // Display the error message and then clear it from the session
    echo '<p style="color: red; text-center;">' . $_SESSION['error_message'] . '</p>';
    unset($_SESSION['error_message']);
}
?>
        <h1 class="text-center">User Booking - Step 1</h1>

        <form method="post" action="slots.php">
            <label for="service_id">Service:</label>
            <select name="service_id" required>
                <?php
                $sql = "SELECT * FROM service_details";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $service_id = $row['detail_id'];
                    $service_name = $row['image3'];
                    echo "<option value=\"$service_id\">$service_name</option>";
                }
                ?>
            </select>

            <label for="stylist_id">Stylist:</label>
            <select name="stylist_id" required>
                <?php
                $sql = "SELECT * FROM stylists";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $stylist_id = $row['id'];
                    $stylist_name = $row['stylist_name'];
                    echo "<option value=\"$stylist_id\">$stylist_name</option>";
                }
                ?>
            </select>

            <label for="date">Select a Date:</label>
            <input type="date" name="date" id="date" onchange="updateDayOfWeek()" required>
            <input type="text" name="day_of_week" id="day_of_week" readonly>

            <button type="submit" name="booking1" class="btn btn-warning">Next</button>
        </form>
    </div>

    <!-- Add this script inside the head or at the end of the body in your HTML -->

<!-- Add this script inside the head or at the end of the body in your HTML -->

<script>
    function updateDayOfWeek() {
        const selectedDate = new Date(document.getElementById('date').value);
        const dayOfWeek = selectedDate.getDay() + 1; // Adding 1 to convert from 0-based index to 1-based index
        document.getElementById('day_of_week').value = dayOfWeek;
    }
</script>
<?php include('js.php');?>

</body>

</html>
