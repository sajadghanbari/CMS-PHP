<?php include "incs/header.php" ?>
<?php include "incs/navigation.php" ?>

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
                            <a href="post.php" class="dropdown-item">View All Post</a>
                            <a href="#" class="dropdown-item">Add Post</a>
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
                        <a href="#" class="nav-link dropdown-toggle" id="user-dropdown" role="button" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
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
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Admin</li>
                    </ol>



                </div>
            </main>

        </div>
    </div>
    <?php include "incs/footer.php" ?>
</body>

</html>