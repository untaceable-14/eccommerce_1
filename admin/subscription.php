<?php

include '../components/connect.php';
session_start();
   
//  $admin_id = $_SESSION['admin_id'];

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
   $update_payment = $conn->prepare("UPDATE `abc` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   $message[] = 'payment status updated!';
 }
include '../components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Subscription</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/user_style.css">

   <link rel="icon" href="../images/ecommerce logo.png">

</head>
<body>
   
<?php include '../components/admin_header.php'; ?>

<h1 class="heading">Subscribe to Premium</h1>
<section class="orders">
<div class="box-container">

  <?php
      $select_orders = $conn->prepare("SELECT * FROM `abc`");
      $select_orders->execute();
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> Id : <span><?= $fetch_orders['id']; ?></span> </p>
      <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
      <form action="" method="post">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <?php
            if($admin_id==1){
         ?> 
         <select name="payment_status" class="select" default>
            <?php
               }
            ?>
         <?php
            if($admin_id==1){
         ?>
            <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
            <?php
               }
            ?>
         <?php
            if($admin_id!==1){
         ?>  
            <h1><option selected disabled><?= $fetch_orders['payment_status']; ?></option></h1>
            <?php
               }
            ?>
         <?php
            if($admin_id==1){
         ?>

            <option value="pending">pending</option>
            <option value="completed">completed</option>
            <?php
               }
            ?>
         </select>
        <div class="flex-btn">
           <?php
          if($admin_id==1){
             echo'<input type="submit" value="update" class="option-btn" name="update_payment" >';
        
         // echo'<a href="placed_orders.php?delete=' . $fetch_orders['id'] . '" class="delete-btn" onclick="return confirm(\'Delete this order?\');">delete</a>';
           }?> 
        </div>
      </form>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
   ?>
  </div>

</div>
</section>


<Footer>
   <center><p class="empty " style="margin-top: 36.8rem;  ">All rights reserved to Niteesh &copy; 2023</p> </center>
</Footer>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="../js/admin_script.js"></script>


</body>
</html>