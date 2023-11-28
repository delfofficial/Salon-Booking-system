<?php
session_start();
include('connect.php');
// Assuming you have a database connection established
$query = "SELECT banner FROM services";
$result = mysqli_query($conn, $query);

$bannerImages = [];
while ($row = mysqli_fetch_assoc($result)) {
    $bannerImages[] = $row['banner'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
    .navbar {
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .service-card {
        height: 150px;
        width: 150px;

        border: 1px solid #e0e0e0;
        border-radius: 10px;
        /*padding: 10px; */
        margin: 20px;
        text-align: center;

    }

    .service-image {
        width: 100%;
        height: 100%;
        min-height: 300px;
        /* Adjust this value to set the desired minimum height */

        /* object-fit: contain; */
    }

    .custom-btn-pink {
        background-color: hotpink;
        border-color: hotpink;
    }

    .custom-btn-pink:hover {
        background-color: #ff69b4;
        border-color: #ff69b4;
    }

    .banner {
        text-align: center;
        position: relative;
        width: 100%;
        margin-right: 50px;
        margin-top: 50px;

        height: 300px;
        /* Adjust this value to set the desired height */
        border: 1px solid #e0e0e0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);



    }

    .banner img {
        width: 100%;
        min-height: 300px;
        /* Adjust this value to set the desired minimum height */

        height: auto;
    }

    .caption {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 36px;
        width: 100%;
    }

    .bannerButton {
        border: 1px solid gold;
        background: transparent;
        color: white;
        width: 180px;
        margin-top: 40px;
    }

    .bannerButton:hover {
        background: #ffc107;
        color: white;

    }



    .carousel {
        height: 300px;
        /* Adjust the height as needed */
        margin-bottom: 50px;

    }

    .carousel-inner img {
        width: auto;
    }

    .carousel-inner {
        transition: transform 0.3s ease-in-out;
        /* Adjust the duration as needed */
    }

    .banner3 {
        text-align: center;
        position: relative;
        width: 100%;
        margin-top: 50px;
        /* Adjust the margin-top value */
        border: 1px solid #e0e0e0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .banner3 img {
        width: 100%;
        height: auto;
        /* Maintain aspect ratio */
    }



    .banner3 img {
        width: 100%;
        min-height: 300px;
        /* Adjust this value to set the desired minimum height */

        height: auto;
    }

    .caption3 {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 24px;
        width: 100%;
    }

    .bannerButton3 {
        border: 1px solid gold;
        background: transparent;
        color: white;
        width: 180px;
        margin-top: 40px;
    }

    .r2 {
        margin-top: 20px;
        /* Add or adjust the margin-top value */

    }

    .banner1 {
        text-align: center;
        position: relative;
        width: 100%;
        height: 300px;
        /* Adjust the height as needed */
        margin-top: 0;
        /* Adjust the margin-top value */
        border: 1px solid #e0e0e0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        /* Add margin-bottom as needed */

    }


    .banner1 img {
        width: 100%;
        height: auto;
        /* Maintain aspect ratio */
    }



    .banner1 img {
        width: 100%;
        min-height: 00px;
        /* Adjust this value to set the desired minimum height */

        height: auto;
    }

    .caption1 {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 24px;
        width: 100%;
    }

    .bannerButton1 {
        border: 1px solid gold;
        background: transparent;
        color: white;
        width: 180px;
        margin-top: 40px;
    }

    .carousel-caption {
        position: absolute;
        top: 50%;
        left: 50%;
        right: 50%;
        /*transform: translate(50%, 50%);*/
        text-align: center;
        font-weight: 500;
        font: size 36px;
        0;
        line-height: 1.5;
        /* 1 */

    }
    </style>
</head>

<body>
    <!--
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
         Your navbar code here
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0 d-flex">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>  -->
    <!--
<div class="container">
    <h1>Our Services</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="service-card">
                <img src="images/Screenshot_20231016-015352_Chrome.jpg" alt="Card Image" class="service-image">
                <h3>Haircut</h3>
                
                <button class="btn custom-btn-pink">Book Now</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card">
                <img src="images/Screenshot_20231016-015352_Chrome.jpg" alt="Card Image" class="service-image">
                <h3>Hair Coloring</h3>

                <button class="btn custom-btn-pink">Book Now</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-card">
                <img src="images/Screenshot_20231016-015352_Chrome.jpg" alt="Card Image" class="service-image">
                <h3>Hair Styling</h3>
                
                <button class="btn custom-btn-pink">Book Now</button>
            </div>
        </div>
    </div>
</div>
<div class="banner1">
        <img src="images/salons-2@desktop.jpg" alt="Banner Image 1">
        <div class="caption1">
        <h2>HOME TO THE FINEST BEAUTY ARTISTS</h2>
        <p>Welcome to the House of Gielly Green. Take a look around our Flagship salon, see the talented team of artists
            and discover London’s leading hair and beauty salon.</p>
            <button class="bannerButton1">Book now</button>
        </div>
    </div> -->
    <?php include('navbar.php'); ?>

    <div class="carousel slide" id="myCarousel" data-ride="carousel" style="margin-bottom:130px;">
        <div class="carousel-inner">
            
            <div class="carousel-item active">
                <img src="images/salons-2@desktop.jpg" class="d-block w-100" alt="image1" style="height: 500px;">
                <div class="carousel-caption d-none d-md-block">
                    <h2>HOME TO THE FINEST BEAUTY ARTISTS</h2>
                    <p>Welcome to the House of Gielly Green. Take a look around our Flagship salon, see the talented
                        team of artists
                        and discover London’s leading hair and beauty salon.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/Wal-ins_BlogPost_Teds_Barbers.jpg" class="d-block w-100" alt="image2" style="height: 500px;">
                <div class="carousel-caption d-none d-md-block">
                    <p>image 2</p>
                </div>
            </div>
            <div class="carousel-item ">
                <img src="images/hero-makeup.jpg" class="d-block w-100" alt="image1" style="height: 500px;">
                <div class="carousel-caption d-none d-md-block">
                    <h2>HOME TO THE FINEST BEAUTY ARTISTS</h2>
                    <p>Welcome to the Glow haven. Take a look around our Flagship salon, see the talented
                        team of artists
                        and discover a leading hair and beauty salon.</p>
                </div>
                <div class="carousel-item">
                <img src="images/monpure-gallery-2.jpg" class="d-block w-100" alt="image4"
                    style="height: 500px;">
                <div class="carousel-caption d-none d-md-block">
                <h2>HOME TO THE FINEST BEAUTY ARTISTS</h2>
                    <p>Welcome to the Glow haven. Take a look around our Flagship salon, see the talented
                        team of artists
                        and discover a leading hair and beauty salon.</p>
                </div>
            </div>
            </div>
            <div class="carousel-item">
                <img src="images/augustinus-bader.jpg" class="d-block w-100" alt="" style="height: 500px;">
                <div class="carousel-caption d-none d-md-block">
                <h2>HOME TO THE FINEST BEAUTY ARTISTS</h2>
                    <p>Welcome to the Glow haven. Take a look around our Flagship salon, see the talented
                        team of artists
                        and discover a leading hair and beauty salon.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/brow-suman-carousel-3.jpg" class="d-block w-100" alt="" style="height: 500px;">
                <div class="carousel-caption d-none d-md-block">
                    <h2>HOME TO THE FINEST BEAUTY ARTISTS</h2>
                    <p>Welcome to the Glow haven. Take a look around our Flagship salon, see the talented
                        team of artists
                        and discover a leading hair and beauty salon.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/odette-gallery-14.jpg" class="d-block w-100" alt="" style="height: 500px;">
                <div class="carousel-caption d-none d-md-block">
                <h2>HOME TO THE FINEST BEAUTY ARTISTS</h2>
                    <p>Welcome to the Glow haven. Take a look around our Flagship salon, see the talented
                        team of artists
                        and discover a leading hair and beauty salon.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/hero-colouring-2.jpg" class="d-block w-80" alt="image4"
                    style="height: 500px;">
                <div class="carousel-caption d-none d-md-block">
                <h2>HOME TO THE FINEST BEAUTY ARTISTS</h2>
                    <p>Welcome to the Glow haven. Take a look around our Flagship salon, see the talented
                        team of artists
                        and discover a leading hair and beauty salon.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/monpure-gallery-1.jpg" class="d-block w-100" alt="image4"
                    style="height: 500px;">
                <div class="carousel-caption d-none d-md-block">
                <h2>HOME TO THE FINEST BEAUTY ARTISTS</h2>
                    <p>Welcome to the Glow haven. Take a look around our Flagship salon, see the talented
                        team of artists
                        and discover a leading hair and beauty salon.</p>
                </div>
            </div>
        </div>
        <a href="#myCarousel" class="carousel-control-prev" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a href="#myCarousel" class="carousel-control-next" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div><br> <br> <br>
    </div>


    <h1 style="text-align:center; margin-top:50px;">Our Services</h1>


    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="banner">
                    <img src="images/blond-model-wedding-dress-bridal-makeup.jpg" alt="Card Image"
                        class="service-image">
                    <div class="caption">
                        <h4><i>Your Banner Text Here</i></h4>
                        <button class="bannerButton">Book now</button>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="banner">
                    <img src="images/locs male3.jpg" alt="Card Image" class="service-image">
                    <div class="caption">
                        <h4><i>Your Banner Text Here</i></h4>
                        <button class="bannerButton">Book now</button>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="banner">
                    <img src="images/locs female.jpg" alt="Card Image" class="service-image">
                    <div class="caption">
                        <h4><i>Your Banner Text Here</i></h4>
                        <button class="bannerButton">Book now</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="banner">
                    <img src="images/wig4.jpg" alt="Card Image" class="service-image">
                    <div class="caption">
                        <h4><i>Your Banner Text Here</i></h4>
                        <button class="bannerButton">Book now</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="banner">
                    <img src="images/braids2.jpg" alt="Card Image" class="service-image">
                    <div class="caption">
                        <h4><i>Your Banner Text Here</i></h4>
                        <button class="bannerButton">Book now</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="banner">
                    <img src="images/haircut1.jpg" alt="Card Image" class="service-image">
                    <div class="caption">
                        <h4><i>Your Banner Text Here</i></h4>
                        <button class="bannerButton">Book now</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="banner">
                    <img src="images/wig2.jpg" alt="Card Image" class="service-image">
                    <div class="caption">
                        <h4><i>Your Banner Text Here</i></h4>
                        <button class="bannerButton">Book now</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="r2" style="margin-top: 20px;">
        <!-- Content below .banner3 -->

        <div class="row">
            <h2 style="text-align:center">DIVERSE STYLING</h2>

            <div class="col-md-8">
                <div class="carousel slide" id="myCarousel" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="images/hero-treatments-list-7.jpg" class="d-block w-100" alt="image1" style="height: 400px; object-fit:contain;">
                            <div class="carousel-caption d-none d-md-block">
                                <p>image 1</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="images/trademark-vip-4.jpg" class="d-block w-100" alt="image2" style="height: 400px;">
                            <div class="carousel-caption d-none d-md-block">
                                <p>image 2</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="images/beautiful-face-young-woman-with-maroon-makeup-portrait-gorgeous-girl-with-vinous-lips.jpg"
                                class="d-block w-100" alt="" style="height: 400px;">
                            <div class="carousel-caption d-none d-md-block">
                                <p>image 3</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="images/braids-gallery-2.jpg" class="d-block w-100" alt="image4" style="height: 400px;">
                            <div class="carousel-caption d-none d-md-block">
                                <p>image 4</p>
                            </div>
                        </div>
                    </div>
                    <a href="#myCarousel" class="carousel-control-prev" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a href="" class="carousel-control-next" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div><br> <br> <br>
            </div>
            <div class="col-md-4">

                <p>Whilst at the leading edge in trends and fashion, the salon prides itself on listening and satisfying
                    clients by creating effortless and wearable hair with artistic and creative flair that never goes
                    out of style. The energetic and creative environment of Gielly Green with the understated
                    sophistication it exudes, really does offer the very best in hair and beauty that London currently
                    provides.

                    The ethos of Gielly Green is to provide a haven of indulgent satisfaction - a place to soothe the
                    mind, the body and soul.</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia asperiores fuga inventore hic
                    provident totam, aliquam consequuntur dignissimos, necessitatibus, maiores voluptas. Tempora, minus
                    omnis. Rem saepe maxime aliquam ullam mollitia.</p>
            </div>
        </div>
    </div>
    <div class="ar">

    </div>
    <?php include("footer.php"); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>