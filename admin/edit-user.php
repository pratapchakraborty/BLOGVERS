<?php
    include 'partials/header.php';
    if(isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * fROM users WHERE id=$id";
        $result = mysqli_query($connection,$query);
        $user = mysqli_fetch_assoc($result);
    } else{
        header('location: ' . ROOT_URL . 'admin/manage-users.php');
        die();
    }
?>
    <!--================================ END OF NAV SECTION =================================-->


<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit User</h2>
        <!-- <div class="alert__message error">
            <p>This is an error message</p>
        </div> -->
        <form action="<?= ROOT_URL?>admin/edit-user-logic.php" enctype="multipart/form-data" method="POST">
        <input type="hidden" value="<?= $user['id']?>" name="id">
            <input type="text" value="<?= $user['firstname']?>" name="firstName" placeholder="First Name">
            <input type="text" value="<?= $user['lastname']?>" name="lastName" placeholder="Last Name">
            <div class="from__control">
                <label for="user-role">User Role</label>
                <select name="userrole">
                    <option value="0">Author</option>
                    <option value="1">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn" name="submit">Update User</button>
        </form>
    </div>
</section>


<!--================================ END OF ADD POST SECTION =================================-->



<?php
    include '../partials/footer.php'
?>