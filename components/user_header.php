<?php
// session_start();
include 'connect.php';
if(isset($_SESSION['user_id'])){
  $user_id=$_SESSION['user_id'];
}else{
  $user_id= '';
}


if(isset($message)){
   if(is_array($message) || is_object($message)){
      foreach($message as $item){
         echo '
         <div class="message">
            <span>'.$item.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user header</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

   <link rel="stylesheet" href="../css/a.css">
</head>
<body>
   

<header class="header">

   <section class="flex">
      <a href="home.php" class="logo"><span><b>S</b></span>hop<span><b>E</b></span>azee</a>

      <nav class="navbar">
         <a href="home.php">Home</a>
         <a href="about.php">About</a>
         <a href="orders.php">Orders</a>
         <a href="shop.php">Shop</a>
         <a href="contact.php">Contact</a>
         <a href="subscribe.php">Subscription</a>
      </nav>

      <div class="icons">
         <?php
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            $total_wishlist_counts = $count_wishlist_items->rowCount();

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <a href="search_page.php"><div class="fas fa-search"></div></a>
         <a href="wishlist.php"><div id="header_heart" class="fas fa-heart"></div><span style="font-size: 20px;">(<?= $total_wishlist_counts; ?>)</span></a>
         <a href="cart.php"><div class="fas fa-shopping-cart"></div><span style="font-size: 20px;">(<?= $total_cart_counts; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
      <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile["user_name"]; ?></p>
         <a href="update_user.php" class="btn">update profile</a>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>
         <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
         <?php
            }else{
         ?>
         <p>please login or register first!</p>
         <div class="flex-btn">
            <a href="user_register.php" class="option-btn">register</a>
            <a href="user_login.php" class="option-btn">login</a>
         </div>
         <?php
            }
         ?>  
         
         
      </div>

   </section>

</header>
</body>
</html>