<?php 
    include_once("inc/db_connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Generate Client</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <?php include_once("inc/admin/header.php") ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("inc/admin/sidebar.php") ?>
           
            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="content col-4 text-center" style="margin-left: 350px;">
                <?php
                    if(isset($_POST["generateBtn"])){
                        $image = $_FILES["image"];
                        $name = $image["name"];
                        $tmp_name = $image["tmp_name"];
                        $size = $image["size"];
                        $path = pathinfo($name);
                        $extension = strtolower($path["extension"]);
                        $image_name = $_POST["name"] . "." . $extension;

                        if ($_POST["password"] !== $_POST["password_again"]) {
                            echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                        <em class='icon ni ni-cross-circle'></em> 
                                        <strong>Password and Password Again must be the same!</strong>
                                    </div>"; 
                        }else {
                            if ($name) {
                                if  ($name and isset($_POST["generateBtn"])) { 
                                    if ($size>2000000) {
                                        echo "<p class='text-center text-danger'>ERROR : The image you selected must be smaller than 2 MB!</p>";
                                    } elseif ($extension!="jpg" and $extension!="png" and $extension!="gif" and $extension!="jpeg") {
                                        echo "<p class='text-center text-danger'>ERROR : The extension of your selected image must be jpg, gif, png, jpeg!</p>";
                                    } else {
                                        $generate = $conn->prepare("insert into client set name=:name, surname=:surname, birthdate=:birthdate, gender=:gender, email=:email, phone_number=:phone_number, password=:password, profile_photo=:profile_photo");
                                        $generate_result = $generate->execute(array("name" => $_POST["name"], "surname" => $_POST["surname"], "birthdate" => $_POST["birthdate"], "gender" => $_POST["gender"], "email" => $_POST["email"], "phone_number" => $_POST["phone_number"], "password" => md5($_POST["password"]), "profile_photo" => $image_name));
            
                                        $upload   = move_uploaded_file($tmp_name, "assets/img/client/$image_name");
            
                                        if (isset($upload)) {
                                            echo "<div class='alert alert-icon alert-success' role='alert'>
                                            <em class='icon ni ni-check-circle'></em> 
                                            <strong>User added successfully</strong> 
                                            </div>";
                                            header("refresh:1;clients");
                                        } else {
                                            echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                            <em class='icon ni ni-cross-circle'></em> 
                                            <strong>User Failed to Add!</strong>
                                            </div>";
                                        }
                                    }
                                }    
                            }elseif ($_POST["name"] and $_POST["surname"] and $_POST["birthdate"] and $_POST["gender"] and $_POST["email"] and $_POST["phone_number"] and $_POST["password"] and $_POST["password_again"]) {
                                $generate = $conn->prepare("insert into client set name=:name, surname=:surname, birthdate=:birthdate, gender=:gender, email=:email, phone_number=:phone_number, password=:password");
                                $generate_result = $generate->execute(array("name" => $_POST["name"], "surname" => $_POST["surname"], "birthdate" => $_POST["birthdate"], "gender" => $_POST["gender"], "email" => $_POST["email"], "phone_number" => $_POST["phone_number"], "password" => md5($_POST["password"])));
    
                                if ($generate_result) {
                                    echo "<div class='alert alert-icon alert-success' role='alert'>
                                                <em class='icon ni ni-check-circle'></em> 
                                                <strong>User added successfully</strong>. 
                                            </div>";
                                    header("refresh:1;url=clients");
                                } else {
                                    echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                                <em class='icon ni ni-cross-circle'></em> 
                                                <strong>User Failed to Add!</strong>
                                            </div>";
                                }
                            }
                        }
                    }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $_POST['name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="surname">Surname</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $_POST['surname'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="birthdate">Birth Date</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="birthdate" name="birthdate" value="<?php echo $_POST['birthdate'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="gender">Gender</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $_POST['gender'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $_POST['email'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone_number">Phone Number</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $_POST['phone_number'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <span class="text-danger">*</span>
                            <input type="password" class="form-control" name="password" value="<?php echo $_POST["password"] ?>" id="password" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password_again">Password Again</label>
                            <span class="text-danger">*</span>
                            <input type="password" class="form-control" name="password_again" value="<?php echo $_POST["password_again"] ?>" id="password_again" required>
                        </div>
                        <div class="form-group mt-3 mb-5">
                            <button type="submit" class="btn btn-md btn-round btn-primary" name="generateBtn">Generate</button>
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