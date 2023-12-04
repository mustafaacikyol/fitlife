<?php include_once("inc/db_connect.php"); ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Fitlife - Admin Log In</title>
</head>
<body>
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="card admin-login-margin-top">
            <div class="card-body">
                <h2 class="text-center mb-4">Admin Log In</h2>
                <?php
                    if (isset($_POST["login_btn"])) {

                        $check = $conn->prepare("select id, name, surname, email, password from admin where email=:email and password=:password");
                        $check->execute(array("email" => $_POST["email"], "password" => md5($_POST["password"])));
                        $check_arr = $check->fetch(PDO::FETCH_ASSOC);
                        
                        if ($check_arr) {
                            $name_surname      = $check_arr["name"] . " " . $check_arr["surname"];
                            $id                = $check_arr["id"];
                            $_SESSION["admin"]  = $name_surname;
                            $_SESSION["admin_id"]    = $id;
                            header("location:admin-dashboard");
                        } else {
                            echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                            <em class='icon ni ni-cross-circle'></em> 
                            <strong>Email or password incorrect!</strong>
                        </div>";
                        }
                        
                    }
                ?>
                <form action="" method="POST">
                    <div class="form-group mb-3">
                        <label for="email">E-Mail:</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $_POST['email'] ?>" placeholder="Enter your e-mail">
                    </div>
                    <div class="form-group mb-4">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <div class="text-center mb-4">
                        <button class="btn btn-primary btn-block" type="submit" name="login_btn">Log In</button>
                    </div>
                    <div class="text-center">
                        <a href="admin-forgot-password" class="btn btn-dark btn-block">
                            Forgot Password
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>