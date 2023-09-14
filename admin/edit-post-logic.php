<?php
require 'config/database.php';

//make sure edit post button was clicked
if(isset($_POST['submit'])){
    //var_dump($_POST);exit;
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category_id'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES['thumbnail'];

    //set is_featured to 0 if it was unchecked
    $is_featured = $is_featured == 1 ?: 0;

    //check and validate input values
    if(!$title){
        $_SESSION['edit-post'] = "Could't update post. Invalid input.";
    }elseif(!$category_id){
        $_SESSION['edit-post'] = "Couldn't update post. Invalid input.";
    }elseif(!$body){
        $_SESSION['edit-post'] = "Couldn't update post. Invalid input.";
    }else{
        //delete existing thumbnail if new thumbnail was available
        if($thumbnail['name']){
            $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
            //echo $previous_thumbnail_path;
            if($previous_thumbnail_path){
                unlink($previous_thumbnail_path);
            }

            //work on new thumbnail
            //Rename image
            $time = time(); //make each upload name unique by useing current timestamp
            $thumbnail_name = $time . $thumbnail['name'];
            $thumbnail_tmp_name = $time . $thumbnail['tmp_name'];
            $thumbnail_destination_path = '../images/' . $thumbnail_name;
            //echo $thumbnail_destination_path."<br>";
            //make sure file is an image
            $allowed_files =['jpg','png','jpeg'];
            $extension = explode('.' , $thumbnail_name);
            $extension = end($extension);
            if(in_array($extension,$allowed_files)){
                //make sure thumbnail is not too large (2mb+)
                if($thumbnail['size'] < 2000000){
                    //upload avatar
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                }else{
                    $_SESSION['edit-post'] = "Couldn't update post. Thumbnail size is too big. Should be less than 2mb";
                }
            }else{
                $_SESSION['edit-post'] = "Couldn't update post. Thumbnail should be jpg, png or jpeg";
            }
        }
    }

    if(isset($_SESSION['edit-post'])){
        //redirect to manage post page if form was invalid
        $_SESSION['edit-post-data'] = $_POST;
        header('location:' . ROOT_URL . 'admin/');
        die();
       
    }else{
        
       //set is_featured of all posts to 0 if is_featured for this post is 1;
       if($is_featured == 1){
        $zero_all_is_featured_query = "UPDATE posts SET is_featured = 0";
        $zero_all_is_featured_result = mysqli_query($connection,$zero_all_is_featured_query);
    }
    //set thumbnail name if a new one was uploaded, else keep old thumbnail name
    $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;
    //echo $thumbnail_to_insert;die;
    $query = "UPDATE posts SET title='$title', body='$body', thumbnail='$thumbnail_to_insert', category_id=$category_id, is_featured =$is_featured WHERE id = $id LIMIT 1";
    // echo $query;
    // die();
    $result = mysqli_query($connection, $query);
    }

    if(!mysqli_errno($connection)){
        $_SESSION['edit-post-success'] = "Post updated successfully";
    }
}
header('location:' . ROOT_URL . 'admin/');
die();
?>