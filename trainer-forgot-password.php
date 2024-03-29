<?php 
    include_once("inc/db_connect.php"); 
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Fitlife - Forgot Password</title>
</head>
<body>
    <div class="text-center success">
        <?php
            if(isset($_POST["reset_btn"])){

                $check = $conn->prepare("select email from trainer where email=:email");
                $check->execute(array("email" => $_POST["email"]));
                $result = $check->fetch(PDO::FETCH_ASSOC);

                if($result) {
                    if($_POST["password"] == $_POST["password2"]){
                        $update   = $conn->prepare("update trainer set password=:password where email=:email");
                        $result      = $update->execute(array("email" => $_POST["email"], "password" => md5($_POST["password"])));
    
                        if ($result) {
    
                            echo "<div class='alert alert-icon alert-success' role='alert'>
                                            <em class='icon ni ni-check-circle'></em> 
                                            <strong>Your password has been reset</strong> 
                                        </div>";
                            header("refresh:1;url=trainer-login");
                        } else {
                            echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                        <em class='icon ni ni-cross-circle'></em> 
                                        <strong>Password reset failed!</strong>
                                    </div>";
                        }
    
                    }else {
                        echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                        <em class='icon ni ni-cross-circle'></em> 
                        <strong>Password and password again must be the same!</strong>
                        </div>";
                    }
                }else {
                    echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                    <em class='icon ni ni-cross-circle'></em> 
                    <strong>This email does not exist in the system!</strong>
                    </div>";
                } 
            }
        ?>
    </div>
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center mb-4">Password Reset</h2>
                <form action="" method="POST">
                    <div class="form-group mb-3">
                        <label for="email">E-Mail:</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $_POST['email'] ?>" placeholder="Enter your e-mail">
                    </div>
                    <div class="form-group mb-4">
                        <label for="password">New Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <div class="form-group mb-4">
                        <label for="password2">New Password Again:</label>
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Enter your password">
                    </div>
                    <div class="text-center mb-4">
                        <button class="btn btn-primary btn-block" type="submit" name="reset_btn">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>