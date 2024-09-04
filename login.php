<?php
session_start();
include("class/DB.php");

if(isset($_POST["loginSubmit"]))
{   
    $username = $_POST["username"];
    $password = $_POST["password"];
    $userObj = new User();
    $user = $userObj->getUserByUsrename($username);
    if(count($user) > 0 && $user["username"]===$username && $user["password"]===$password)
    {
    $_SESSION["username"] = $username;
    $_SESSION["role"] = $user["role"];
    $_SESSION["firstName"] = $user["first_name"];
    $_SESSION["lastName"] = $user["last_name"];
    header("Location: admin");
    }
    else
    {
        header("Location: index.php");
    }
}
?>