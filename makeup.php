<?php
session_start();
include('connect.php');
include('navbar.php');
include('css.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .banner {
            text-align: center;
            position: relative;
            width: 100vw; /* Use vw (viewport width) instead of % to ensure full viewport width */
            height: 300px; /* Adjust this value to set the desired height */
            overflow: hidden;
        }

        .banner img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Use 'cover' to ensure the image covers the container */
        }

        .caption {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 24px;
            width: 100%;
        }

        .bannerButton {
           /* background-color: hotpink;
            border: none;
            color: white; */
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;

            border: 1px solid gold;
        background: transparent;
        color: white;
        width: 180px;
        margin-top: 40px;
        }
        a{
            text-decoration:none;
            color:inherit;
        }
        .col-md-8 img{
            height:300px;
            width:300px;
            object-fit:contain;

        }
        
        .row{
            margin-left:50px;
            margin-bottom:50px;

           /* border-bottom: 1px solid gold; Wigs and extensionsions*/

        }
        h2{
            text:center;
        }
        .details{
            margin-top:50px;

        }
    </style>
</head>

<body>
    <div class="banner">
    <?php
    $sql = "SELECT * FROM services WHERE service_name ='makeup services'";
    $rsl = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($rsl)) {
        $service_id = $row['service_id'];
        $service_name = $row['service_name'];
        $image1 = $row['image1'];
        $banner = $row['banner'];

    }
    ?>
        <img src="images/<?php echo $banner; ?>" alt="Card Image">
        

        <!--<img src="images/OV2A2037-Edit.jpg" alt="Card Image"> -->
        <div class="caption">
       
            <h4><i><?php echo $service_name; ?></i></h4>
            <button class="bannerButton btn btn-warning"><a href="booking.php">Book now</a></button>
        </div>
    </div>
    <div class="details">
    <?php
    $sql1 = "SELECT * FROM service_details WHERE service_name ='$service_id'";
    $rsl1 = mysqli_query($conn, $sql1);

    while ($row1 = mysqli_fetch_assoc($rsl1)) {
        $service_name = $row1['service_name'];
        $detail_name = $row1['image3'];
        $description = $row1['description'];

        $imageA = $row1['image1'];
        $imageB = $row1['image2'];

        $price = $row1['price'];
    ?>
            <h2 class="text-center"><?php echo $detail_name; ?></h2>

        <div class="row">

            <div class="col-md-4 descrip">
                <p><?php echo $description; ?></p>
            </div>
            <div class="col-md-8 img">
            <img src="images/<?php echo $imageA; ?>" alt="Card Image">
            <img src="images/<?php echo $imageB; ?>" alt="Card Image">

            </div>
        </div>
        <?php } ?>
    </div>
    <?php include('footer.php'); ?>

    <?php include('js.php'); ?>
</body>

</html>
