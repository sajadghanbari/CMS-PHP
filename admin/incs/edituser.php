<?php
ob_start();
$error = "";
    $userObj = new User();
    if (isset($_GET["uid"]))
    {

        $user =$userObj->getUser($_GET["uid"]);
    }
    if(isset($_POST["submitEditUser"]))
    {
        $id = $_GET["uid"];
        $userName = $_POST["username"];
        $password = $_POST["password"];
        $firstName = $_POST["firstname"];
        $lastName = $_POST["lastname"];
        $email = $_POST["email"];
        $role = $_POST["role"];
        try {$userObj->updateUser($id,$userName,$password,$firstName,$lastName,$email,$role);}
        catch (Exception $e) {$error = "this name already used";}
        if(!$error){
        $page = $_SERVER["PHP_SELF"];
        header("Location: $page"); 
        }
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <span class="alert-danger"></span>
    <div class="form-group">
        <label for="username">User Name</label>
        <input type="text" class="form-control" name="username" value="<?=$user["username"]?>" id="username">
    </div>
    <div class="form-group">
        <label for="password">Pasword</label>
        <input type="text" class="form-control" name="password" value="<?=$user["password"]?>" id="password">
    </div>

    <div class="form-group">
        <label for="firstname">First Name</label>
        <input type="text" class="form-control" name="firstname" value="<?=$user["first_name"]?>" id="firstname">
    </div>
    <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" class="form-control" name="lastname" value="<?=$user["last_name"]?>" id="lastname">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" value="<?=$user["email"]?>" id="email">
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" class="form-control">
            <?php if($user["role"]=="admin")
            {?>
            <option value="admin" selected>Admin</option>
            <?php
            }
            else
            {
                ?>
                <option value="subscriber" selected>Subscriber</option>
            <?php
            }
            ?>
        </select>
    </div>
    <input type="submit" name="submitEditUser" id="submitEditUser" value="Update Profile" class="btn btn-lg btn-primary">
</form>