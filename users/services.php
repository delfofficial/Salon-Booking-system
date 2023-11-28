<?php
//session_start();
include('../connect.php');

$user_name = $_SESSION["name"];
$sql = "SELECT * FROM services";
$result = mysqli_query($conn, $sql);
while ($row=mysqli_fetch_assoc($result)) {
    $service_name=$row['service_name'];
    $image1=$row['image1'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<?php include('../css.php');?>
</head>
<style>
    tr{
        margin-right:20px;
    }
    .product_image {
            width: 200px;
            height: 120px;
            object-fit: contain;
        }
</style>
<body>
<table>
        <thead class="px-20 mx-20">
            <tr class="bg-warning text-light px-30">
                <th>Service Name</th>
                <th>Image</th>

            </tr>
        </thead>
        <tbody>
<?php
 $sql = "select * from services";
 $result = mysqli_query($conn, $sql);
 
 while ($row = mysqli_fetch_assoc($result)) {
    $service_name=$row['service_name'];
    $image1=$row['image1'];
   // $user_image='';

   // if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK) {

    echo '<tr class="bg-light text-dark">';
                echo "<td>$service_name</td>"; // Corrected variable interpolation
                echo '<td><img src="../images/' . $image1 . '" alt="" class="product_image"></td>'; // Updated image source path

                echo '</tr>';

 }
?>

        </tbody>
    </table>


<?php include('../css.php');?>  
</body>
</html>