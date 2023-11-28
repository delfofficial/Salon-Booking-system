<?php
include('../navbar.php');
include('../css.php');
include('../connect.php');

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if email already in the database
    $sql1 = "SELECT * FROM users WHERE email='$email'";
    $result2 = mysqli_query($conn, $sql1);
    $row2 = mysqli_num_rows($result2);

    if ($row2 > 0) {
        echo "Email already exists in the database";
    } else {
        if ($confirmPassword == $password) {
            // Set a default image path
            $defaultImagePath = 'images/default.jpg';

            $sql = "INSERT INTO users (name, email, phone, address, password, user_image) 
                    VALUES ('$name', '$email', '$phone', '$address', '$password', '$defaultImagePath')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "Registered successfully";
                header("Location: ./login.php");
            } else {
                echo "Something went wrong";
            }
        } else {
            echo "The passwords do not match";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>

<body>
    <form action="" method="POST" enctype="multipart/form-data"
        style="width:400px; margin:auto; align-items:center; text-align:center; margin-bottom:20px;">

        <input type="hidden" name="_method" value="POST">

        <div class="form-group mb-20">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required="">
        </div>

        <div class="form-group mb-20">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required="">
        </div>

        <div class="form-group mb-20">
            <label>Phone number</label>
            <input type="number" name="phone" class="form-control" required="">
        </div>

        <div class="form-group mb-20">
            <label>Address</label>
            <input type="text" name="address" class="form-control" required="">
        </div>

        <div class="form-group mb-20">
            <label>Password</label>
            <input type="text" name="password" class="form-control" required="">
        </div>

        <div class="form-group mb-20">
            <label>Confirm Password</label>
            <input type="text" name="confirmPassword" class="form-control" required="">
        </div>

        <button type="submit" class="btn btn-warning my-20" name="register">Register</button><br>
        <label for="" class="sub-text" style="font-weight: 280;">Already have an account? </label>
        <a href="users/login.php" class="hover-link1 non-style-link">Login</a>
    </form>

    <?php
    include('../js.php');
    ?>
</body>

</html>
