<?php

include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
//   echo"hello";
}else{
  $user_id = '';
   header('location:user_login.php');
 
  
};


$subscription=0;
$select_subscription = $conn->prepare("SELECT * FROM `abc` WHERE  id=? AND payment_status = ? ");
$select_subscription->execute([$user_id,'completed']);
$fetch_subscribtion = $select_subscription->fetch(PDO::FETCH_ASSOC);
$subscription =$fetch_subscribtion['payment_status'];
// echo $subscription;

if($subscription === 'completed'){
if(isset($_POST['send'])){

  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);
  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $number = $_POST['number'];
  $number = filter_var($number, FILTER_SANITIZE_STRING);
  $msg = $_POST['msg'];
  $msg = filter_var($msg, FILTER_SANITIZE_STRING);

  $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
  $select_message->execute([$name, $email, $number, $msg]);

  if($select_message->rowCount() > 0){
     $message[] = 'Already sent message!';
  }else{

     $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
     $insert_message->execute([$user_id, $name, $email, $number, $msg]);

     $message[] = 'Sent message successfully!';

  }

}}
else{
  $message[]="Get subscription";
  header("location:subscribe.php");
}
include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/user_style.css">

   <link rel="icon" href="images/ecommerce logo.png">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>



<section class="contact">

   <form action="" method="post">
      <h3>Get in touch with us</h3>
      <input type="text" name="name" placeholder="enter your name" required maxlength="20" class="box">
      <input type="email" name="email" placeholder="enter your email" required maxlength="50" class="box">
      <input type="number" name="number" min="0" max="9999999999" placeholder="enter your number" required onkeypress="if(this.value.length == 10) return false;" class="box">
      <textarea name="msg" class="box" placeholder="enter your message" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>
</section>
   



<?php 
include 'components/user_footer.php';

?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/user_script.js"></script>


</body>
</html>