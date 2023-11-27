<?php 
    include_once("inc/db_connect.php");
    $query = $conn->prepare("select name, surname, birthdate, gender, email, phone_number, profile_photo, password from admin where id=:id");
    $query->execute(array("id" => $_SESSION["id"]));
    $result = $query->fetch(PDO::FETCH_ASSOC);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Change Admin Image</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <?php include_once("inc/admin/header.php") ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("inc/admin/sidebar.php") ?>

            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-5">
                <div class="content col-4 text-center" style="margin-left: 350px;">
                <?php 
                    if (isset($_POST["updateBtn"])) {
                        $image = $_FILES["image"];
                        $name = $image["name"];
                        $tmp_name = $image["tmp_name"];
                        $size = $image["size"];
                        $path = pathinfo($name);
                        $extension = strtolower($path["extension"]);
                        $image_name = $_SESSION["admin"] . "." . $extension;
                    }

                    if  ($name and isset($_POST["updateBtn"])) { 
                        if ($size>2000000) {
                            echo "<p class='text-center text-danger'>ERROR : The image you selected must be smaller than 2 MB!</p>";
                        } elseif ($extension!="jpg" and $extension!="png" and $extension!="gif" and $extension!="jpeg") {
                            echo "<p class='text-center text-danger'>ERROR : The extension of your selected image must be jpg, gif, png, jpeg!</p>";
                        } else {
                            $update = $conn -> prepare ("update admin set profile_photo=:profile_photo where id=:id");
                            $result = $update   -> execute ( array("profile_photo"=>$image_name, "id"=>$_SESSION["id"]) );

                            $upload   = move_uploaded_file($tmp_name, "assets/img/admin/$image_name");

                            if (isset($upload)) {
                                echo "<div class='alert alert-icon alert-success' role='alert'>
                                <em class='icon ni ni-check-circle'></em> 
                                <strong>Image updated.</strong> 
                                </div>";
                                header("refresh:1;admin-dashboard");
                            } else {
                                echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                <em class='icon ni ni-cross-circle'></em> 
                                <strong>Image could not be updated</strong>
                                </div>";
                            }
                        }
                    }    
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="form-label" for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-md btn-round btn-primary" name="updateBtn">Update</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>