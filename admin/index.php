<?php include "incs/header.php" ?>
<?php include "incs/navigation.php" ?>
<?php
$reportObj = new Report();
?>

<body class="sb-nav-fixed">

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <li class="nav">
                        <a href="#" class="nav-link">
                            <i class="fas fa-angle-down"></i>
                            <span>Dashboard</span>
                        </a>

                    </li>
                    <li class="nav">

                        <a href="#" class="nav-link dropdown-toggle" id="post-dropdown" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-angle-down"></i>
                            <span>Posts</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="post-dropdown">
                            <a href="/my projects/my_cms/admin/post.php" class="dropdown-item">View All Post</a>
                            <a href="/my%20projects/my_cms/admin/post.php?type=newpost" class="dropdown-item">Add Post</a>
                        </div>
                        

                    </li>
                    <li class="nav">
                        <a href="/my projects/my_cms/admin/category.php" class="nav-link">
                            <i class="fas fa-fw fa-category"></i>
                            <span>Categories</span>
                        </a>

                    </li>
                    <li class="nav">
                        <a href="/my%20projects/my_cms/admin/comment.php" class="nav-link">
                            <i class="fas fa-comment-alt"></i>
                            <span>Comments</span>
                        </a>

                    </li>
                    <li class="nav dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="user-dropdown" role="button" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-alt"></i>
                            <span>Users</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="post-dropdown">
                            <a href="/my%20projects/my_cms/admin/user.php" class="dropdown-item">View All Users</a>
                            <a href="/my%20projects/my_cms/admin/user.php?type=newuser" class="dropdown-item">Add Users</a>
                        </div>

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
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><?= $_SESSION["username"] ?></li>
                    </ol>



                </div>
                <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card bg-primary text-white">
                        <div class="card-heading">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3">
                                        <i class="fa fa-file fa-5x" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class='text-end'><?=$reportObj->getPostCount()?></div>
                                        <div class="text-end">Posts</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="post.php">
                            <div class="card-footer text-dark">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card bg-success">
                        <div class="card-heading">
                            <div class="container">
                                <div class="row text-white">
                                    <div class="col-md-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class="text-end"><?=$reportObj->getCommentCount()?></div>
                                        <div class="text-end">Comments</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="comment.php">
                            <div class="card-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card bg-warning text-white">
                        <div class="card-heading">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class='text-end'><?=$reportObj->getUserCount()?></div>
                                        <div class="text-end"> Users</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="user.php">
                            <div class="card-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card bg-danger text-white text-sm-start">
                        <div class="card-heading">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-md-9 text-sm-start">
                                        <div class=" text-end"><?=$reportObj->getCategoryCount()?></div>
                                        <div class="text-end">Categories</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="category.php">
                            <div class="card-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            </main>

        </div>

    </div>
    
    
    <?php include "incs/footer.php" ?>
</body>

</html>