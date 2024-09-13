<?php
$postObj = new Post();
    if(isset($_GET["pid"]))
    {   
        $id = $_GET["pid"];
        $currentPost = $postObj->getPost($id);
    }
    if(isset($_POST["submitEditpost"]))
    {

            
        $postObj->updatePost($_POST["id"],$_POST["title"],$_POST["categoryId"],$_POST["status"],$_FILES["image"]["name"],$_POST["tags"],$_POST["content"]);
        $pagename = $_SERVER["PHP_SELF"];
        header("Location: $pagename");
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="<?=$currentPost[0]["title"]?>">
    </div>
    <div class="form-group">
        <label for="categoryId">Category id</label>
        <select name="categoryId" class="form-control">
            <?php
                
                $catobj = new Category;
                $cats = $catobj->getallcategories();
                foreach ($cats as $cat) 
                {
                    $catId = $cat["id"];
                    $catName = $cat["name"];
                    if($currentPost[0]["category_id"] == $catId)
                    {
                        echo "<option value='$catId' selected>$catName</option>";
                    }
                    else echo "<option value='$catId'>$catName</option>";
                }
            ?>
        </select>
    </div>
    <!-- <div class="form-group">
        <label for="author">Author</label>
        <input type="text" class="form-control" name="author" id="author" value="<?=$currentPost[0]["author"]?>">
    </div> -->
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
            <?php
            if($currentPost[0]["status"]=="Draft"){
                ?>
            <option value="Draft" selected>Draft</option>
            <option value="Published">Published</option>
            <?php
            }
            else{
                ?>
            <option value="Draft">Draft</option>
            <option value="Published" selected>Published</option>
            <?php
            }
            
            ?>
        </select>
    </div>
    <img src="../image/<?=$currentPost[0]['image']?>" width="150">
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="tags">Tags</label>
        <input type="text" class="form-control" name="tags" id="tags" value="<?=$currentPost[0]["tags"]?>">
    </div>
    <input type="hidden" name="id" value="<?=$currentPost[0]["id"]?>">
    <input type="hidden" name="lastImage" value="<?=$currentPost[0]["image"]?>">
    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" id="editor" class="form-control" rows="10"
            cols="30"><?=$currentPost[0]["content"]?></textarea>
    </div>
    <input type="submit" name="submitEditpost" id="submitEditpost" value="Add Post" class="btn btn-lg btn-primary">
</form>

