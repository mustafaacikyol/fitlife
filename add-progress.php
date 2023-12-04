<?php 
    include_once("inc/db_connect.php"); 
    include_once("inc/client/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("inc/head.php"); ?>
    <title>Generate Progress</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <?php include_once("inc/client/header.php") ?>

    <div class="container-fluid">
        <div class="row">
            <?php include_once("inc/client/sidebar.php") ?>
           
            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="content col-4 text-center" style="margin-left: 350px;">
                    <?php
                        if(isset($_POST["generateBtn"])){
                            $generate = $conn->prepare("insert into progress set weight=:weight, tall=:tall, body_mass_index=:body_mass_index, muscle_mass=:muscle_mass, body_fat_ratio=:body_fat_ratio");
                            $generate_result = $generate->execute(array("weight" => $_POST["weight"], "tall" => $_POST["tall"], "body_mass_index" => $_POST["body_mass_index"], "muscle_mass" => $_POST["muscle_mass"], "body_fat_ratio" => $_POST["body_fat_ratio"]));
                            if (isset($generate_result)) {
                                $get_progress_id = $conn->prepare("select id from progress order by id desc limit 1");
                                $get_progress_id->execute();
                                $progress_id_result = $get_progress_id->fetch(PDO::FETCH_ASSOC);
                                
                                $add_progress = $conn->prepare("insert into client_progress set client_id=:client_id, progress_id=:progress_id");
                                $add_progress_result = $add_progress->execute(array("progress_id" => $progress_id_result["id"], "client_id" => $_SESSION["client_id"]));

                                if(isset($add_progress_result)){
                                    echo "<div class='alert alert-icon alert-success' role='alert'>
                                    <em class='icon ni ni-check-circle'></em> 
                                    <strong>Progress added successfully</strong> 
                                    </div>";
                                    header("refresh:1;client-display-progress");
                                }else {
                                    echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                    <em class='icon ni ni-cross-circle'></em> 
                                    <strong>Failed to Add Progress!</strong>
                                    </div>";
                                }

                                
                            } else {
                                echo "<div class='alert alert-icon alert-danger alert-dismissible' role='alert'>
                                <em class='icon ni ni-cross-circle'></em> 
                                <strong>Failed to Add Progress!</strong>
                                </div>";
                            }
                        }
                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label class="form-label" for="weight">Weight</label>
                            <span class="text-danger">*</span>
                            <input type="number" class="form-control" id="weight" name="weight" value="<?php echo $_POST['weight'] ?>" required step="0.01">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="tall">Tall</label>
                            <span class="text-danger">*</span>
                            <input type="number" class="form-control" id="tall" name="tall" value="<?php echo $_POST['tall'] ?>" required step="0.01">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="body_mass_index">Body Mass Index</label>
                            <span class="text-danger">*</span>
                            <input type="number" class="form-control" id="body_mass_index" name="body_mass_index" value="<?php echo $_POST['body_mass_index'] ?>" required step="0.01">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="muscle_mass">Muscle Mass</label>
                            <span class="text-danger">*</span>
                            <input type="number" class="form-control" id="muscle_mass" name="muscle_mass" value="<?php echo $_POST['muscle_mass'] ?>" required step="0.01">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="body_fat_ratio">Body Fat Ratio</label>
                            <input type="number" class="form-control" name="body_fat_ratio" id="body_fat_ratio" value="<?php echo $_POST['body_fat_ratio'] ?>" step="0.01">
                        </div>
                        <div class="form-group mt-3 mb-5">
                            <button type="submit" class="btn btn-md btn-round btn-primary" name="generateBtn">Generate</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <?php include_once("inc/dashboard_js.php") ?>

</body>
</html>