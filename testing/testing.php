<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
  header('location:admin_login.php');
}
if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
   $update_payment = $conn->prepare("UPDATE `abc` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   $message[] = 'payment status updated!';
 }
 
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

   <link rel="stylesheet" href="../css/admin_style.css">

   <link rel="icon" href="images/ecommerce logo.png">

</head>
<body>
   
<?php include '../components/admin_header.php'; ?>







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

      }
      ?>   
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no accounts available!</p>';
      }
   ?><?php
   $select_orders = $conn->prepare("SELECT * FROM `orders`");
   $select_orders->execute();
   if($select_orders->rowCount() > 0){
      while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
?><form action="" method="post">
<input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
<select name="payment_status" class="select" default>
   <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
   <option value="pending">Pending</option>
   <option value="completed">Completed</option>
</select>
<div class="flex-btn">
 <input type="submit" value="update" class="option-btn" name="update_payment" >
 <?php
 if($admin_id==1){
echo'<a href="placed_orders.php?delete=' . $fetch_orders['id'] . '" class="delete-btn" onclick="return confirm(\'Delete this order?\');">delete</a>';
 }
 ?>
</div>
</form>
<?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
   ?>

   </div>

</section>







</body>
</html>