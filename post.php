<?php include "inc/header.php"?>
<?php include "inc/navigation.php"?>
<?php include_once "class/DB.php"?>
<?php
    if(isset($_GET["pid"]))
    {
        $postObj = new Post();
        $post = $postObj->getPost($_GET["pid"])[0];
        $postObj->incrementView($_GET["pid"]);
    }
    $commentObj = new Comment();
    if(isset($_POST["sendComment"]))
    {
        $author = $_POST["author"];
        $email = $_POST["email"];
        $content = $_POST["commentText"];
        $postId = $_GET["pid"];
        $commentObj->addComment( $author, $email, $content, $postId);
    }
$postComments = $commentObj->getPostComments($_GET["pid"]);
?>
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <h2>
                <a href="post.php?pid=<?=$post["id"]?>"><?=$post["title"]?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?=$post["author"]?></a>
            </p>
            <p><span class="fa fa-clock"></span> Posted on <?= $post["date"] ?></p>
            <img class="img-fluid" src="http://placehold.it/700x300" alt="">
            <hr>
            <p><?=$post["content"]?>.</p>
            <hr>






            <!-- First Blog Post -->


            <!-- Pager -->
            <div class="card bg-light">
                <div class="card-header">
                    <h4>Leave a comment</h4>
                </div>
                <div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="">Author:</label>
                                <input type="text" class="form-control" name="author" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Content</label>
                                <textarea class="form-control" name="commentText" required></textarea>
                                <span class="input-group-btn"></span>
                            </div>
                            <div class="form-group mt-3">
                                <input type="submit" class="btn btn-lg btn-primary" value="Send Comment"
                                    name="sendComment">
                            </div>

                        </form>
                    </div>
                </div>

            </div>
            <?php
            foreach($postComments as $comment)
            {
                ?>
            <div class="card">
                <div class="card-body">
                    <span class="font-weight-bolder p-3"><?=$comment["author"]?></span>
                </div>
                <span class="small"><?=$comment["date"]?></span><br>
                <span class=""><?=$comment["content"]?></span>
            </div>
            <?php
            }
        ?>
        </div>




        <!-- Blog Sidebar -->
        <?php include "inc/sidebar.php"?>


    </div>
    <!-- /.row -->



    <!-- Footer -->
    <?php include "inc/footer.php"?>