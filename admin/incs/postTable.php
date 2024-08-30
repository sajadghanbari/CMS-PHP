                    <?php
                        $postObj = new Post();
                        if(isset($_GET["delete"]))
                        {   
                            
                            $id = $_GET["delete"];
                            $postObj->deletePost($id);
                            
                            
    
                        }
                        $posts = $postObj->getAllPosts();
                    ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category Id</th>
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
                                <td><?=$post["title"]?></td>
                                <td><?=$post["category_id"]?></td>
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
