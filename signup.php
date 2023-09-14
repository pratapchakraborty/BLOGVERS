<?php 
require 'config/constants.php';

//get back form data if there was a registration error
$firstname = $_SESSION['signup-data']['firstName'] ?? null;
$lastname = $_SESSION['signup-data']['lastName'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createPassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmPassword'] ?? null;

//delete signup data session
unset($_SESSION['signup-data']);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP & MySQL Blog Application with Admin Panel</title>
    
    <!--CUSTOM STYLESHEET-->

    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    
    <!--ICONCOUT CDN-->

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <!--GOOGLE FONTS (MONTSERRAT)-->

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Sign Up</h2>
        <?php if(isset($_SESSION['signup'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= 
                    $_SESSION['signup'];
                    unset($_SESSION['signup']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="firstName" value="<?= $firstname ?>" placeholder="First Name">
            <input type="text" name="lastName" value="<?= $lastname ?>" placeholder="Last Name">
            <input type="text" name="username"value="<?= $username ?>"  placeholder="Enter your User Name">
            <input type="text" name="email" value="<?= $email ?>" placeholder="Enter your email">
            <input type="password" name="createPassword" value="<?= $createpassword ?>" placeholder="Create Password">
            <input type="password" name="confirmPassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password">
            <div class="from__control">
                <lable for="avatar">User Avatar</lable>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Sign up</button>
            <small>Already have an account?<a href="signin.php">Sign In</a></small>
        </form>
    </div>
</section>


<!--================================ END OF SIGN UP SECTION =================================-->



<!-- <footer>
    <div class="footer__socials">
        <a href="https://youtube.com" target="_blank"><i class="uil uil-youtube"></i></a>
        <a href="https://www.facebook.com/brithis2275/" target="_blank"><i class="uil uil-facebook"></i></a>
        <a href="https://www.instagram.com/britiz_e/" target="_blank"><i class="uil uil-instagram-alt"></i></a>
        <a href="https://in.linkedin.com/" target="_blank"><i class="uil uil-linkedin"></i></a>
        <a href="https://twitter.com/PratapChak89924" target="_blank"><i class="uil uil-twitter"></i></a>
    </div>
    <div class="container footer__container">
        <article>
            <h4>categories</h4>
            <ul>
                <li><a href="">Art</a></li>
                <li><a href="">Wild Life</a></li>
                <li><a href="">Travel</a></li>
                <li><a href="">Science & Technology</a></li>
                <li><a href="">Food</a></li>
                <li><a href="">Music</a></li>
            </ul>
        </article>
        <article>
            <h4>Support</h4>
            <ul>
                <li><a href="">Online Support</a></li>
                <li><a href="">Call Numbers</a></li>
                <li><a href="">Emails</a></li>
                <li><a href="">Social Support</a></li>
                <li><a href="">Location</a></li>
            </ul>
        </article>
        <article>
            <h4>Blog</h4>
            <ul>
                <li><a href="">Safety</a></li>
                <li><a href="">Repair</a></li>
                <li><a href="">Recent</a></li>
                <li><a href="">Popular</a></li>
                <li><a href="">Categories</a></li>
            </ul>
        </article>
        <article>
            <h4>Permalinks</h4>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Blog</a></li>
                <li><a href="">About</a></li>
                <li><a href="">Services</a></li>
                <li><a href="">Contact</a></li>
            </ul>
        </article>
    </div>
    <div class="footer__copyright">
        <small>Copyright &copy; BLOGVERS 2023</small>
    </div>
</footer> -->

<!--================================ FOOTER =================================-->

<script src="js/main.js"></script>

</body>
</html>