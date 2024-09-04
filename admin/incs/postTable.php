<?php
    $postObj = new Post();
    if(isset($_GET["delete"]))
    {                         
        $id = $_GET["delete"];
        $postObj->deletePost($id);
    }
    $posts = $postObj->getAllPosts();
    $catObj = new Category();
    if(isset($_POST["bulkSubmit"]))
    {
        if(!isset($_POST["checks"]))
        {
            echo "no item selected";
        }
        else
        {
            switch($_POST['operationType']){
                case 'Published':
                    $postObj->changePostStatus($_POST['checks'], 'Published');
                    break;

                case 'Draft':
                    $postObj->changePostStatus($_POST['checks'], 'Draft');
                    break;
                
                case 'Delete':
                    $postObj->deleteBulkPost($_POST['checks']);
                    break;
            }
        }

    }
?>
<form action="" method="post">
    <div class="row">
        <div class="col-md-3">
            <select name="operationType" id="" class="form-control" required>
                <option value="" selected>Select Option</option>
                <option value="Delete">Delete</option>
                <option value="Published">Published</option>
                <option value="Draft">Draft</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="submit" name="bulkSubmit" value="Apply" class="btn btn-success">
            <a href="?type=newpost" class="btn btn-primary">Add new</a>
        </div>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Check</th>
                <th>Title</th>
                <th>Category</th>
                <th>Author</th>
                <th>Date</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Content</th>
                <th>Comment Count</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php
                                    foreach ($posts as $post) 
                                    {
                                        ?>
            <tr>
                <td><input type="checkbox" name="checks[]" value="<?=$post["id"]?>"></td>
                <td><?=$post["title"]?></td>
                <td><?php
                                $cat = $catObj->getcategory($post["category_id"]);
                                echo $cat[0]["name"]; 
                                ?>
                </td>
                <td><?=$post["author"]?></td>
                <td><?=$post["date"]?></td>
                <td><?=$post["status"]?></td>
                <td><?=$post["image"]?></td>
                <td><?=$post["tags"]?></td>
                <td><?=$post["content"]?></td>
                <td><?=$post["comment_count"]?></td>
                <td><a href="?delete=<?=$post["id"]?>" class="btn btn-danger">Delete</a></td>
                <td><a href="?type=editpost&pid=<?=$post["id"]?>" class="btn btn-warning">Edit</a></td>
            </tr>
            <?php
                                    }

                                    ?>
        </tbody>
    </table>
</form>