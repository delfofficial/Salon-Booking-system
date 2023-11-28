<?php
session_start();
include('./connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('./css.php') ;?>
    <style>
    img {
        height: 200px;
        width: 200px;
        border-radius: 50%;
    }

    .caption p {}

    .caption> :nth-child(2) {
        color: grey;
        font-weight: lighter;
        font-family: 'Calibri', sans-serif;

    }

    h2 {
        color: hsl(0, 0%, 20%);
        opacity: 0.8;
        margin-bottom: 0;
        /*border-bottom: 1px solid grey; */
        width: 70%;
        margin: 0 auto;
    }

    .col-md-5 {
        margin: auto;
    }

    hr {
        width: 75%;
        margin-left: auto;
        margin-top: auto;
        margin-bottom: 0;
    }
    </style>
</head>

<!-- ... (head and CSS) ... -->

<body>
    <?php include('./navbar.php');?>
    <h2 class="text-center">Our Wonderful Glow Haven Team</h2>
    <div class="container">
        <div class="row">
            <?php
            $sql = "SELECT * FROM stylists";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $stylist_name = $row['name'];
                $stylist_title = $row['title'];
                $stylist_image = $row['stylist_image'];
                $description = $row['description'];
                $title = $row['title'];
            ?>
                <div class="col-md-5">
                    <div class="caption">
                        <p><small><?php echo $stylist_name ?></small></p>
                        <h4><?php echo $title ?></h4>
                    </div>
                    <div class="img">
                        <img src="./images/<?php echo $stylist_image ?>" alt="">
                        <p><small><?php echo $description ?></small></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php include('./footer.php') ;?>

    <?php include('./js.php') ;?>
</body>

</html>
