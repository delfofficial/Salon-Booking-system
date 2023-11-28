<?php
session_start();

include('../css.php');
include('../connect.php');

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
                    <a href="profile.php?index.php" style="text-decoration:none; color: inherit; font-size:1.2rem;"><i
                            class="fas fa-home"></i>Home</a>
                </div>
                <div class="home">
                    <a href="profile.php?stylists" style="text-decoration:none; color: inherit; font-size:1.2rem;"><i
                            class="fas fa-cogs"></i>Stylists</a>
                </div>
                <div class="home">
                    <a href="profile.php?bookings" style="text-decoration:none; color: inherit; font-size:1.2rem;"><i
                            class="fas fa-calendar"></i>Bookings</a>
                </div>
                <div class="home">
                    <a href="profile.php?services" style="text-decoration:none; color: inherit; font-size:1.2rem;"><i
                            class="fas fa-briefcase"></i>Services</a>
                </div>
                <div class="home">
                    <a href="profile.php?settings" style="text-decoration:none; color: inherit; font-size:1.2rem;"><i
                            class="fas fa-scissors"></i>Settings</a>
                </div> 

            </div>
            <div class="col-md-10">
                <div class="head">
                    <h2>Account settings</h2>
                </div>
                <?php
                    if (!isset($_GET['stylists']) && !isset($_GET['bookings']) && !isset($_GET['insert_products']) && !isset($_GET['settings']) && !isset($_GET['allusers']) && !isset($_GET['services'])) {
                        # code...
                        include('index.php');

                    }
                    if (isset($_GET['stylists'])) {
                        include('../stylists.php');
                    }
                    if (isset($_GET['bookings'])) {
                        include('bookings.php');
                    }
                    if (isset($_GET['services'])) {
                        include('services.php');
                    } 
                    if (isset($_GET['settings'])) {
                        include('settings.php');
                    }  
                    if (isset($_GET['allusers'])) {
                        include('allusers.php');
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>