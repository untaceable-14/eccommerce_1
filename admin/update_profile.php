<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
  header('location:admin_login.php');
}

if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);
  
  $update_profile_name = $conn->prepare("UPDATE `admins` SET adminname = ? WHERE id = ?");
   $update_profile_name->execute([$name, $admin_id]);

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);



   if($old_pass == $empty_pass){
    $message[] = 'Please enter your old password!';
 }elseif($old_pass != $prev_pass){
    $message[] = 'You have entered a wrong password! ☹';
 }elseif($new_pass != $confirm_pass){
    $message[] = "New passwords doesn't match! ☹";
 }else{
    if($new_pass != $empty_pass){
       $update_admin_pass = $conn->prepare("UPDATE `admins` SET adminpassword = ? WHERE id = ?");
       $update_admin_pass->execute([$confirm_pass, $admin_id]);
       $message[] = 'Password updated successfully! 😃';
    }else{
       $message[] = 'Please enter a new password!';
    }
 }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profile update</title>
   <link rel="icon" href="../images/ecommerce logo.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>


<section class="form-container">
  
  <form action="" method="post">
   <img src="../images/ecommerce logo.png" width="250px" height="130px" >
      <h3>Update profile</h3>
      <input style="border: .2rem solid #444444;" type="hidden" name="prev_pass" value="<?=$fetch_profile['adminpassword'];?>">
      <input style="border: .2rem solid #444444;" type="text" id="admin_inp" name="name"  placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?=$fetch_profile['adminname'];?>">
      <input style="border: .2rem solid #444444;" type="password" name="old_pass"  placeholder="enter your old password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input style="border: .2rem solid #444444;" type="password" name="new_pass"  placeholder="enter your new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input style="border: .2rem solid #444444;" type="password" name="confirm_pass"  placeholder="confirm your new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Update now" class="btn" name="submit">
   </form>

</section>








  <script src="../js/admin_script.js"></script>   
  <Footer>
   <center><p class="empty " style="margin-top: 10rem;  ">All rights reserved to Niteesh &copy; 2023</p> </center>
</Footer>
</body>
</html>


<!-- <pre><div style="color: red;" >Niteesh'<small>s</small></div>  E-commerce  Dashboard</pre> -->