<?php 
    include_once("inc/db_connect.php");
    include_once("inc/trainer/session.php");
    $query = $conn->prepare("select t.name, t.surname, t.birthdate, t.gender, t.email, t.phone_number, t.profile_photo, t.password, e.profession from trainer as t inner join trainer_expertise as te on t.id=te.trainer_id inner join expertise as e on te.expertise_id=e.id where t.id=:id");
    $query->execute(array("id" => $_SESSION["id"]));
    $result = $query->fetch(PDO::FETCH_ASSOC);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Update Trainer Info</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <?php include_once("inc/trainer/header.php") ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("inc/trainer/sidebar.php") ?>
           
            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="content col-6 text-center" style="margin-left: 250px;">
                    <?php
                        if (isset($_POST["updateBtn"])) {

                            if ($_POST["password"] == "" and $_POST["password_again"] == "") {

                                $update = $conn->prepare("update trainer as t inner join trainer_expertise as te on t.id=te.trainer_id set t.name=:name, t.surname=:surname, t.birthdate=:birthdate, t.gender=:gender, t.email=:email, t.phone_number=:phone_number, te.expertise_id = :expertise_id where t.id=:id");
                                $update_result = $update->execute(array("id" => $_SESSION["id"], "name" => $_POST["name"], "surname" => $_POST["surname"], "birthdate" => $_POST["birthdate"], "gender" => $_POST["gender"], "email" => $_POST["email"], "phone_number" => $_POST["phone_number"], "expertise_id"=>$_POST["expertise"]));

                                if ($update_result) {
                                    $name_surname      = $_POST["name"] . " " . $_POST["surname"];
                                    $_SESSION["trainer"] = $name_surname;
                                    echo "<div class='alert alert-icon alert-success' role='alert'>
                                                <em class='icon ni ni-check-circle'></em> 
                                                <strong>Your information updated.</strong>
                                            </div>";
                                    header("location:trainer-information");
                                }
                            } elseif ($_POST["password"] !== "" and $_POST["password_again"] !== "") {

                                if ($_POST["password"] !== $_POST["password_again"]) {
                                    echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                            <em class='icon ni ni-cross-circle'></em> 
                                            <strong>Password and Password Again must be the same!</strong>
                                        </div>";
                                } else {
                                    $update = $conn->prepare("update trainer as t inner join trainer_expertise as te on t.id=te.trainer_id set t.name=:name, t.surname=:surname, t.birthdate=:birthdate, t.gender=:gender, t.email=:email, t.phone_number=:phone_number, t.password=:password, te.expertise_id = :expertise_id where t.id=:id");
                                    $update->execute(array("id" => $_SESSION["id"], "name" => $_POST["name"], "surname" => $_POST["surname"], "birthdate" => $_POST["birthdate"], "gender" => $_POST["gender"], "email" => $_POST["email"], "phone_number" => $_POST["phone_number"], "password" => md5($_POST["password"]), "expertise_id"=>$_POST["expertise"]));
                                    $name_surname      = $_POST["name"] . " " . $_POST["surname"];
                                    $_SESSION["trainer"] = $name_surname;
                                    echo "<div class='alert alert-icon alert-success' role='alert'>
                                                <em class='icon ni ni-check-circle'></em> 
                                                <strong>Your information updated.</strong>
                                            </div>";
                                    header("location:trainer-information");
                                }
                            } else {
                                echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                            <em class='icon ni ni-cross-circle'></em> 
                                            <strong>Your information cannot be updated!</strong> 
                                        </div>";
                            }
                        }

                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $result['name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="surname">Surname</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $result['surname'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="expertise">Expertise</label>
                            <span class="text-danger">*</span>
                            <select id="expertise" name="expertise" class="form-control" required>
                                <option value="">Select Expertise</option>
                                <?php
                                    $expertise = $conn -> prepare("select * from expertise order by id asc");
                                    $expertise -> execute();

                                    while ($expertise_result = $expertise->fetch(PDO::FETCH_ASSOC)) {

                                        $id = $expertise_result["id"];
                                        $name = $expertise_result["profession"];
                                        if ($result["profession"] == $expertise_result["profession"]) {
                                            $select = 'selected=""';
                                        } else {
                                            $select  = '';
                                        }

                                        echo "<option value='$id' $select>$name</option>";
                                    }

                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="birthdate">Birth Date</label>
                            <span class="text-danger">*</span>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo $result['birthdate'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="gender">Gender</label>
                            <span class="text-danger">*</span>
                            <select id="gender" name="gender" class="form-control" required>
                                <option value="">Select Gender</option>
                                <option value="Female" <?php if($result['gender'] == "Female"){echo 'selected=""';} ?>>Female</option>
                                <option value="Male" <?php if($result['gender'] == "Male"){echo 'selected=""';} ?>>Male</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $result['email'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="phone_number">Phone Number</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $result['phone_number'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" class="form-control" name="password" value="<?php echo $_POST["password"] ?>" id="password">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password_again">Password Again</label>
                            <input type="password" class="form-control" name="password_again" value="<?php echo $_POST["password_again"] ?>" id="password_again">
                        </div>
                        <div class="form-group mt-3 mb-3">
                            <button type="submit" class="btn btn-md btn-round btn-primary" name="updateBtn">Update</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include_once("inc/dashboard_js.php") ?>

</body>
</html>