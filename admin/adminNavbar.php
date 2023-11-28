<?php
session_start();

include('../css.php');
include('../connect.php');

//check if user is logged in
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


if(isset($_SESSION["id"])){
    if(($_SESSION["id"])=="" ){
        header("location: ./login.php");
    }else{
        $userid=$_SESSION["id"];
    }

}else{
    header("location: ../login.php");
}
$userrow = "select * from users where id='$userid'";
$result= mysqli_query($conn,$userrow);
$userfetch=$result->fetch_assoc();
$username= $userfetch["name"];
$email=$userfetch["email"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      body{
        font-family: Arial, sans-serif;
      }
    .side-nav {
        border-right: 1px solid #e0e0e0;
        height: 100vh;
        margin-left: 0;
        margin-right: 0;
        margin-top: 0;
        padding-top: 10px;
    }

    .container {
        margin-left: 0;
    }

    .row {
        margin-left: 0;
    }

    .col-md-9 {}

    .active {
        background-color: #e0e0e0;
        /* Add your desired background color for the active link */
    }

    a {
        text-decoration: none;
        color: inherit;

    }
    .home{
        margin-top:20px;
    }
    .default-img{
        width: 100px;
        height: 100px;
        object-fit:contain;
        border-radius:50px;
    }
    .username{
        border-bottom: 1px solid #e0e0e0;
        margin-top:0;

    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-2 side-nav">-
                <div class="username">
                    <img src="../images/images.jfif" class="default-img" alt="">
                    <h3><?php echo "$username"; ?></h3>
                    <p><?php echo "$email"; ?></p>
                    <button class="btn btn-warning" style="width:90%; margin-bottom:20px;">Logout</button>
                </div>
                <div class="home">
                    <a href="adminNavbar.php?index.php" style="text-decoration:none; color: inherit; font-size:1.2rem;"><i
                            class="fas fa-home"></i>Home</a>
                </div>
                <div class="home">
                    <a href="adminNavbar.php?users" style="text-decoration:none; color: inherit; font-size:1.2rem;"><i
                            class="fas fa-cogs"></i>users</a>
                </div>
                <div class="home">
                    <a href="adminNavbar.php?services" style="text-decoration:none; color: inherit; font-size:1.2rem;"><i
                            class="fas fa-briefcase"></i>Services</a>
                </div>
                <div class="home">
                    <a href="adminNavbar.php?service_details" style="text-decoration:none; color: inherit; font-size:1.2rem;"><i
                            class="fas fa-calendar"></i>service_details</a> 
                </div>
                <div class="home">
                    <a href="adminNavbar.php?insert_service" style="text-decoration:none; color: inherit; font-size:1.2rem;"><i
                            class="fas fa-briefcase"></i>Insert Services</a>
                </div>
                <div class="home">
                    <a href="adminNavbar.php?insert_service_detail" style="text-decoration:none; color: inherit; font-size:1.2rem;"><i
                            class="fas fa-briefcase"></i>Insert Service_details</a>
                </div>
                <div class="home">
                    <a href="adminNavbar.php?insert_slot" style="text-decoration:none; color: inherit; font-size:1.2rem;"><i
                            class="fas fa-briefcase"></i>Insert slot</a>
                </div>
                <div class="home">
                    <a href="adminNavbar.php?insert_stylist" style="text-decoration:none; color: inherit; font-size:1.2rem;"><i
                            class="fas fa-briefcase"></i>Insert stylist</a>
                </div>
                <div class="home">
                    <a href="adminNavbar.php?settings" style="text-decoration:none; color: inherit; font-size:1.2rem;"><i
                            class="fas fa-scissors"></i>stylists</a>
                </div> 

            </div>
            <div class="col-md-10">
                <div class="head">
                    <h2>Account settings</h2>
                </div>
                <?php
                    if (!isset($_GET['stylists']) && !isset($_GET['users']) && !isset($_GET['insert_slot']) && !isset($_GET['insert_service_detail'])&& !isset($_GET['insert_service']) && !isset($_GET['insert_stylist']) && !isset($_GET['settings']) && !isset($_GET['allusers']) && !isset($_GET['services']) && !isset($_GET['service_details']) && !isset($_GET['stylists'])) {
                        # code...
                        include('index.php');

                    }
                    if (isset($_GET['stylists'])) {
                        include('./stylists.php');
                    }
                    if (isset($_GET['insert_slot'])) {
                      include('./insert_slot.php');
                    }
                     if (isset($_GET['insert_stylist'])) {
                      include('./insert_stylist.php');
                    }
                    if (isset($_GET['insert_service'])) {
                      include('./insert_service.php');
                    }
                    if (isset($_GET['insert_service_detail'])) {
                      include('./insert_service_details.php');
                    }
                    if (isset($_GET['service_details'])) {
                        include('service_details.php');
                    }
                    if (isset($_GET['services'])) {
                        include('services.php');
                    } 
                    if (isset($_GET['settings'])) {
                        include('settings.php');
                    }  
                    if (isset($_GET['users'])) {
                        include('users.php');
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>