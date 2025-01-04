<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admins = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
   $delete_admins->execute([$delete_id]);
   header('location:admin_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Accounts</title>
   <link rel="icon" href="../images/ecommerce logo.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="accounts">

   <h1 class="heading">admin accounts</h1>

   <div class="box-container">

   <div class="box">
      <p>Register Admin</p>
      <a href="register_admin.php" class="option-btn">Register Admin</a>
   </div>

   <?php
      $select_accounts = $conn->prepare("SELECT * FROM `admins`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box">
      <p> Admin id : <span><?= $fetch_accounts["id"]; ?></span> </p>
      <p> Admin name : <span><?= $fetch_accounts["adminname"]; ?></span> </p>
      <!-- <?php
      if($admin_id==1){
      echo '<p> Admin password : <span><?= $fetch_accounts["adminpassword"]; ?></span> </p>'; 
      }
      ?> -->
      <div class="flex-btn">
         
         <?php

      if($admin_id == 1){  
               echo '<a href="admin_accounts.php?delete=' . $fetch_accounts['id'] . '" onclick="return confirm(\'Delete this account?\')" class="delete-btn">delete</a>';
               echo '<a href="update_profile.php" class="option-btn">update</a>';

                  if($fetch_accounts['id'] == $admin_id && $fetch_accounts['id'] != 1){//else we can you this staement if($fetch_accounts['id'] == $admin_id){
               echo '<a href="update_profile.php" class="option-btn">update</a>';

                  }
               }
         ?>
         <?php
         if($fetch_accounts['id'] == $admin_id && $fetch_accounts['id'] != 1){
            echo '<a href="admin_accounts.php?delete=' . $fetch_accounts['id'] . '" onclick="return confirm(\'Delete this account?\')" class="delete-btn">delete</a>';
            echo '<a href="update_profile.php" class="option-btn">update</a>';

         }
         ?>
      </div>
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
   <center><p class="empty " style="margin-top: 36.8rem;  ">All rights reserved to Niteesh &copy; 2023</p> </center>
</Footer>
</body>
</html>
<!--   -->