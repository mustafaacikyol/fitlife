<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/client/session.php");
    $query = $conn->prepare("select p.id, p.weight, p.tall, p.body_mass_index, p.muscle_mass, p.body_fat_ratio from progress as p inner join client_progress as cp on p.id=cp.progress_id where p.id=:id");
    $query->execute(array("id" => $_GET["id"]));
    $result = $query->fetch(PDO::FETCH_ASSOC);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Update Progress</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <?php include_once("inc/client/header.php") ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("inc/client/sidebar.php") ?>
           
            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="content col-6 text-center" style="margin-left: 250px;">
                    <?php
                        if (isset($_POST["updateBtn"])) {
                            $update = $conn->prepare("update progress set weight=:weight, tall=:tall, body_mass_index=:body_mass_index, muscle_mass=:muscle_mass, body_fat_ratio=:body_fat_ratio where id=:id");
                            $update_result = $update->execute(array("id" => $_GET["id"], "weight" => $_POST["weight"], "tall" => $_POST["tall"], "body_mass_index" => $_POST["body_mass_index"], "muscle_mass" => $_POST["muscle_mass"], "body_fat_ratio" => $_POST["body_fat_ratio"]));
                            if ($update_result) {
                                echo "<div class='alert alert-icon alert-success' role='alert'>
                                            <em class='icon ni ni-check-circle'></em> 
                                            <strong>Progress updated.</strong>. 
                                        </div>";
                                header("location:client-display-progress");
                            }else {
                                echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                            <em class='icon ni ni-cross-circle'></em> 
                                            <strong>Progress cannot be updated!</strong> 
                                        </div>";
                            }
                        }

                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label class="form-label" for="weight">Weight</label>
                            <span class="text-danger">*</span>
                            <input type="number" class="form-control" id="weight" name="weight" value="<?php echo $result['weight'] ?>" required step="0.01">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="tall">Tall</label>
                            <span class="text-danger">*</span>
                            <input type="number" class="form-control" id="tall" name="tall" value="<?php echo $result['tall'] ?>" required step="0.01">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="body_mass_index">Body Mass Index</label>
                            <span class="text-danger">*</span>
                            <input type="number" class="form-control" id="body_mass_index" name="body_mass_index" value="<?php echo $result['body_mass_index'] ?>" required step="0.01">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="muscle_mass">Muscle Mass</label>
                            <span class="text-danger">*</span>
                            <input type="number" class="form-control" id="muscle_mass" name="muscle_mass" value="<?php echo $result['muscle_mass'] ?>" required step="0.01">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="body_fat_ratio">Body Fat Ratio</label>
                            <input type="number" class="form-control" name="body_fat_ratio" id="body_fat_ratio" value="<?php echo $result['body_fat_ratio'] ?>" step="0.01">
                        </div>
                        <div class="form-group mt-3 mb-5">
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