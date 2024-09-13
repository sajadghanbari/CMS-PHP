<?php include "incs/header.php";?>
<?php include "incs/navigation.php";
ob_start();
$userObj = new User();
if(isset($_SESSION['username']))
{
    $user = $userObj->getUserByUsrename($_SESSION['username']);
}
if(isset($_POST["submitEditUser"]))
{
    $id = $user["id"];
    $userName = $_POST["username"];
    $password = $_POST["password"];
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $userObj->updateUser($id,$userName,$password,$firstName,$lastName,$email,$role);
    $page = $_SERVER["PHP_SELF"];
    header("Location: $page"); 
}
?>

<body class="sb-nav-fixed">

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <li class="nav">
                        <a href="#" class="nav-link">
                            <i class="fas fa-angle-down"></i>
                            <span>User Profile</span>
                        </a>

                    </li>
                    <li class="nav">

                        <a href="#" class="nav-link dropdown-toggle" id="post-dropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-angle-down"></i>
                            <span>Posts</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="post-dropdown">
                            <a href="post.php" class="dropdown-item">View All Post</a>
                            <a href="post.php?type=newpost" class="dropdown-item">Add Post</a>
                        </div>

                    </li>
                    <li class="nav">
                        <a href="/my projects/my_cms/admin/category.php" class="nav-link">
                            <i class="fas fa-fw fa-category"></i>
                            <span>Categories</span>
                        </a>

                    </li>
                    <li class="nav">
                        <a href="#" class="nav-link">
                            <i class="fas fa-comment-alt"></i>
                            <span>Comments</span>
                        </a>

                    </li>
                    <li class="nav dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="user-dropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-alt"></i>
                            <span>Users</span>
                        </a>
                    </li>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Post</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Admin</li>
                    </ol>
                    <div class="row">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="username">User Name</label>
                                <input type="text" class="form-control" name="username" value="<?=$user["username"]?>"
                                    id="username">
                            </div>
                            <div class="form-group">
                                <label for="password">Pasword</label>
                                <input type="text" class="form-control" name="password" required
                                    id="password">
                            </div>

                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control" name="firstname"
                                    value="<?=$user["first_name"]?>" id="firstname">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" name="lastname" value="<?=$user["last_name"]?>"
                                    id="lastname">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="<?=$user["email"]?>"
                                    id="email">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" class="form-control">
                                    <?php if($user["role"]=="admin")
            {?>
                                    <option value="admin" selected>Admin</option>
                                    <?php
            }
            else
            {
                ?>
                                    <option value="subscriber" selected>Subscriber</option>
                                    <?php
            }
            ?>
                                </select>
                            </div>
                            <input type="submit" name="submitEditUser" id="submitEditUser" value="Update User"
                                class="btn btn-lg btn-primary">
                        </form>
                    </div>

                </div>

            </main>
        </div>
    </div>
    <?php include "incs/footer.php";?>
</body>

</html>