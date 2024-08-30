<?php include "inc/header.php"?>
<?php include "inc/navigation.php"?>
<?php include_once "class/DB.php"?>

<body>
    <?php
$postobj = new Post();
// $posts = $postobj->getAllPosts();
if(isset($_POST["searchSubmit"]))
{
    $posts = $postobj->searchPost($_POST['searchQuery']);
}
?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <?php
            if(count($posts) > 0)
            {
            foreach($posts as $post) 
            {
            ?>
                <h2>
                    <a href="#"><?=$post["title"]?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?=$post["author"]?></a>
                </p>
                <p><span class="fa fa-clock"></span> Posted on <?= $post["date"] ?></p>
                <img class="img-fluid" src="http://placehold.it/700x300" alt="">
                <hr>
                <p><?=$post["content"]?>.</p>
                <a class="btn btn-primary" href="#">Read More <span class="fa fa-angle-right"></span></a>
                <hr>
                <?php
                 }
            }
            else{
                echo "no result";
            }
            ?>
                <hr>





                <!-- First Blog Post -->


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