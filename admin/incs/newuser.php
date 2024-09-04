<?php
ob_start();
    if (isset($_POST["submitNewUser"]))
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $firstName = $_POST["firstname"];
        $lastName = $_POST["lastname"];
        $email = $_POST["email"];
        $role = $_POST["role"];
        $userObj = new User();
        $userObj->addUser($username, $password, $firstName, $lastName, $email,$role);
        $page = $_SERVER["PHP_SELF"];
        header("Location:$page");
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">User Name</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>
    <div class="form-group">
        <label for="password">Pasword</label>
        <input type="text" class="form-control" name="password" id="password">
    </div>

    <div class="form-group">
        <label for="firstname">First Name</label>
        <input type="text" class="form-control" name="firstname" id="firstname">
    </div>
    <div class="form-group">
        <label for="lastname">Last Name</label>
        <input type="text" class="form-control" name="lastname" id="lastname">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email">
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" class="form-control">
            <option value="subscriber">Subscriber</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <input type="submit" name="submitNewUser" id="submitNewUser" value="Add User" class="btn btn-lg btn-primary">
</form>