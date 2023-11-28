<?php
include('../css.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .set {
            border: 1px solid #e0e0e0;
            margin: 30px;
            padding: 15px;
            border-radius: 5px;
           
        }

        .set a {
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            /*align-items: center; */
        }

        .set i {
            font-size: 2rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
   <div class="container">
       <div class="accountSettings set">
           <a href="profile.php?edit_account" class="d-flex">
               <i class="fas fa-user"></i>
               <div class="text">
               <h2 class="text-warning">Account settings</h2>
               <p>Edit your account details</p>
               </div>
           </a>
       </div>

       <div class="viewAccount set">
           <a href="">
               <i class="fas fa-eye"></i>
              <div class="text">
              <h2 class="text-warning">View account details</h2>
               <p>View details about your account.</p>
              </div>
           </a>
       </div>

       <div class="delete set">
           <a href="">
               <i class="fas fa-trash-alt"></i>
               <div class="text">
               <h2 class="text-danger">Delete account</h2>
               <p>Will permanently delete your account</p>
               </div>
           </a>
       </div>
   </div>

    <?php
        include('../js.php');
    ?>
</body>
</html>
