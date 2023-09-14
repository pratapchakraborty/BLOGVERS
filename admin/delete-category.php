<?php
require 'config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //FOR LATER
    //update category_id of posts that belong to this category to id of uncategorized category
    $update_query = "UPDATE posts SET category_id=11 WHERE category_id=$id";
    $update_result = mysqli_query($connection, $update_query);

    if(!mysqli_errno($connection)){
        //delete category
        $query = "DELETE FROM categories WHERE id=$id LIMIT 1";
        $result = mysqli_query($connection, $query);
        $_SESSION['delete-category-success'] = "Category deleted Successfully";
    }


}

header('location:' . ROOT_URL . 'admin/manage-categories.php');
die();


// ALTER TABLE posts ADD CONSTRAINT FK_blog_author FOREIGN KEY (author_id) REFERENCES users (id) ON DELETE CASCADE;


?>