<?php
    require 'config/constants.php';

    $username_email = $_SESSION['signin-data']['username_email'] ?? null;
    $password = $_SESSION['signin-data']['password'] ?? null;
    unset($_SESSION['signin-data']);
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
        <h2>Sign In</h2>
        <?php if(isset($_SESSION['signup-success'])) : ?>
        <div class="alert__message success">
            <p>
                <?= $_SESSION['signup-success'];
                unset($_SESSION['signup-success']);
                ?>
            </p>
        </div>
        <?php elseif(isset($_SESSION['signin'])) : ?>
        <div class="alert__message error">
            <p>
                <?= $_SESSION['signin'];
                unset($_SESSION['signin']);
                ?>
            </p>
        </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>signin-logic.php" method="POST">
            <input type="text" value="<?= $username_email ?>" name="username_email" placeholder="User Name or Email">
            <input type="password" value="<?= $password ?>" name="password" placeholder="Password">
            <button type="submit" name="submit" class="btn">Sign In</button>
            <small>Don't have an account?<a href="<?= ROOT_URL ?>signup.php">Sign Up</a></small>
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