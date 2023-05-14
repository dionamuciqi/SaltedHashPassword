<?php

include 'config.php';

session_start();

if(isset($_POST['submit'])){

    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : null;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : null;
    $salt = "SUDO";

    $pass = isset($_POST['password']) ? $_POST['password'].$salt : null;
    $pass = $pass ? md5($pass) : null;

    $cpass = isset($_POST['cpassword']) ? $_POST['cpassword'].$salt : null;
    $cpass = $cpass ? md5($cpass) : null;

    $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : null;

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_array($result);

        if($row['user_type'] == 'Teacher'){

            $_SESSION['teacher_name'] = $row['name'];
            header('location:teacher_page.php');

        }elseif($row['user_type'] == 'Student'){

            $_SESSION['student_name'] = $row['name'];
            header('location:student_page.php');

        }

    }else{
        $error[] = 'incorrect email or password!';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="form-container">

    <form action="" method="post">
        <h3>Login now</h3>
        <?php
        if(isset($error) && is_array($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            };
        };
        ?>
        <input type="email" name="email" required placeholder="enter your email" >
        <input type="password" name="password" required placeholder="enter your password" >
        <input type="submit" name="submit" value="login now" class="form-btn">
        <p>Don't have an account? <a href="register_form.php">Register now</a></p>
    </form>

</div>

</body>
</html>
