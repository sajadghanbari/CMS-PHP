<?php include "incs/header.php" ?>
<?php include "incs/navigation.php" ?>
<?php
$catobj = new category();
$categories = $catobj->getallcategories();
if(isset($_GET["delete"])) 
{
    $delelteId = $_GET["delete"];
    $catobj->deletecategory($delelteId);
    $pagename = $_SERVER["PHP_SELF"];
    header("Location: $pagename");
}
if(isset($_POST["addCategorySubmit"]))
{
    $name = $_POST["name"];
    $description = $_POST["description"];
    if($name=="" || empty($name) )
    {
        $error = "please fill this filed";
        // return $error;
    } 
    else
    {
    $catobj->addcategory($name,$description);
    $pagename = $_SERVER["PHP_SELF"];
    header("Location: $pagename");
    }
  
}
if(isset($_GET['edit']))
{
    $id = $_GET['edit'];
    $selectedcategory = $catobj->getcategory($id);
    if(count($selectedcategory)> 0)
    {
    $selectedname = $selectedcategory[0]["name"];
    $selecteddescription = $selectedcategory[0]["description"];
    $selectedId = $selectedcategory[0]["id"];
    }
}  
if(isset($_POST["editCategorySubmit"]))
{
    $updateId = $_POST["editid"];
    $updateName = $_POST["name"];
    $updateDescription = $_POST["description"];
    if($updateName== ""|| empty($updateName) )
    {
        $error = "Enter name of category";

    }
    else
    {
        $catobj->updatecategory($updateId,$updateName,$updateDescription);
        $pagename = $_SERVER["PHP_SELF"];
        header("Location: $pagename");
    }

}
?>

<body class="sb-nav-fixed">

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">

            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">

                    <li class="nav">
                        <a href="#" class="nav-link">
                            <i class="fas fa-angle-down"></i>
                            <span>Dashboard</span>
                        </a>

                    </li>
                    <li class="nav">

                        <a href="#" class="nav-link dropdown-toggle" id="post-dropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-angle-down"></i>
                            <span>Posts</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="post-dropdown">
                            <a href="#" class="dropdown-item">View All Item</a>
                        </div>

                    </li>
                    <li class="nav">
                        <a href="#" class="nav-link">
                            <i class="fas fa-fw fa-category"></i>
                            <span>Categories</span>
                        </a>

                    </li>
                    <li class="nav">
                        <a href="#" class="nav-link">
                            <i class="fas fa-comment-alt"></i>
                            <span>Comments</span>
                        </a>

                    </li>
                    <li class="nav dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="user-dropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-alt"></i>
                            <span>Users</span>
                        </a>

                    </li>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Category</h1>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Admin</li>
                    </ol>
                    <?php
                    if(isset($error))
                    {
                        echo "<span class='alert alert-danger'>$error</span>";
                        unset($error);
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="nameInput">Name:</label>
                                    <input type="text" class="form-control" name="name" id="nameInput">
                                </div>
                                <div class="form-group">
                                    <label for="nameInput">Description</label>
                                    <input type="text" class="form-control" name="description" id="descriptionInput">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" name="addCategorySubmit" type="submit">Add
                                        Category</button>
                                </div>
                            </form>
                            <?php
                                 if(isset($_GET["edit"]))
                                 {
                                    ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="nameInput">Name:</label>
                                    <input type="text" class="form-control" value="<?php if(isset($selectedname)) {echo $selectedname;}?>" name="name" id="nameInput">
                                </div>
                                <input type="hidden" name="editid" value="<?php if(isset($selectedId)){echo $selectedId;}?>">
                                <div class="form-group">
                                    <label for="nameInput">Description</label>
                                    <input type="text" class="form-control" value="<?php if(isset($selecteddescription)){ echo $selecteddescription;}?>" name="description" id="descriptionInput">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-info" name="editCategorySubmit" type="submit">Update
                                        Category</button>
                                </div>
                            </form>
                            <?php
                                 }
                                 ?>
                        </div>
                        <div class="col-md-6">
                            <table id="categoryTable" class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                        foreach ($categories as $cat) 
                        {
                            echo "<tr>";
                            echo '<td>'.$cat["id"].'</td>';
                            echo '<td>'.$cat["name"].'</td>';
                            echo '<td>'.$cat["description"].'</td>';
                            echo '<td>'.'<a href="?delete='.$cat["id"].'" class="btn btn-danger">Delete</a>'.'</td>';
                            echo '<td>'.'<a href="?edit='.$cat["id"].'" class="btn btn-warning">Edit</a>'.'</td>';
                            echo "</tr>";
                        }
                        ?>
                                </tbody>
                            </table>

                        </div>
                    </div>



                </div>
            </main>

        </div>
    </div>
    <?php include "incs/footer.php" ?>
</body>

</html>