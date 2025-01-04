<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE adminname = ? AND adminpassword = ?");
   $select_admin->execute([$name, $pass]);
   
   if($select_admin->rowCount() > 0){
     $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
      $_SESSION['admin_id'] = $fetch_admin_id['id'];
      // echo $_SESSION['admin_id'];
      header('location:dashboard.php');
      $message[] = 'Login Working!😊';

   }else{
      $message[] = 'incorrect username or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <link rel="icon" href="../images/ecommerce logo.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>
  <?php
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

<section class="form-container">
  
  <form action="" method="post">
   <img src="../images/ecommerce logo.png" width="250px" height="130px" >
      <h3>Login</h3>
      <!-- <p>default username = <span>Niteesh/admin/Neethu/abc/af/fdhbuygbuyaguyaguyaguyasguyga/agrbgkfgffgvfd </span>password=<span>111</span></p> -->
      <input style="border: .2rem solid #444444;" type="text" id="admin_inp" name="name" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input style="border: .2rem solid #444444;" type="password" name="pass" required placeholder="enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login now" class="btn" name="submit">
   </form>

</section>
   
</body>
</html>