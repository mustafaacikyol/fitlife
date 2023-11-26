<?php include_once("inc/db_connect.php"); ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Fitlife - Client Log In</title>
</head>
<body>
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="card admin-login-margin-top">
            <div class="card-body">
                <h2 class="text-center mb-4">Client Log In</h2>
                <form>
                    <div class="form-group mb-3">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter your username">
                    </div>
                    <div class="form-group mb-4">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter your password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block">Log In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>