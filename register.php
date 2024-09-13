<?php include "inc/header.php"?>
<?php include "inc/navigation.php"?>
<?php include_once "class/DB.php"?>
<?php include_once "class/Notifications_cls.php"?>

<body>
<?php
$errorMsg = "";
$notifObj = new Notifications();
if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $passwordConfirm = $_POST["passwordConfirm"];
    if(empty($username) || empty($password) || empty($email) || empty($passwordConfirm)) {
        die("please fill out all fields");
    }
    if($password !== $passwordConfirm) {
        $errorMsg = "please enter same password";
    }
    $userObj = new User();
    $ops =["cost"=>11];
    $hash = password_hash($password, PASSWORD_BCRYPT,$ops);
    $exsitUser = $userObj->getUserByUsrename($username);
    if($exsitUser) {
        $errorMsg = "this username already used";
    }
    else {
        try {
            $userObj->registerUser($username, $hash, $email);
            $data['message'] = "$username Registered";
            $notifObj->sendNotifications( $data);
            }
        catch(Exception $e) { $errorMsg = "this email already used";}
    
    }
    if(!$errorMsg) {
        header("Location: index.php");
    }
}
?>
<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="container">
            <div class="row">
                <span class=" alert-danger"><?=$errorMsg?></span>
                <div class="col-md-6 m-auto">
                    <form action="" method="post" autocomplete="off">
                        <div class="form-group">
                            <label for="">User Name</label>
                            <input type="text" class="form-control" placeholder="User Name" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password Confirm</label>
                            <input type="password" class="form-control" placeholder="Password Confirm" name="passwordConfirm" required>
                        </div>
                        <input type="submit" value="Register" name="register" class="btn btn-success btn-lg">
                    </form>
                </div>
            </div>
        </div>

        <!-- Blog Entries Column -->


        <!-- Blog Sidebar -->
    </div>
  

</div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
<?php include "inc/footer.php"?>
