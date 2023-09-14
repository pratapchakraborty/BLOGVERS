<?php
//04:47:49
require 'config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //fetch user form db
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    //make sure we got back only one user

    if(mysqli_num_rows($result) == 1){
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;
        //delete image if available

        if($avatar_path){
            unlink($avatar_path);
        }
    }
    //FOR LATER
    //fetch all thumbnails of user's post and delete them
    $thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id=$id";
    $thumbnails_result = mysqli_query($connection, $thumbnails_query);
    if(mysqli_num_rows($thumbnails_result) > 0){
        while($thubmnail = mysqli_fetch_assoc($thumbnails_result)){
            $thumbnail_path = '../images/' . $thumbnail['thumbnail'];

            //delete thumbnailfrom images folder if exists
            if($thumbnail_path){
                unlink($thumbnail_path);
            }
        }
    }


    //delete user from db
    $delete_user_query = "DELETE FROM users WHERE id = $id";
    $delete_user_result = mysqli_query($connection, $delete_user_query);
    if(mysqli_errno($connection)){
        $_SESSION['delete-user'] = "could't '{$user['firstname']}' '{$user['lastname']}'";
    }else{
        $_SESSION['delete-user-success'] = "'{$user['firstname']}' '{$user['lastname']}' delete user successfully";
    }

}
header('location:' . ROOT_URL . 'admin/manage-users.php');
die();

?>