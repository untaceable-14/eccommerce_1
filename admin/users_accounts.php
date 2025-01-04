<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
  header('location:admin_login.php');
}

if(isset($_GET['delete'])){
  $delete_id = $_GET['delete'];
  $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
  $delete_users->execute([$delete_id]);
  $delete_users1 = $conn->prepare("DELETE FROM `abc` WHERE id = ?");
  $delete_users1->execute([$delete_id]);  
  $delete_order = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
  $delete_order->execute([$delete_id]);
  $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
  $delete_cart->execute([$delete_id]);
  $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
  $delete_wishlist->execute([$delete_id]);
  $delete_messages = $conn->prepare("DELETE FROM `messages` WHERE user_id = ?");
  $delete_messages->execute([$delete_id]);
  header('location:admin_accounts.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User accounts</title>
   <link rel="icon" href="../images/ecommerce logo.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>
<?php include '../components/admin_header.php' ?>
<section class="accounts">

   <h1 class="heading">users accounts</h1>

   <div class="box-container">

   <!-- <div class="box">
      <p>Register Admin</p>
      <a href="register_admin.php" class="option-btn">register admin</a>
   </div> -->

   <?php
      $select_accounts = $conn->prepare("SELECT * FROM `users`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box">
      <p> user id : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> user name : <span><?= $fetch_accounts['user_name']; ?></span> </p>
      <!-- <p> Admin password : <span><?= $fetch_accounts['password']; ?></span> </p> -->
      <?php
      if($admin_id == 1){
         echo '<a href="users_accounts.php?delete=' . $fetch_accounts['id'] . '" onclick="return confirm(\'Do you want to delete this account?\')" class="delete-btn">delete</a>';

      }
      ?>   
      <!-- echo' <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('Do you want to delete this account?')" class="delete-btn">delete</a>'; -->
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no accounts available!</p>';
      }
   ?>
   </div>

</section>
  <script src="../js/admin_script.js"></script>  
  <Footer>
   <center><p class="empty " style="margin-top: 36.8rem;">All rights reserved to Niteesh &copy; 2023</p> </center>
</Footer> 
</body>
</html>


