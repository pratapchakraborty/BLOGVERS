<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    //var_dump($_POST);exit;
    //get the form data
    
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    

    if(!$title){
        $_SESSION['add-category'] = "Please enter title";
    }elseif(!$description){
        $_SESSION['add-category'] = "Please enter description";
    }
    //redirect back to add-category page with form data if there was an invalid input
    if(isset($_SESSION['add-category'])){
        $_SESSION['add-category-data'] = $_POST;
        //var_dump($_POST);exit;
        header('location:' . ROOT_URL . 'admin/add-category.php');
        die(); 
    }else{
        // inser category into db
        $query = "INSERT INTO categories (title, description) VALUE ('$title', '$description')";
        $result = mysqli_query($connection, $query);
        if(mysqli_errno($connection)){
            $_SESSION['add-category'] = "Couldn't add category";
            header('location:' . ROOT_URL . 'admin/add-category.php');
            die(); 
        }else{
            $_SESSION['add-category-success'] = "$title category added successfully";
            header('location:' . ROOT_URL . 'admin/manage-categories.php');
            die();
        }
    }

}


?>