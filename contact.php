<?php

include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

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

   <link rel="icon" href="ecommerce logo.png">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>





<section class="form-container">
<div class="contact">
<form action="" method="post" >
      <h3>Contact us</h3>
      <h1 class="messaging"></h1>

      <input type="text" name="name" id="msg" placeholder="enter your name"   class="box">
      <input type="email" name="email" id="msg" placeholder="enter your email"   class="box">
      <textarea name="message" value="" id="msg" class="box" placeholder="enter your message" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" onclick="doordie()" class="btn">

      <p>Want immediate response from us ?</p>
      <a href="contact2.php" style="color: white;" class="btn"> Click Here</a>
 
      </form>
      
   <script>
        
       


        function doordie() {
  var allInputs = document.querySelectorAll('input');
  var a =1;
  for (var i = 0; i < allInputs.length; i++) {
    if (allInputs[i].value === '') {
      alert('Please fill out all fields.');
      return false;
    }
    else{
      let url = "https://script.google.com/macros/s/AKfycbwgVgZvnM4wPRS3neGaOguxE6C0SEyIu6OlqBpQ8FhfrIQ9Yr-5ey9GIhC06ueYVzdY/exec";
        let form = document.querySelector("form");
        let submit = document.querySelector(".btn");
        let message = document.querySelector(".messaging");
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            submit.value = "submitting.."
            fetch(url, {
                    method: "POST",
                    body: new FormData(form)
                })
                .then(res => res.text())
                .then(data => {
                    message.innerHTML = data;
                    submit.value = "send message"
    
                })
                .catch(err => {
                    message.innerHTML = err;
                    submit.value = "send message"
                })
        })
    }
  }
//   return true;
}



    </script>
    </div>
</section>

<!-- form.addEventListener('submit', (e) => {
            e.preventDefault();
            submit.value = "submitting.." -->




<?php 
include 'components/user_footer.php';

?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/user_script.js"></script>


</body>
</html>