<?php include "inc/header.php"?>
<?php include "inc/navigation.php"?>
<?php include_once "class/DB.php"?>
<?php include_once "class/Email_cls.php"?>

<?php
$errorMsg = "";
if (isset($_POST["reset"])) {
    $password = $_POST["password"];
    $passwordConfirm = $_POST["confirmPassword"];
    if(empty($password) || empty($passwordConfirm)) {
        die("please fill out all fields");
    }
    if($password !== $passwordConfirm) {
        $errorMsg = "please enter same password";
    }
    $userObj = new User();
    $uid = $_GET["uid"];
    $token = $_GET["token"];
    $user = $userObj->getUser($uid);
    if($user["token"]===$token)
    {
        $userObj->updateUser($user["id"],$user["username"],$password,$user["first_name"],$user["last_name"],$user["email"],$user["role"]);
        header("Location: index.php");
    }
    else
    {
        echo"Token invaild";
    }

}
?>
<div class="container">

    <div class="row">
        <div class="container">
            <div class="row">
                <!-- <span class=" alert-danger"><?=$errorMsg?></span> -->
                <div class="col-md-6 m-auto">
                    <form action="" method="post" autocomplete="off">

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" placeholder="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" placeholder="confirm password" name="confirmPassword" required>
                        </div>
                        <input type="submit" value="Send password" name="reset" class="btn btn-success btn-lg">
                    </form>
                </div>
            </div>
        </div>

        <!-- Blog Entries Column -->


        <!-- Blog Sidebar -->
    <!-- </div> -->

</div>
<div>
<?php include "inc/footer.php"?>

</div>
