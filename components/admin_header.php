<?php
// error_reporting(0); 
$admin_id = $_SESSION['admin_id'];

if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<!DOCTYPE html>
<html lang="en">
   <head>
   <link rel="icon" href="../images/ecommerce logo.png">
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
   

<header class="header">

   <section class="flex">

      <a href="../admin/dashboard.php" class="logo">Admin :<span><?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?><?= $fetch_profile['adminname']; ?></span></a>

      <nav class="navbar">
        
         <a  href="../admin/dashboard.php">Home</a>
         <a  href="../admin/products.php">Products</a>
         <a  href="../admin/placed_orders.php">Orders</a>
         <a  href="../admin/admin_accounts.php">Admins</a>
         <a  href="../admin/users_accounts.php">Users</a>
         <a  href="../admin/messages.php">Messages</a>
         <a  href="../admin/subscription.php">Subscription</a>
      
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['adminname']; ?></p>
         <a href="../admin/update_profile.php" class="btn">Update profile</a>
         <div class="flex-btn">
            <a href="../admin/register_admin.php" class="option-btn">Register</a>
            <a href="../admin/admin_login.php" class="option-btn">Login</a>
         </div>
         <a href="../components/admin_logout.php" class="delete-btn" onclick="return confirm('Do you want to logout from the website?');">logout</a> 
      </div>

   </section>
   
</header>
<!-- <Footer style="text-align: center;">
   All rights reserved to Niteesh &copy; 2023
</Footer> -->
</body>
</html>