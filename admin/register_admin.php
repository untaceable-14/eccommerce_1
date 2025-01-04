<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
  header('location:admin_login.php');
};
if(isset($_POST['submit'])){

  $name = $_POST['name'];
  $name = filter_var($name, FILTER_SANITIZE_STRING);
  $pass = sha1($_POST['pass']);
  $pass = filter_var($pass, FILTER_SANITIZE_STRING);
  $cpass = sha1($_POST['cpass']);
  $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

  $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE adminname = ?");
  $select_admin->execute([$name]);
  
  if($select_admin->rowCount() > 0){  
     $message[] = 'User already exists !';

  }else{
    if($pass != $cpass){
      $message[] = "Passwords does'nt match";
    }
    else{
      $insert_admin = $conn->prepare("INSERT INTO admins(adminname, adminpassword) VALUES(?,?)");
      $insert_admin->execute([$name, $cpass]);
      $message[] = 'New admin registered!😊';
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
   <title>Register</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="icon" href="../images/ecommerce logo.png">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>
  
<?php include '../components/admin_header.php' ?>


<section class="form-container">
  
  <form action="" method="post">
   <img src="../images/ecommerce logo.png" width="250px" height="130px" >
      <h3>New Registration</h3>
      <input style="border: .2rem solid #444444;" type="text" id="admin_inp" name="name" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input style="border: .2rem solid #444444;" type="password" name="pass" required placeholder="enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input style="border: .2rem solid #444444;" type="password" name="cpass" required placeholder="confirm your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="register now" class="btn" name="submit">
   </form>

</section>













  <script src="../js/admin_script.js"></script>   
  <Footer>
   <center><p class="empty " style="margin-top: 2px;">All rights reserved to Niteesh &copy; 2023</p> </center>
</Footer>
</body>
</html>


<!-- <pre><div style="color: red;" >Niteesh'<small>s</small></div>  E-commerce  Dashboard</pre> -->