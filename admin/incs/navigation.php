<?php
// if(isset($_GET["Logout"]))
// {
//     unset($_SESSION["role"]);
//     unset($_SESSION["username"]);
//     header("Location: index.php");
// }
?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.php">Start Bootstrap</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>
    <!-- Navbar Search-->

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link " id="navbarDropdown" href="#"><?php
                $userOnlineObj = new OnlineUsers();
                echo "Online Users :". $userOnlineObj->getOnlineUsers();?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="navbarDropdown" href="/my projects/my_cms/index.php">Home page</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " id="navbarDropdown"
                href="/my projects/my_cms/admin/profile.php"><?=$_SESSION["firstName"]." ".$_SESSION["lastName"]?></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/my%20projects/my_cms/admin/profile.php">Profile</a></li>
                <a class="dropdown-item" href="?Logout=1">Logout</a>
                <!-- <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="">Logout</a></li> -->
            </ul>
        </li>
    </ul>
</nav>