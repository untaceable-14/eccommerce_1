/*First create a database in any local server on a pc name the database as what is given in the file name connect.php. The name of the databse should be same in both connect.php file and n the server, then only the website works properly. After doing this step copy and run the sql file in the sql section in the database has been created. Thats all everything is done.*/














SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `abc` (
  `id` int(100) NOT NULL,
   `name` varchar(255) NOT NULL ,
    `payment_status` varchar(200) NOT NULL 
 ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `adminname` varchar(200) NOT NULL,
  `adminpassword` varchar(50) NOT NULL
 )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `admins` (`id`, `adminname`, `adminpassword`) VALUES
(1, 'niteesh', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');


CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(1000) NOT NULL,
  `price` int(100) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- INSERT INTO `users` (`id`, `user_name`,`email`, `password`) VALUES
-- (1, 'niteesh','niteesh2june@gmail.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `abc`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `abc`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;


ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;


ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;
