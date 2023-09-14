<?php
    include 'partials/header.php';

    //get back from data if there was an error
    $firstname = $_SESSION['add-user-data']['firstName'] ?? null;
    $lastname = $_SESSION['add-user-data']['lastName'] ?? null;
    $username = $_SESSION['add-user-data']['username'] ?? null;
    $email = $_SESSION['add-user-data']['email'] ?? null;
    $createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
    $confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;
    

    //delete session data
    unset($_SESSION['add-user-data']);

?>
    <!--================================ END OF NAV SECTION =================================-->


<section class="form__section">
    <div class="container form__section-container">
        <h2>Add User</h2>
        <?php if(isset($_SESSION['add-user'])) : ?>
            <div class="alert__message error">
                <p>
                    <?= 
                        $_SESSION['add-user'];
                        unset($_SESSION['add-user']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="firstName" value="<?= $firstname ?>" placeholder="First Name">
            <input type="text" name="lastName"   value="<?= $lastname ?>"placeholder="Last Name">
            <input type="text" name="username"   value="<?= $username ?>"placeholder="Enter your User Name">
            <input type="text" name="email"   value="<?= $email ?>"placeholder="Enter your email">
            <input type="password" name="createpassword"   value="<?= $createpassword ?>"placeholder="Create Password">
            <input type="password" name="confirmpassword"   value="<?= $confirmpassword ?>"placeholder="Confirm Password">
            <select name="userrole">
                <option value="0">Author</option>
                <option value="1">Admin</option>
            </select>
            <div class="from__control">
                <lable for="avatar">User Avatar</lable>
                <input type="file" id="avatar" name="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Sign up</button>
            <!-- <small>Already have an account?<a href="../signin.php">Sign In</a></small> -->
        </form>
    </div>
</section>


<!--================================ END OF ADD POST SECTION =================================-->

<!-- 03:59:33 -->

<?php
    include '../partials/footer.php'
?>