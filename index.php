<?php include "inc/header.php"?>
<?php include "inc/navigation.php"?>
<?php include_once "class/DB.php"?>
<body>
<?php
$postobj = new Post();
$pageLength = 5;
$postCount = $postobj->getAllPostCount();
$pageCount = ceil($postCount/$pageLength);
if(isset($_GET["catid"]))
{
    $posts = $postobj->getPosts($_GET["catid"]); //برای دسته بندی ها هم باید pagination انجام بشه

}
elseif(isset($_GET["author"]))
{
    $author = $_GET["author"];
    $posts = $postobj->getPostByAuthor($author);
}
else{

    $posts = $postobj->getAllPosts();
    $page = 1;
    if(isset($_GET["page"]))
    {
        $page = $_GET["page"];
    }
   $postobj->getAllPostsByPage($pageLength,$page);
}

?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            if(count($posts) < 1)
            {
                echo "<h2>No Post Available </h2>";
            }
            foreach ($posts as $post) {
            ?>
            <h2>
                <a href="post.php?pid=<?=$post["id"]?>"><?=$post["title"]?></a>
            </h2>
            <p class="lead">
                by <a href="?author=<?=$post["author"]?>"><?=$post["author"]?></a>
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
            <nav>
        <ul class="pagination">
            <?php
            for ($i = 1; $i <=$pageCount; $i++)
            {
                ?>
                <li class="page-item <?php if($i==$page) echo"active" ?> "><a href="?page=<?=$i?>" class="page-link "><?=$i?></a></li>
                <?php
            }
            ?>
        </ul>
    </nav>

        </div>

        <!-- Blog Sidebar -->
    <?php include "inc/sidebar.php"?>
  

    </div>
    <!-- /.row -->



    <!-- Footer -->
<?php include "inc/footer.php"?>
