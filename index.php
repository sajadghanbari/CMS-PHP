<?php include "inc/header.php"?>
<?php include "inc/navigation.php"?>
<?php include_once "class/DB.php"?>
<body>
<?php
$postobj = new Post();
if(isset($_GET["catid"]))
{
    $posts = $postobj->getPosts($_GET["catid"]);

}
else{
    $posts = $postobj->getAllPosts();
}

?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            foreach ($posts as $post) {
            ?>
            <h2>
                <a href="post.php?pid=<?=$post["id"]?>"><?=$post["title"]?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?=$post["author"]?></a>
            </p>
            <p><span class="fa fa-clock"></span> Posted on <?= $post["date"] ?></p>   
            <img class="img-fluid" src="http://placehold.it/700x300" alt="">
            <hr>
            <p><?=substr($post["content"],0,100)?>.</p>
            <a class="btn btn-primary" href="post.php?pid=<?=$post["id"]?>">Read More <span class="fa fa-angle-right"></span></a>
            <hr>         
            <?php
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
