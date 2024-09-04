<?php
    $commentObj = new Comment();
    if(isset($_GET["delete"]))
    {                         
        $id = $_GET["delete"];
        $commentObj->deleteComment($id);
    }
    $comments = $commentObj->getAllComments();
    if(isset($_GET["approveid"]))
    {
        $id = $_GET["approveid"];
        $commentObj->changeStatus($id);
        $pagename = $_SERVER["PHP_SELF"];
        header("Location:$pagename");
    }
    // $catObj = new Category();
?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Email</th>
                                <th>Content</th>
                                <th>Delete</th>
                                <th>Approve</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    foreach ($comments as $comment) 
                                    {
                                        ?>
                            <tr>
                                <td><?= $comment["id"]?></td>
                                <td><a href="../post.php?pid=<?= $comment["post_id"]?>"><?= $comment["post_title"]?></a></td>
                                <td><?=$comment["author"]?></td>
                                <td><?=$comment["date"]?></td>
                                <td><?= $comment["status"]==1?"Aprrove":"Unapprove"?></td>
                                <td><?=$comment["email"]?></td>
                                <td><?=$comment["content"]?></td>
                                <!-- <td><?=$comment["comment_count"]?></td> -->
                                <td><a href="?delete=<?=$comment["id"]?>" class="btn btn-danger">Delete</a></td>
                                <td>
                                    <?php
                                    if($comment["status"] == 1)
                                    {
                                        ?>
                                        <a href="?approveid=<?=$comment["id"]?>" class="btn btn-warning">Unapprove</a>
                                        <?php
                                    }
                                    else
                                    {   ?>
                                        <a href="?approveid=<?=$comment["id"]?>" class="btn btn-primary">Approve</a>
                                        <?php
                                    }

                                    ?>
                                </td>
                            </tr>
                            <?php
                                    }

                                    ?>
                        </tbody>
                    </table>
