<?php

include 'config.php';
include 'hash_function.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);
   $hashed_password = generate_hash($password);
   $user_type = $_POST['user_type'];

   $select = "SELECT * FROM user_form WHERE email = '$email'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'User already exists!';

   }else{

      $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$hashed_password','$user_type')";
      mysqli_query($conn, $insert);
      header('location:login_form.php');

   }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Register Now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="Enter your name" require>
      <input type="email" name="email" required placeholder="Enter your email" require>
      <input type="password" name="password" required placeholder="Enter your password" require>
      <select name="user_type">
         <option value="Student">Student</option>
         <option value="Teacher">Teacher</option>
      </select>
      <input type="submit" name="submit" value="Register Now" class="form-btn">
      <p>Already have an account? <a href="login_form.php">Login now</a></p>
   </form>

</div>

</body>
</html>
