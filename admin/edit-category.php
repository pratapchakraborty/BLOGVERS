<?php
    include 'partials/header.php';
    if(isset($_GET['id'])){
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        
        //fetch category from db
        $query = "SELECT * FROM categories WHERE id=$id";
        $result = mysqli_query($connection,$query);
        if(mysqli_num_rows($result) == 1){
            $category = mysqli_fetch_assoc($result);
        }
    }else{
        header('location:' . ROOT_URL . 'admin/manage-categories.php');
        die();
    }
?>
    <!--================================ END OF NAV SECTION =================================-->


<section class="form__section">
    <div class="container form__section-container gap">
        <h2>Edit Category</h2>
        <!-- <div class="alert__message error">
            <p>This is an error message</p>
        </div> -->
        <form action="<?= ROOT_URL  ?>admin/edit-category-logic.php" method="POST">
        <input type="hidden" value="<?= $category['id']?>" name="id">
            <input type="text" value="<?= $category['title']?>" name="title" placeholder="Titlel">
            <textarea rows="4" name="description" placeholder="Description"><?= $category['description']?></textarea>
            <button type="submit" name="submit" class="btn">update Category</button>
        </form>
    </div>
</section>


<!--================================ END OF ADD POST SECTION =================================-->



<?php
    include '../partials/footer.php'
?>