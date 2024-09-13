<?php include "inc/header.php"?>
<?php include "inc/navigation.php"?>
<?php include_once "class/DB.php"?>
<?php include_once "class/Email_cls.php"?>
<?php
$errorMsg ='';
$token ='';
$userObj = new User();
$emailObj = new Email();
if(isset($_POST["sendMail"]))
{
    $email = $_POST["email"];
    $user = $userObj->getUserByEmail($email);
    if($userObj->getUserByEmail($email))
    {
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        $userObj->updateToken($user["id"], $token);
        $uid = $user["id"];
        $text = "your reset link is: <a href='http://localhost:3000/my%20projects/my_cms/reset.php?token=$token&uid=$uid'>Click Here</a>";
        if($emailObj->sendEmail("reset password",$text, $email))
        {
            header("Location: index.php");
        }
        else
        {
            $errorMsg .= "email send faild";
        }
    }
    else
    {
        $errorMsg = "Error";
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
                            <label for="email">Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <input type="submit" value="Send Email" name="sendMail" class="btn btn-success btn-lg">
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
