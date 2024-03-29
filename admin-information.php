<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/admin/session.php");
    $query = $conn->prepare("select name, surname, birthdate, gender, email, phone_number, profile_photo, password from admin where id=:id");
    $query->execute(array("id" => $_SESSION["admin_id"]));
    $result = $query->fetch(PDO::FETCH_ASSOC);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Admin Information</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <?php include_once("inc/admin/header.php") ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("inc/admin/sidebar.php") ?>

            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-5">
                <div class="content col-6 text-center" style="margin-left: 250px;">
                    <form action="" method="post">
                        <div class="form-group">
                            <label class="form-label" for="name">Name : </label>
                            <span><?php echo $result['name'] ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="surname">Surname : </label>
                            <span><?php echo $result['surname'] ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="birthdate">Birth Date : </label>
                            <span><?php echo $result['birthdate'] ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="gender">Gender : </label>
                            <span><?php echo $result['gender'] ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email : </label>
                            <span><?php echo $result['email'] ?></span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone_number">Phone Number : </label>
                            <span><?php echo $result['phone_number'] ?></span>
                        </div>
                        <div class="form-group mt-3">
                            <a href="update-admin" class="btn btn-md btn-round btn-primary">Update Information</a>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include_once("inc/dashboard_js.php") ?>

</body>
</html>