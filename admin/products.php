
<?php
include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
  header('location:admin_login.php');
}

if(isset($_POST['add_product'])){
  $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/'.$image_03;

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);


   if($select_products->rowCount() > 0){
    $message[]='Product name already exists';

   }else{
    $insert_products = $conn->prepare("INSERT INTO products(name, details, price, image_01, image_02, image_03) VALUES(?,?,?,?,?,?)");
    $insert_products->execute([$name, $details, $price, $image_01, $image_02, $image_03]);

    if($insert_products){
      if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
         $message[] = 'image size is too large!';
      }
      else{
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         move_uploaded_file($image_tmp_name_02, $image_folder_02);
         move_uploaded_file($image_tmp_name_03, $image_folder_03);
         $message[] = 'new product added!';
      }
    }

   }
};



if(isset($_GET['delete'])){

  $delete_id = $_GET['delete'];
  $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
  $delete_product_image->execute([$delete_id]);
  $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
  unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
  unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
  unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
  $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
  $delete_product->execute([$delete_id]);
  $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
  $delete_cart->execute([$delete_id]);
  $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
  $delete_wishlist->execute([$delete_id]);
  header('location:products.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>
   <link rel="icon" href="../images/ecommerce logo.png">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>
<?php include '../components/admin_header.php' ?>
<section class="add-products">
  <h1 class="heading">Add Products</h1>
  <form action="" method="post" enctype="multipart/form-data">
    <div class="flex">
      <div class="inputBox">
        <span>Product Name(Required)</span>
        <input style="border: .2rem solid #444444;" type="text" name="name" class="box" required placeholder="Enter product name" maxlength="200">

      </div>
      
      <div class="inputBox">
        <span>Product Price(Required)</span>
        <input style="border: .2rem solid #444444;" type="text" name="price" class="box" required placeholder="Enter product price" onkeypress="if(this.value.length == 10) return false;" min="0" max="9999999999">

      </div>
      <div class="inputBox">
        <span>Product Image 01(Required)</span>
        <input style="border: .2rem solid #444444;" type="file" name="image_01" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      </div>
      <div class="inputBox">
        <span>Product Image 02(Required)</span>
        <input style="border: .2rem solid #444444;" type="file" name="image_02" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      </div>
      <div class="inputBox">
        <span>Product Image 03(Required)</span>
        <input style="border: .2rem solid #444444;" type="file" name="image_03" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      </div>
      <div class="inputBox">
        <span>Product Details</span>
        <textarea style="height: 5.8rem;resize:vertical; border: .2rem solid #444444;" name="details" class="box" placeholder="Enter product details" required maxlength="5000" cols="30" rows="10"></textarea>
      </div>
        <input  type="submit" value="Add Product" name="add_product" class="btn">

    </div>
  </form>
</section> 












<section class="show-products">

   <h1 class="heading">Products added</h1>

   <div class="box-container">

   <?php
      $show_products = $conn->prepare("SELECT * FROM `products`");
      $show_products->execute();
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <div class="price">₹<span><?= $fetch_products['price']; ?></span>/-</div>
      <div class="details"><span><?= $fetch_products['details']; ?></span></div>
      <div class="flex-btn">
         <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Update</a>
         <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">Delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>
   
   </div>

</section>









  <script src="../js/admin_script.js"></script>   

  <Footer>
   <center><p class="empty " style="margin-top: 10rem;  ">All rights reserved to Niteesh &copy; 2023</p> </center>
</Footer>
</body>
</html>

