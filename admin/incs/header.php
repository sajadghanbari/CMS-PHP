<?php
include_once "../class/DB.php"; 
session_start();
$userObj = new User();
if (!isset($_SESSION["role"])|| !$userObj->isAdmin($_SESSION["username"])) {
    header("Location: ../");
}
if(isset($_GET["Logout"]))
{
    unset($_SESSION["role"]);
    unset($_SESSION["username"]);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - CMS Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="/my projects/my_cms/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="js/datatables.js"></script>

    </head>