<?php
    include 'partials/header.php';

    //fetch category from db
    $category_query = "SELECT * FROM categories";
    $categories = mysqli_query($connection, $category_query);

    //fetch post data from db if id is set
    if(isset($_GET['id'])){
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM posts WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $post = mysqli_fetch_assoc($result);
    }else{
        header('location:' . ROOT_URL . 'admin/');
        die();
    }
?>
    <!--================================ END OF NAV SECTION =================================-->


<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Post</h2>
        <!-- <div class="alert__message error">
            <p>This is an error message</p>
        </div> -->
        <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="id" value="<?= $post['id']?>">    
        <input type="hidden" name="previous_thumbnail_name" value="<?= $post['thumbnail']?>">
        <input type="text" name="title" value="<?= $post['title']?>" placeholder="title">
            <select name="category_id">
                <?php while($category = mysqli_fetch_assoc($categories)) : ?>
                <option value="<?= $category['id']?>"><?= $category['title']?></option>
                <?php endwhile ?>
            </select>
            <textarea rows="10" name="body" placeholder="Body"><?= $post['body']?></textarea>
            <div class="form__control">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" checked>
                <label for="is_featured">Featured</label>
            </div>
            <div class="form__control">
                <label for="thubnail">Change Thubnail</label>
                <input type="file" name="thumbnail" id="Thumbnail">
            </div>
            <button type="submit" name="submit" class="btn">Update Post</button>
            <!-- <small>Don't have an account?<a href="signup.html">Sign Up</a></small> -->
        </form>
    </div>
</section>


<!--================================ END OF ADD POST SECTION =================================-->



<?php
    include '../partials/footer.php'
?>
