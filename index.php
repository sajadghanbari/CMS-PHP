<?php include "inc/header.php"?>
<?php include "inc/navigation.php"?>
<?php include_once "class/DB.php"?>
<body>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <h2>
                <a href="#">Blog Post Title</a>
            </h2>
            <p class="lead">
                by <a href="index.php">Start Bootstrap</a>
            </p>
            <p><span class="fa fa-clock"></span> Posted on August 28, 2013 at 10:00 PM</p>
            <hr>
            <img class="img-fluid" src="http://placehold.it/700x300" alt="">
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus
                inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum
                officiis rerum.</p>
            <a class="btn btn-primary" href="#">Read More <span class="fa fa-angle-right"></span></a>

            <hr>

            <!-- Pager -->
            <ul class="">
                <li class="btn  btn-outline-primary">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="btn float-md-right btn-outline-primary">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <!-- Blog Sidebar -->
    <?php include "inc/sidebar.php"?>
  

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
<?php include "inc/footer.php"?>
