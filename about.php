<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .col-md-5 {
            padding: 0; /* Remove padding from columns */
        }

        img {
            height: 250px;
            width: 100%; /* Ensure images take full width */
            object-fit: cover; /* Maintain aspect ratio and cover entire container */
            margin-bottom: 0; /* Remove bottom margin for spacing */
        }
    </style>
    <?php include('css.php'); ?>
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="col-md-12">
                <h4 style="margin-top:50px; text-align:center;">About Glow Haven</h4>
                <p style="width:80%; margin:auto; color:grey; text-align:center;">
                    <small>
                        At Glow Haven, we emphasize the interconnectedness of health and beauty. Our environment is free
                        from toxins, providing a safe and inclusive space for everyone. We prioritize the use of
                        all-natural, ammonia-free or low-ammonia products, along with sulfate and paraben-free options
                        for hair, skin, lashes, and brows. Our offerings extend to formaldehyde-free straighteners,
                        non-toxic dyes, and other chemical-free products. Whether you have allergies, are undergoing
                        medical treatments, or simply prefer healthier and more natural beauty services, we are here to
                        assist you. True to our name, our beauty lounge radiates a serene atmosphere, offering you a
                        rejuvenating, fulfilling, and confidence-boosting "me time." So relax, unwind, and indulge in
                        the fantastic experience of a Glow Up!
                    </small>
                </p>
            </div>
    <p style="width:80%; margin:auto; color:grey; text-align:center;"><small>
            At Glow haven, we offer a comprehensive range of services that align with traditional salon offerings, but with a
            focus on promoting overall well-being. Whether you aspire to achieve a glamorous appearance suitable for the red
            carpet or prefer a more natural radiance, Glow Up is dedicated to fulfilling your unique preferences. Our hair,
            skin, and makeup services prioritize high performance and deliver results. Through a thorough consultation, we
            identify the optimal premium products and customize services and treatments to leave you with a radiant and
            satisfied experience
        </small>.
    </p>
    <div class="container">
        <div class="row">
            <?php
            $images = [
                "facials-gallery-3.jpg",
                "waxing-gallery-2.jpg",
                "advanced-aesthetics-gallery-2.jpg",
                "braids-gallery-1.jpg"
            ];

            // Loop through images
            for ($i = 0; $i < count($images); $i++) {
            ?>
                <div class="col-md-5">
                    <img src="images/<?php echo $images[$i]; ?>" alt="">
                    <?php
                    // Check if there is another image in the pair
                    if ($i + 1 < count($images)) {
                    ?>
                        <img src="images/<?php echo $images[$i + 1]; ?>" alt="">
                    <?php
                        $i++; // Increment $i to skip the next image in the next iteration
                    }
                    ?>
                </div>
            <?php
            }
            ?>
            
        </div>
    </div>
    <?php include('footer.php'); ?>

    <?php include('js.php'); ?>
</body>

</html>
