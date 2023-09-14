<?php
require 'config/constants.php';
//destroy all session and redirect user to homepage page
session_destroy();
header('Location:' . ROOT_URL);
die();


?>