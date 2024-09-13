<?php
session_start();
include("class/DB.php");

if(isset($_POST["loginSubmit"]))
{   
    $username = $_POST["username"];
    $password = $_POST["password"];
    $userObj = new User();
    $user = $userObj->getUserByUsrename($username);
    if(count($user) > 0 && ($user["username"] === $username && password_verify($password,$user["password"])))
    {
    $_SESSION["username"] = $username;
    $_SESSION["role"] = $user["role"];
    $_SESSION["firstName"] = $user["first_name"];
    $_SESSION["lastName"] = $user["last_name"];
    $_SESSION["id"] = $user["id"];
    header("Location: admin");
    }
    else
    {
    header("Location: index.php");
    }
}
// if(isset($_GET["Logout"]))
// {
//     unset($_SESSION["role"]);
//     unset($_SESSION["username"]);
//     header("Location: index.php");
// }
?>