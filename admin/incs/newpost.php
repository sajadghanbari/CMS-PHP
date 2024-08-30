<?php
    if (isset($_POST["submitNewpost"]))
    {
        $title = $_POST["title"];
        $categoryId = $_POST["categoryId"];
        $author = $_POST["author"];
        $status = $_POST["status"];
        $imageName = $_FILES["image"]["name"];
        $imageTemp = $_FILES["image"]["tmp_name"];
        $tags = $_POST["tags"];
        $content = $_POST["content"];

        move_uploaded_file($imageTemp,"../image/$imageName");
        $postObj = new Post;
        $postObj-> addPost($title,$categoryId,$author,$status,$imageName, $tags,$content);

    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title">
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
                    echo "<option value='$catId'>$catName</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Author</label>
        <input type="text" class="form-control" name="author" id="author">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <input type="text" class="form-control" name="status" id="status">
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="tags">Tags</label>
        <input type="text" class="form-control" name="tags" id="tags">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" id="content" class="form-control" rows="10" cols="30"></textarea>
    </div>
    <input type="submit" name="submitNewpost" id="submitNewpost" value="Add Post" class="btn btn-lg btn-primary">
</form>
