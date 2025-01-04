<?php

include 'components/connect.php';
// $admin_id = $_SESSION['admin_id'];

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');


};


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

   <link rel="stylesheet" href="css/b.css">

   <link rel="icon" href="images/ecommerce logo.png">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>













<section class="subscribe">
   <h1 class="heading">Subscribe to Premium</h1>



   
   
   <div class="box-container">
   
      <form action="" method="post" class="box">
         <p><h1 style="font-size: 20px;">Benefits of Premium</h1>
    <h3><li>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Exercitationem sapiente libero perspiciatis facere, distinctio nesciunt vero amet eum architecto non!</h3></li>
    <h3><li>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quos excepturi dolor suscipit vel repellat debitis sunt voluptate aspernatur unde earum!</h3></li>
    <h3><li>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quos excepturi dolor suscipit vel repellat debitis sunt voluptate aspernatur unde earum!</h3></li>
  </p>
<div class="xas"></div>
      
         <div class="flex-btn">
     <div class="box"><p style="text-align: center; padding-right: 50px; font-size: 40px;">Basic premium plan costs (₹199/-) per month</p>      
      <span><a href="paymentpage.php"><h1 class="abtn" >Buy Prime</h1></a></span></div>
      <div class="xas"></div>

      <div class="box"><p style="text-align: center; padding-right: 50px; font-size: 40px;">Advanced premium plan costs (₹299/-) per month</p>
      <a href="paymentpage.php"><h1 class="abtn" >Buy Prime</h1></a></div>
      
     
  
</div>
<div class="xas"></div>
<div class="flex-btn">

<div class="box"><p style="text-align: center; padding-right: 50px; font-size: 40px;">Basic premium plan costs (₹1999/-) per year <br> (you save ₹389)</p>
      <a href="paymentpage.php"><h1 class="aoption-btn" >Buy Prime</h1></a></div>
      
<div class="xas"></div>
      
      <div class="box"><p style="text-align: center; padding-right: 50px; font-size: 40px;">Advanced premium plan costs (₹2999/-) per year <br>(you save ₹389)</p>
      <a href="paymentpage.php"><h1 class="aoption-btn" >Buy Prime</h1></a></div>

</div>
  
       <div class="xas"></div>
      </form>
 </div>

</section>














<?php 
include 'components/user_footer.php';

?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/user_script.js"></script>


</body>
</html>