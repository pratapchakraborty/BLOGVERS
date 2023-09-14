<?php
require 'config/database.php';

//get form data if submit button was clicked

if(isset($_POST['submit'])){
    // var_dump($_POST);exit;
    $firstname = filter_var($_POST['firstName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $createPassword = filter_var($_POST['createPassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmPassword = filter_var($_POST['confirmPassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];

    //validate input values
    if(!$firstname){
        $_SESSION['add-user'] = "Please enter your First Name";
    }elseif(!$lastname){
        $_SESSION['add-user'] = "Please enter your Last Name";
    }elseif(!$username){
        $_SESSION['add-user'] = "Please enter your Username";
    }elseif(!$email){
        $_SESSION['add-user'] = "Please enter a valid email";
    }elseif(strlen($createPassword) > 8 || strlen($confirmPassword) > 8){
        $_SESSION['add-user'] = "Password should be more than 8 characters";
    }elseif(!$avatar['name']){
        $_SESSION['add-user'] = "Please add avatar";
    }else{
        //check if password don't match
        if($createPassword != $confirmPassword){
            $_SESSION['add-user'] = "Password do not match!";
        }else{
            //hash password
            $hashed_password = password_hash($createPassword, PASSWORD_DEFAULT);
            
            //check if username or email is already exist in the database
            $user_check_quary = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connection,$user_check_quary);
            if(mysqli_num_rows($user_check_result) > 0){
                $_SESSION['add-user'] = "Username or email already exists";
            }else{
                //work on avatar
                //rename avatar
                $time = time(); // make each image name unique useing current timestamp
                $avatar_name = $time . $avatar['name'];
                $avatar_temp_name = $avatar['tmp_name'];
                $avatar_destination_path = '../images/' . $avatar_name;

                //make sure file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.',$avatar_name);
                $extension = end($extension);
                if(in_array($extension,$allowed_files)){
                    //make sure image is not to large (1mb+)
                    if($avater['size'] < 1000000){
                        //upload avatar
                        move_uploaded_file($avatar_temp_name, $avatar_destination_path);
                    }else{
                        $_SESSION['add-user'] = "File size too big, should be less than 1mb";
                    }
                }else{
                    $_SESSION['add-user'] = "File should be png, jpg, jpeg";
                }
            }
        }
    }
    //redirect back to signup page if there was any problem
    if(isset($_SESSION['add-user'])){
        // pass form data back to signup page
        $_SESSION['add-user-data'] = $_POST;
        header('location:' . ROOT_URL . 'admin/add-user.php');
        die();
    }else{
        //insert new user into signup page
        $insert_user_query = "INSERT INTO `users`(`firstname`, `lastname`, `username`, `email`, `password`, `avatar`, `is_admin`) VALUES ('$firstname','$lastname','$username','$email','$hashed_password','$avatar_name',$is_admin)";

        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if(!mysqli_errno($connection)){
            //redirect back to login page with success message

            $_SESSION['add-user-success'] = "New user " . $firstname . " " . $lastname . " added successfully";
            header('location:' . ROOT_URL . 'admin/manage-users.php');
            die();
        }
    }
}else{
    //if button wasn't clicked, bounce back to signup page
    header('location:'. ROOT_URL . 'admin/add-user.php');
    die();
}

?>